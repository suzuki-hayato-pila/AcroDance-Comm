<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapInfo extends Model
{
    use HasFactory;

    // テーブル名を指定
    protected $table = 'map_infos';

    public $timestamps = false; // タイムスタンプを無効化

    protected $fillable = [
        'activity_location', // 活動場所の名前
        'latitude',          // 緯度
        'longitude',         // 経度
        'post_id',           // 投稿のID（リレーション用）
    ];

    public function post()
    {
        return $this->belongsTo(Post::class); // Post モデルとのリレーション
    }
}
