<?php

namespace App\Http\Controllers;

use App\Services\AnnounceService;
use DOMWrap\Document;
use Illuminate\Http\Request;

class AnnounceController extends Controller
{
    public function index(Request $request, AnnounceService $announceService)
    {
        $data = $announceService->getLocalList($request['word'] ?? null);
        return view('announce/index')
            ->with('announces', $data)
            ->with('word', $request['word']);
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
        $title = (new Document())->html($data)->find('div.announce_text.font_bold.padding_top_10')->text();
        $thumbnail = (new Document())->html($data)->find('div.banner_area img')->attr('src');
        if (!file_exists(storage_path('app').'/public/image/announce/ogp/'.basename($thumbnail))) {
            $img = file_get_contents($thumbnail);
            file_put_contents(storage_path('app').'/public/image/announce/ogp/'.basename($thumbnail), $img);
        }
        return view('announce/detail', ['data' => $data, 'title' => $title, 'thumbnail' => basename($thumbnail)]);
    }
}
