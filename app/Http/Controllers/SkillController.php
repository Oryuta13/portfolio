<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LearningData;
use App\Models\Category;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        // リクエストから月のデータを取得、デフォルトは現在の月。URLデコードを適用
        $selectedMonth = urldecode($request->input('month', Carbon::now()->format('n月')));

        // 直近3ヶ月の日付を$monthsに格納
        $months = collect([
            Carbon::now()->format('n月'),
            Carbon::now()->subMonth()->format('n月'),
            Carbon::now()->subMonth(2)->format('n月'),
        ]);

        // 現在の月を表す変数を用意（ドロップダウンボタンの表示用）
        $currentMonth = Carbon::now()->format('n月');

        // 選択された月の学習データを取得
        $skills = LearningData::whereMonth('study_date', '=', Carbon::createFromFormat('n月', $selectedMonth)->month)
                                ->whereYear('study_date', '=', Carbon::createFromFormat('n月', $selectedMonth)->year)
                                ->get();

        // ログインしているuserの学習データを取得
        $userId = auth()->id();
        $learningData = LearningData::with('category')
                                    ->where('user_id', $userId)
                                    ->whereMonth('study_date', '=', Carbon::createFromFormat('n月', $selectedMonth)->month)
                                    ->whereYear('study_date', '=', Carbon::createFromFormat('n月', $selectedMonth)->year)
                                    ->get();

        // カテゴリーごとにデータをグループ化
        $groupedLearningData = $learningData->groupBy('category_id');

        // 変数をビューに渡す
        return view('skills.index', compact('months', 'currentMonth', 'skills', 'selectedMonth', 'groupedLearningData'));
    }

    public function create($category, Request $request)
    {
        // URLデコードを適用
        $selectedMonth = urldecode($request->input('month', now()->format('n月')));

        $categoryName = Category::where('id', $category)->firstOrFail()->category;
        $selectedMonth = $request->month;

        // もしドロップダウンから月を選択していなければ、現在の月を使用
        if (!$selectedMonth) {
            $selectedMonth = now()->format('n月');
        }

        // categoriesテーブルからカテゴリーを取得
        $categories = Category::all();

        // 現在の月または選択された月を取得
        $currentMonth = now()->format('n月');
        $selectedMonth = request('month') ?? $currentMonth;

        // 変数をビューに渡す
        return view('skills.create', compact('categories', 'selectedMonth', 'categoryName', 'category'));
    }

    public function store(Request $request)
    {
        // バリデーションルール定義
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'contents' => 'required|max:50',
            'study_time' => 'required|numeric|min:0',
        ];

        // バリデーションメッセージ定義
        $messages = [
            'contents.required' => '項目名は必ず入力してください',
            'contents.max' => '項目名は50文字以内で入力してください',
            'study_time.required' => '学習時間は必ず入力してください',
            'study_time.numeric' => '学習時間は0以上の数字で入力してください',
            'study_time.min' => '学習時間は0以上の数字で入力してください',
        ];

        // バリデーション実行
        $validatedData = $request->validate($rules, $messages);

        // 学習日を月初めに設定
        $studyDate = Carbon::createFromFormat('n月', $request->study_date)->startOfMonth();

        // 同じユーザー、同じ月、同じ項目名でデータが存在するかチェック
        $existingData = LearningData::where('user_id', auth()->id())
                                    ->where('study_date', $studyDate)
                                    ->where('contents', $request->contents)
                                    ->exists();

        if ($existingData) {
            // エラーメッセージを設定してリダイレクト
            return redirect()->back()->withErrors(['contents' => '"' . $request->contents . '" は既に登録されています'])->withInput(); // エラーメッセージを明確化
        }

        // データを保存
        $learningData = new LearningData();
        $learningData->category_id = $validatedData['category_id'];
        $learningData->contents = $validatedData['contents'];
        $learningData->study_time = $validatedData['study_time'];
        $learningData->study_date = $studyDate;
        $learningData->user_id = auth()->id();
        $learningData->save();

        // カテゴリー名の取得
        $categoryName = Category::find($validatedData['category_id'])->category;

        // 成功メッセージをセッションにフラッシュしてリダイレクト
        return redirect()->route('skills.create', ['category' => $request->category_id])
            ->with('successMessage', "{$categoryName}に{$request->contents}を{$request->study_time}分で追加しました！");
    }

    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'study_time' => 'required|numeric|min:0',
        ]);

        // 学習データを更新
        $learningData = LearningData::findOrFail($id);
        $learningData->study_time = $request->study_time;
        $learningData->save();

        // 成功メッセージ
        $successMessage = "{$learningData->contents}の学習時間を保存しました！";

        // 学習データの月情報をセッションに保存
        $studyDate = Carbon::parse($learningData->study_date);
        session(['redirectMonth' => $studyDate->format('n月')]);

        return back()->with('successMessage', $successMessage);
    }

    public function destroy($id)
    {
        $learningData = LearningData::findOrFail($id);
        // 削除する項目名を保存
        $deletedItemName = $learningData->contents;
        $learningData->delete();

        // 学習データの月情報をセッションに保存
        $studyDate = Carbon::parse($learningData->study_date);
        session(['redirectMonth' => $studyDate->format('n月')]);

        // 削除確認モーダルに表示するメッセージをフラッシュ
        return back()->with('successMessage', "{$deletedItemName}を削除しました！");
    }

}
