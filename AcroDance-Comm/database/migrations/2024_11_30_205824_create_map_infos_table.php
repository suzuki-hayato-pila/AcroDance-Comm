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
        Schema::create('map_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('activity_location'); // 活動場所
            $table->decimal('latitude', 10, 7);  // 緯度
            $table->decimal('longitude', 10, 7); // 経度
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // posts テーブルと連携
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_infos');
    }
};
