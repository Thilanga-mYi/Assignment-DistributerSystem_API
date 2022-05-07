<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'img_url',
        'description',
        'status',
    ];

    public function getPostImages()
    {
        return $this->hasOne(PostHasImages::class, 'id', 'post_id');
    }
}
