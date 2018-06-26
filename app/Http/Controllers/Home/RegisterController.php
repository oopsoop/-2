<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;

class RegisterController extends Controller
{
    public function index()
    {
    	return view('home.register.index');
    }

    public function register()
    {

//        $this->validate(request(),[
//            'mobile' => 'required|min:11|unique:home_users,mobile',
////           'name' => 'required|min:3|unique:home_users,name',
//            'email' => 'required|unique:home_users,email|email',
//            'password' => 'required|min:5|confirmed',
//        ]);

        $name = request('name');
       
        if( !$name ) {
            return response()->json(["errno"=>-1008, "errmsg"=>"用户名必须填写"]);

        }

         $company_name = request('company_name');
       
        if( !$company_name ) {
            return response()->json(["errno"=>-1009, "errmsg"=>"公司名必须填写"]);

        }
        $password = request('password');
        $mobile = request('mobile');
        if( !$password || !$mobile ) {
            return response()->json(["errno"=>-1010, "errmsg"=>"手机号与密码必须传递"]);

        }

         if(!preg_match("/^1[34578]{1}\d{9}$/",$mobile)){
            return response()->json(["errno"=>-1011, "errmsg"=>"手机号码格式不对"]);
        }

        if( strlen($password)<8 ) {
            return response()->json(["errno"=>-1012, "errmsg"=>"密码太短，请设置至少8位的密码"]);
        }

        $confirm_password = request('confirm_password');
        if( !$confirm_password ) {
            return response()->json(["errno"=>-1013, "errmsg"=>"确认密码必须填写"]);
        }
        if($password !== $confirm_password){
            return response()->json(["errno"=>-1014, "errmsg"=>"注册密码和确认密码不一致"]);
        }

        $code = request('code');
        
      

        $we_chat = request('we_chat');


        $model =new \App\HomeUser;
        if($data = $model->register(trim($mobile),trim($password),trim($name),trim($company_name),trim($we_chat),trim($code))){
            return response()->json(["errno"=>0, "errmsg"=>"",'data'=>['userinfo'=>$data]]);
        }else{
            return response()->json(["errno"=>$model->errno, "errmsg"=>$model->errmsg]);
        }

    }

       private function _mobile_generate( $mobile ){
        return md5( "salt-register-".$mobile );
    }


}
