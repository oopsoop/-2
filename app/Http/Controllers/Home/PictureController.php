<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;

use App\Picture;


class PictureController extends Controller
{
    public function show()
    {
        ini_set('memory_limit', '502M');
        //轮播图
        $pictures = Picture::offset(0)->limit(3)->orderBy('created_at','desc')->select('id','pic')->get();
        return response()->json([
            "errno"=>0,
            "errmsg"=>"",
            "picture"=>$pictures,
        ]);
    }
}
