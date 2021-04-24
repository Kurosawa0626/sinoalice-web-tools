<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AnnounceService;

class AnnounceController extends Controller
{
    /**
     * @param AnnounceService $announceService
     * @return false|string
     */
    public function diff(AnnounceService $announceService)
    {
        $diff = $announceService->checkDiff();
        $announces = [];
        $new = [];
        foreach ($diff['new'] as $v) {
            $new[] = $v->title."\nhttps://sinoalice.cro-kuro.net/announce/detail/".$v->id;
            $announces[] = '【新規】'.$v->title."\nhttps://sinoalice.cro-kuro.net/announce/detail/".$v->id;
        }
        $del = [];
        foreach ($diff['del'] as $v) {
            $del[] = $v->title."\nhttps://sinoalice.cro-kuro.net/announce/detail/".$v->id;
            $announces[] = '【削除】'.$v->title."\nhttps://sinoalice.cro-kuro.net/announce/detail/".$v->id;
        }
        $update = [];
        foreach ($diff['update'] as $v) {
            $update[] = $v->title."\nhttps://sinoalice.cro-kuro.net/announce/detail/".$v->id;
            $announces[] = '【更新】'.$v->title."\nhttps://sinoalice.cro-kuro.net/announce/detail/".$v->id;
        }
        return json_encode([
            'new'=>$new,
            'del'=>$del,
            'update'=>$update,
            'announces' => $announces
        ]);
    }
}
