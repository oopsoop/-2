<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;

use App\Stadium;
use App\Status_t;


class StadiumController extends Controller
{
    public function show()
    {
        ini_set('memory_limit', '502M');
        $xibies = Status_t::where('ty','=','9')->select('id','status_name')->get();
        return response()->json([
            "errno"=>0,
            "errmsg"=>"",
            "xibie"=>$xibies,
        ]);

    }

    public function getStadiumByXiBieId()
    {
        ini_set('memory_limit', '502M');
        $id = request('id');
        if(!$id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到id"]);
        }
        $model = new Status_t();
        if($model->getStadiumByXiBieId($id ) ) {

            $stadium_data = Stadium::where('status_id','=',$id)->select('id','stadium_name','district')->get();
            if(!count($stadium_data)){
                return response()->json([
                    "errno"=>0,
                    "errmsg"=>"",
                    "stadium_data"=>[],
                ]);
            }else{
                return response()->json([
                    "errno"=>0,
                    "errmsg"=>"",
                    "stadium_data"=>$stadium_data,
                ]);
            }


        } else {
            return response()->json([  "errno"=>-2012, "errmsg"=>"获取场地信息失败"]);
        }

    }

    public function getStadiumById()
    {
        ini_set('memory_limit', '502M');
        $id = request('id');

        if(!$id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到id"]);
        }
        $model = new Stadium();
        if($data = $model->getStadiumById($id ) ) {

            return response()->json([  "errno"=>0,"errmsg"=>"","data"=>$data]);

        } else {
            return response()->json([  "errno"=>-2012, "errmsg"=>"获取场地信息失败"]);
        }
    }

    public static function stadiumid($id=''){


        echo $id;

    }
}
