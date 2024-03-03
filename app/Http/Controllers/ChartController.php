<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningData;
use App\Models\Category;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function index()
    {
        $months = collect([
            Carbon::now()->subMonths(2)->startOfMonth(),
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->startOfMonth(),
        ]);

        $categories = Category::all();
        $data = [];

        foreach ($months as $month) {
            foreach ($categories as $category) {
                $totalTime = LearningData::where('category_id', $category->id)
                                    ->whereBetween('study_date', [$month, $month->copy()->endOfMonth()])
                                    ->where('user_id', auth()->id())
                                    ->sum('study_time');
                // 月ごと、カテゴリーごとの学習時間を配列に追加
                $data[$category->id][] = $totalTime;
            }
        }

        // カテゴリーの情報を取得
        $categoryNames = $categories->pluck('category', 'id');

        return view('top', compact('data', 'categoryNames'));

            // $data[] = LearningData::selectRaw('category_id, SUM(study_time) as total_time')
            //                     ->whereBetween('study_date', [$month, $month->copy()->endOfMonth()])
            //                     ->groupBy('category_id')
            //                     ->with('category')
            //                     ->get();
        }
}
