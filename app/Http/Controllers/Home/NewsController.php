<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;

class NewsController extends Controller
{
    public function newsHomePage()
    {
        $pageNo = request( "pageNo", "1" );
        $pageSize = request( "pageSize", "10" );
//        $cate = request( "cate", "0" );
//        $status = request( "status", "online" );
        $model = new \App\News();
//        dd($model->list( $pageNo, $pageSize, $cate ));
        if( $data=$model->list( $pageNo, $pageSize ) ) {
            return response()->json([  "errno"=>0,"errmsg"=>"","data"=>$data]);

        } else {
            return response()->json([  "errno"=>-2012, "errmsg"=>"获取新闻列表失败"]);
        }
        return TRUE;
    }

    public function getNewsById()
    {
        $id = request('id');
        if(!$id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到id"]);
        }
        $model = new \App\News();
        if( $data=$model->getNewsById($id ) ) {
            return response()->json([  "errno"=>0,"errmsg"=>"","data"=>$data]);

        } else {
            return response()->json([  "errno"=>-2012, "errmsg"=>"获取新闻信息失败"]);
        }


    }

}
