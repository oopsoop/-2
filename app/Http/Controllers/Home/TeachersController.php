<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;
use App\Teacher;
use App\Course;
use App\Service\AppToken;

class TeachersController extends Controller
{
    //

    public function index()
    {
//        return view('home.welcome');
         // return view('home.index');

    }

    public function login(Request $request)
    {
//        if(\Auth::guard('home')->check()) {
//            return redirect("/home/index");
//        }
//
//        if($request->input('is_post') == 1){
//
//            //验证
//            $this->validate($request, [
//                'name' => 'required|min:2',
//                'password' => 'required|min:6|max:30',
////                'is_remember' => '',
//            ]);
//            //逻辑
//            $user = request(['name', 'password']);
//            $remember = boolval(request('is_remember'));
//            // 登陆成功
//            if (true == \Auth::guard('home')->attempt($user, $remember)) {
//
//                return redirect('/home/index');
//            }
//            //渲染
//            return \Redirect::back()->withErrors("用户名密码错误");
//        }
//        return view("home.login.index");

        // 教师端登录
        $password = request('password');
        $mobile = request('account');
        if( !$password || !$mobile ) {
            return response()->json(["errno"=>-1023, "errmsg"=>"账号与密码必须传递"]);

        }
        $model =new Teacher;

        if($token = $model->login(trim($mobile),trim($password))){
//            return $uid;die;
            return response()->json(["errno"=>0, "errmsg"=>"",'data'=>['teacher-token'=>$token]]);

//            return ['teacher-token'=>$token];
        }else{
            return ["errno"=>-500, "errmsg"=>'token获取失败'];
        }
    }

    public function tcourse(Request $request){
//        return 23;
       $teacher_id = AppToken::getAppTeacherUid($request);
       return  Teacher::with('mcourse.coursetable')->with('mcourse.own_stadium')->where('id','=',$teacher_id)->get();

    }





//    public function getCookies()
//    {
//        header('Access-Control-Allow-Origin: *');
//        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Cookie, Accept,Responsetype, multipart/form-data, application/json, Authorization');
//        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, OPTIONS, DELETE ');
//        header('Access-Control-Allow-Credentials: false');
////        return response()->json(['userid'=>session('userid'),'usermobile'=>session('usermobile'),'name'=>session('name'),'company_name'=>session('company_name')]);
//
//        $callback = $_GET['jsoncallback'];
////        $mywinduid = $_COOKIE['mywinduid'];
//        //多个参数的话以","隔开，例如json_encode(array('winduid'=>$winduid,'msg'=>$msg));
////可以用json_encode自动转换，也可以手写json格式 $json_data = '{"mywinduid":'.$mywinduid.'}';
//        $json_data = json_encode(['userid'=>session('userid'),'usermobile'=>session('usermobile'),'name'=>session('name'),'company_name'=>session('company_name')]);
////必需以下这样形式输出,重点就是发送请求的网页的参数中要有jsoncallback参数
//        echo $callback.'('.$json_data.')';
//    }
  //  public function logout()
  //  {
  //      return \Auth::guard('home')->logout();
//        return redirect('/home/index');
  //  }

}
