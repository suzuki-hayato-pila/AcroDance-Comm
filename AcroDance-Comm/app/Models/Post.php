<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // タイムスタンプを無効化
    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'preferred_gender',
        'preferred_group_size',
        'location_name', //追加
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
