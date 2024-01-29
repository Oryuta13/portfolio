<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

    // topページに飛ばす
    public function top()
    {
        return view('top');
    }

    // loginページに飛ぶ
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('top');
        }
        return back();
    }

    // logoutしたらloginページに飛ぶ
    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
