<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTopic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'url',
        'url_to_image',
        'content',
        'published_at',
    ];
}
