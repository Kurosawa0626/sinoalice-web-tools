<?php

namespace App\Console\Commands;

use App\Models\Tweet;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class RecruitTweet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recruit:tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '取得ツイート管理（期限切れ、ツイ消しなど）';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // 掲載期限切れを削除
        Log::info("期限切れツイートの削除");
        $delete_time = (new Carbon())->subWeek();
        Tweet::where('tweeted_at', '<', $delete_time)->delete();

        // TwitterAPIが最大100件なので100件で分割する
        $chunk_tweets = Tweet::all()->chunk(100);
        foreach ($chunk_tweets as $chunk_tweet) {
            $tweet_ids = array_column($chunk_tweet->toArray(), 'tweet_id');
            $url = 'https://api.twitter.com/2/tweets?ids='.(implode(',', $tweet_ids)).'&tweet.fields=created_at';
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization:Bearer '.Config::get('twitter.bearer_token')]);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response);

            // 削除済み、鍵垢を削除
            Log::info("削除済み、鍵垢のツイートを削除");
            if (isset($response->errors)) {
                $delete_ids = array_column($response->errors, 'value');
                $delete_count = Tweet::whereIn('tweet_id', $delete_ids)->delete();
                Log::info("Errors: ".$delete_count);
            }

            // データないツイートのデータを取得
            Log::info("データ取得");
            if (isset($response->data)) {
                foreach ($response->data as $data) {
                    $tweet = Tweet::where('tweet_id', $data->id)->whereNull('text')->first();
                    if ($tweet) {
                        $url = 'https://publish.twitter.com/oembed?url=https://twitter.com/'.$tweet->username.'/status/'.$tweet->tweet_id;
                        $curl = curl_init($url);
                        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($curl);
                        curl_close($curl);

                        $tweet->fill([
                            'html' => json_decode($response)->html
                        ])->save();
                    }
                }
            }
        }
    }
}
