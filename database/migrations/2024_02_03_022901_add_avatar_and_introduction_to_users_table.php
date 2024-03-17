<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 新しいカラムを追加する
            // $table->string('avatar')->nullable()->default('storage/avatars/gray-icon.png');
            $table->string('avatar')->nullable()->default('/storage/avatars/gray-icon.png');
            $table->string('introduction')->nullable()->default('自己紹介文を入力する自己紹介文を入力する自己紹介文を入力する自己紹介文を入力する自己紹介文を入力する自己紹介文を入力する');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
