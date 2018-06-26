<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;

use App\News;


class BannerController extends Controller
{
    public function show()
    {
        ini_set('memory_limit', '502M');
        //轮播图
        $news = News::offset(0)->limit(3)->orderBy('created_at','desc')->select('id','pic')->get();
        return response()->json([
            "errno"=>0,
            "errmsg"=>"",
            "banner"=>$news,
        ]);
    }
}
