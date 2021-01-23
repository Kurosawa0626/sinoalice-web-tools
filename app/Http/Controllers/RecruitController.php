<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

class RecruitController extends Controller
{
    public function index()
    {
        $guild = Tweet::guild()->count();
        $member = Tweet::member()->count();

        return view('recruit/index')
            ->with('guild_count', $guild)
            ->with('member_count', $member);
    }

    public function search($type)
    {
        switch ($type) {
            case 'guild':
                $tweets = Tweet::guild();
                break;

            case 'member':
                $tweets = Tweet::member();
                break;

            default:
                $tweets = null;
        }

        return view('recruit/search')
            ->with('tweets', $tweets->limit(10))
            ->with('type', $type)
            ->with('time_zone', null)
            ->with('job', null)
            ->with('free_text', null);
    }
}
