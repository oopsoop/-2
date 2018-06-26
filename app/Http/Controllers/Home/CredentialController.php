<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;
use Validator;
class CredentialController extends Controller
{
    public function get() {

        $id = request('id');
        if(is_numeric($id) && $id){
            if( !(new \App\HomeUser)->is_logged_in() ) {
                return response()->json(["errno"=>-2000, "errmsg"=>"需要登录才能操作"]);
            }
            $model = new \App\EnterPrise();
            if($data = $model->find($id)){
                return response()->json([
                    "errno"=>0,
                    "errmsg"=>"",
                    "data"=>$data,
                ]);
            }else{
                return response()->json([
                    "errno"=>-2009,
                    "errmsg"=>"基础档案获取失败",
                ]);
            }
        }else{
            return response()->json([
                "errno"=>-2003,
                "errmsg"=>"缺少必要的参数",
            ]);
        }
    }




    public function edit($enterprise_id = 0)
    {

    }


    function checkDate($date){
        if( date('Y-m-d',strtotime($date)) == $date ){
            return true;
        }else{
            return false;
        }
    }
}
