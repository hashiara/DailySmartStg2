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
            $table->bigIncrements('id')->unsigned(); // id
            $table->string('user_id', 33)->unique(); // LineユーザーID
            $table->string('password', 12);          // パスワード
            $table->string('user_name', 50);         // ユーザー名
            $table->integer('birth', 8);                 // 生年月日
            $table->string('otk', 12)->unique();     // ワンタイム認証キー
            $table->timestamps('created_at', 0);     // 作成日時
            $table->timestamps('updated_at', 0);     // 更新日時
            $table->timestamps('deleted_at', 0);     // 削除日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
