<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningData extends Model
{
    use HasFactory;

    protected $dates = ['study_date'];

    // UserモデルとCategoryモデルの関係を示すためのメソッドを定義
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
