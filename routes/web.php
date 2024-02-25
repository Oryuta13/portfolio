<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[\App\Http\Controllers\UserController::class,'showRegister']);

Route::post('/register',[\App\Http\Controllers\UserController::class,'register']);

// ログインしているuserのみ
Route::middleware('auth')->group(function (){
    Route::get('/top',[\App\Http\Controllers\UserController::class,'top'])->name('top');
    Route::post('logout',[\App\Http\Controllers\UserController::class,'logout'])->name('user.logout');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/skills/index', [SkillController::class, 'index'])->name('skills.index');
});

Route::get('/login',[\App\Http\Controllers\UserController::class,'showLogin']);

Route::post('/login',[\App\Http\Controllers\UserController::class,'login']);

// ログインしていない状態で/topにアクセスするとログイン画面に飛ぶ
Route::get('/login',[\App\Http\Controllers\UserController::class,'showLogin'])->name('login');

// カテゴリー別に対応した項目追加ページに遷移する
Route::get('/skills/create/{category}', [SkillController::class, 'create'])->name('skills.create');

Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
