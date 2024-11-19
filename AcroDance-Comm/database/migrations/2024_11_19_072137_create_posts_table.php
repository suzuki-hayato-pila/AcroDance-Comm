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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // 自動的にインクリメントされるID
            $table->string('title'); // 投稿タイトル
            $table->text('content'); // 投稿内容
            $table->string('preferred_gender')->nullable(); // 希望性別（nullを許容）
            $table->string('preferred_group_size')->nullable(); // 希望人数（nullを許容）
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 投稿者のユーザーID（外部キー制約付き）
            // $table->timestamps(); // created_at と updated_at のタイムスタンプ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts'); // posts テーブルを削除
    }
};
