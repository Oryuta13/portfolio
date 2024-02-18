<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        // スキル項目一覧ページを取得
        return view('skills.index');
    }
}
