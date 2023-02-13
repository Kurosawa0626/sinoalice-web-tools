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

        foreach (Tweet::all() as $tweet) {
            $url = 'https://publish.twitter.com/oembed?url=https://twitter.com/'.$tweet->username.'/status/'.$tweet->tweet_id;
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response);
            if (!$response) {
                Log::info("削除済み、鍵垢のツイートを削除");
                Tweet::where('tweet_id', $tweet->tweet_id)->delete();
                continue;
            }

            if (!$tweet->html) {
                Log::info("削除済み、鍵垢のツイートを削除");
                $tweet->fill([
                    'html' => json_decode($response)->html
                ])->save();
            }
        }
    }
}
