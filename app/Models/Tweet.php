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
        'username',
        'text',
        'html',
        'tweeted_at'
    ];

    /**
     * ギルド募集の絞り込み
     * @param $query
     * @return mixed
     */
    public function scopeGuild($query) {
        return $query->where('text', 'like binary', '%#シノアリスギルド募集%')
            ->where('text', 'not like', '%#シノアリスギルメン募集%')
            ->where('text', 'not like', '%#シノアリスギルドメンバー募集%');
    }

    /**
     * ギルメン募集の絞り込み
     * @param $query
     * @return mixed
     */
    public function scopeMember($query) {
        return $query->where('text', 'like binary', '%#シノアリスギルメン募集%')
            ->where('text', 'like binary', '%#シノアリスギルドメンバー募集%')
            ->where('text', 'not like', '%#シノアリスギルド募集%');
    }

    /**
     * コロシアム時間帯の絞り込み
     * @param $query
     * @param $time
     * @return mixed
     */
    public function scopeColosseum($query, $time) {
        if (!$time) {
            return $query;
        }

        switch ($time) {
            case $time == '08':
                $pattern = '([^1])8時|([^1])8:00|朝|朝帯|朝ギルド|朝コロ';
                break;
            case $time == '12':
                $pattern = '12時|12:30|昼|昼帯|昼ギルド|昼コロ';
                break;
            case $time == '18':
                $pattern = '18時|18:00';
                break;
            case $time == '19':
                $pattern = '19時|19:00';
                break;
            case $time == '20':
                $pattern = '20時|20:00';
                break;
            case $time == '21':
                $pattern = '21時|21:00';
                break;
            case $time == '22':
                $pattern = '22時|22:00';
                break;
            case $time == '23':
                $pattern = '23:00|23時';
                break;

            default:
                return $query;
        }

        return $query->where('text', 'regexp', $pattern);
    }

    /**
     * 職業の絞り込み
     * @param $query
     * @param $job
     * @return mixed
     */
    public function scopeJob($query, $job) {
        if (!$job) {
            return $query;
        }

        switch ($job) {
            case "attacker":
                $pattern = '前衛|槍ハフ|槌ハフ|剣ハフ|弓ハフ';
                break;
            case "minstrel":
                $pattern = 'ミンス|ミンソサ|楽器屋|楽器さん';
                break;
            case "sorcerer":
                $pattern = 'ソーサラー|ソサ|本屋|本さん|魔書さん';
                break;
            case "cleric":
                $pattern = 'クレリック|(^ウ)クレ|ーラー|ヒー.ー|杖屋|杖さん';
                break;

            default:
                return $query;
        }

        return $query->where('text', 'regexp', $pattern);
    }

    /**
     * フリーテキスト検索
     * @param $query
     * @param $text
     * @return mixed
     */
    public function scopeFreetext($query, $text) {
        if (!$text) {
            return $query;
        }

        $texts = explode(" ", str_replace("　", " ", $text));
        foreach ($texts as $text) {
            $query->where('text', 'like', "%$text%");
        }

        return $query;
    }
}
