<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // registerページに飛ぶ
    public function showRegister()
    {
        return view('register');
    }

    // userを作成し、作成したuserでログイン後にtopページに飛ばす
    public function register(Request $request)
    {
        // name,email,passwordのバリデーション
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'regex:/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i'],
        ],[
            'name.required' => '氏名は必ず入力してください',
            'name.max' => '氏名は255文字以内で入力してください',
            'email.required' => 'メールアドレスは必ず入力してください',
            'email.email' => 'メールアドレスが正しい形式ではありません',
            'password.required' => 'パスワードは必ず入力してください',
            'password.min' => '英数字8文字以上で入力してください',
            'password.regex' => '英数字8文字以上で入力してください',
        ]);
        // userを作成
        $user = User::query()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
        // 作成したuserにログイン
        Auth::login($user);
        // topページに飛ばす
        return redirect()->route('top');
    }

    public function top()
    {
        return view('top');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'メールアドレスは必ず入力してください',
            'email.email' => 'メールアドレスが正しい形式ではありません',
            'password.required' => 'パスワードは必ず入力してください',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('top');
        }

        // メールアドレスとパスワードが一致しない場合のエラーメッセージを設定
        return back()->withErrors([
            'loginError' => 'メールアドレス、もしくはパスワードが間違っています'
        ]);
    }

    // logoutしたらloginページに飛ぶ
    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
