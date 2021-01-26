<?php

namespace App\Http\Controllers;

use App\Services\AnnounceService;
use Illuminate\Http\Request;

class AnnounceController extends Controller
{
    public function index(AnnounceService $announceService)
    {
        $data = $announceService->getLocalList($_GET['word'] ?? null);
        return view('announce/index')
            ->with('announces', $data)
            ->with('word', $_GET['word']);
    }

    /**
     * お知らせ詳細
     * @param $id
     * @param AnnounceService $announceService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail($id, AnnounceService $announceService)
    {
        $data = $announceService->getLocalDetail($id);
        return view('announce/detail', ['data' => $data]);
    }
}
