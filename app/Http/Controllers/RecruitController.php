<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RecruitController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $guild = Tweet::guild()->count();
        $member = Tweet::member()->count();

        return view('recruit/index')
            ->with('guild_count', $guild)
            ->with('member_count', $member);
    }

    /**
     * @param string $type
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(string $type, Request $request)
    {
        $tweets = null;
        switch ($type) {
            case 'guild':
                $tweets = Tweet::guild();
                break;

            case 'member':
                $tweets = Tweet::member();
                break;
        }

        $tweets->colosseum($request['colosseum'])
               ->job($request['job'])
               ->freetext($request['free_text'])
               ->orderBy('id', 'desc');

        return view('recruit/search')
            ->with('tweets', $tweets->paginate(10))
            ->with('type', $type)
            ->with('time_zone', null)
            ->with('job', null)
            ->with('free_text', null)
            ->with('params', $request);
    }
}
