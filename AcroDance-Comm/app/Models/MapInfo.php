<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapInfo extends Model
{
    use HasFactory;

    public $timestamps = false; // これでtimestampsの自動管理を無効化
    protected $fillable = [
        'activity_location',
        'latitude',
        'longitude',
        'post_id',
    ];

    // 関連データのEager Loadingを有効化
    protected $with = ['post'];

    // Postとの関連付け (多対1)
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
