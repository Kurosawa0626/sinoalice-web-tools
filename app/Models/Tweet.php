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

    public function scopeGuild($query) {
        return $query->where('text', 'like binary', '%#シノアリスギルド募集%')
            ->where('text', 'not like', '%#シノアリスギルメン募集%')
            ->where('text', 'not like', '%#シノアリスギルドメンバー募集%')
            ->orderBy('id', 'desc');
    }

    public function scopeMember($query) {
        return $query->where('text', 'like binary', '%#シノアリスギルメン募集%')
            ->where('text', 'like binary', '%#シノアリスギルドメンバー募集%')
            ->where('text', 'not like', '%#シノアリスギルド募集%')
            ->orderBy('id', 'desc');
    }
}
