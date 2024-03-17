<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'introduction',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // アバター画像のパスを取得
    public function getAvatarPath()
    {
        // ユーザーがログインしているか確認
        if (Auth::check()) {
            // ログインしている場合、ユーザーのアバター画像のパスを返す
            return asset(Auth::user()->avatar);
        }
    }

    public function getAvatarAttribute($value)
    {
        if (!$value){
            // デフォルトのアバター画像のパスを返す
            return asset('storage/avatars/gray-icon.png');
        } elseif (!Str::startsWith($value, ['http://', 'https://', '/storage'])) {
            // アップロードされた画像のパスを返す
            return asset('storage/avatars/' . $value);
        }
        // それ以外の場合（完全なURLまたは正しいストレージパスがすでに含まれている場合)、その値をそのまま返す
        return $value;
    }

    // UserモデルとLearningDataモデルのリレーションを定義
    public function learningData()
    {
        return $this->hasMany(LearningData::class, 'user_id');
    }
}
