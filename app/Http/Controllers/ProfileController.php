<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function edit()
    {
        // ログインしているuser情報を$userに格納
        $user = Auth::user();
        // profile.editに飛ばす
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // バリデーションをかける
        $request->validate([
            'introduction' => 'required|string|min:50|max:200',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'introduction.required' => '自己紹介は必須です。',
            'introduction.min' => '自己紹介は50文字以上で入力してください。',
            'introduction.max' => '自己紹介は200文字以下で入力してください。',
            'avatar.image' => '画像ファイルを添付してください。',
            'avatar.mimes' => '許可されている拡張子はjpeg、png、jpg、gif、svgです。',
            'avatar.max' => '画像サイズは2MB以下にしてください。',
        ]);

        // ログインしているuser情報を取得
        $user = Auth::user();
        // userが入力した自己紹介文を設定
        $user->introduction = $request->input('introduction');

        // avatarが送信されたら
        if($request->hasFile('avatar')) {
            // フォームから送信されたavatarファイルを取得
            $avatar = $request->file('avatar');
            // ユニークなファイル名を生成
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            // S3へ保存
            $path = $avatar->storeAs('avatars', $filename, 's3');
            // 完全なURLをユーザーのavatarフィールドへ保存
            $user->avatar = Storage::disk('s3')->url($path);
        }

        // ユーザー情報を保存（アバター画像の有無にかかわらず）
        $user->save();
        // 編集後はtopページに飛ばす
        return redirect('top');
    }
}
