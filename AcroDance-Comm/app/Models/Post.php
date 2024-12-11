<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $timestamps = false; // これでtimestampsの自動管理を無効化
    protected $fillable = [
        'title',
        'content',
        'preferred_gender',
        'preferred_group_size',
        'location_name',
        'user_id',
    ];

    // 関連データのEager Loadingを有効化
    // protected $with = ['mapInfo'];

    // ユーザーとの関連付け (1対多の逆関係)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // MapInfoとの関連付け (1対1)
    public function mapInfo()
    {
        return $this->hasOne(MapInfo::class, 'post_id');
    }
}
