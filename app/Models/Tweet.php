<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tweet extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['tweeted_at', 'deleted_at'];

    protected $fillable = [
        'tweet_id',
        'text',
        'html',
        'tweeted_at'
    ];
}
