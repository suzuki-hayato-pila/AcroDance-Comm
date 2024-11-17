<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('account_name')->nullable()->after('id'); // NULLを許容する
            $table->string('instagram')->nullable()->after('email');
            $table->string('gender')->after('instagram');
            $table->string('location')->nullable()->after('gender'); // locationカラムを追加
            $table->string('profile_photo')->nullable()->after('location');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['account_name', 'instagram', 'gender', 'location', 'profile_photo']); // locationを含むすべてのカラムを削除
        });
    }
};
