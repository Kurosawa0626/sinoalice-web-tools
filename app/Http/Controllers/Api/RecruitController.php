<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwitterStoreRequest;
use App\Models\Tweet;

class RecruitController extends Controller
{
    /**
     * 募集ツイートのIDを保存
     * API制限回避のためここではIDとUserName取得のみ
     * @param TwitterStoreRequest $request
     * @return false|string
     */
    public function store(TwitterStoreRequest $request)
    {
        try {
            Tweet::create([
                'tweet_id'   => $request['id'],
                'username'   => $request['username'],
                'text'       => $request['text'],
                'tweeted_at' => $request['tweeted_at']
            ]);
        } catch (\Exception $e) {
            return json_encode(['result' => 'failed']);
        }

        return json_encode(['result' => 'success']);
    }
}
