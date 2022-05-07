<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostHasImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'img_url',
        'status',
    ];

}
