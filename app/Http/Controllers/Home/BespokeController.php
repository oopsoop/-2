<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;
use App\Service\Token;
use App\Service\AppToken;
use App\UserBespoke;

class BespokeController extends Controller
{
    public function bespoke(Request $request)
    {

        ini_set('memory_limit', '502M');
        $user_id = Token::getCurrentUid($request);
        if( !$user_id ) {
            return response()->json(["errno"=>-1008, "errmsg"=>"用户名必须填写"]);

        }
        $people_num = request('people_num');
        if( !$people_num ) {
            return response()->json(["errno"=>-1011, "errmsg"=>"人数必须传递"]);

        }
        if(intval($people_num) > 1){
           return $this->multiple_people($request);
        }

       
        // 课程时间列表上的 item id
        $course_id = request('course_id');

        if( !$course_id ) {
            return response()->json(["errno"=>-1007, "errmsg"=>"课程id必须传递"]);

        }

        // 课程时间列表上的 item id
        $schedule_id = request('schedule_id');

        if( !$schedule_id ) {
            return response()->json(["errno"=>-1009, "errmsg"=>"课程所对应的当前开课id必须传递"]);

        }


        $name = request('name');
        if( !$name ) {
            return response()->json(["errno"=>-1012, "errmsg"=>"姓名必须填写"]);

        }

        $mobile = request('mobile');
        if( !$mobile ) {
            return response()->json(["errno"=>-1013, "errmsg"=>"手机号必须填写"]);

        }

        $gender = request('gender');
        if( !$gender ) {
            return response()->json(["errno"=>-1014, "errmsg"=>"性别必须填写"]);
        }

        $age = request('age');
        if( !$age ) {
            return response()->json(["errno"=>-1015, "errmsg"=>"年龄必须填写"]);

        }

        $model = new UserBespoke;

        if($data = $model->bespoke(trim($user_id),trim($course_id),trim($schedule_id),trim($people_num),trim($name),trim($mobile),trim($gender),trim($age))){
            return response()->json(["errno"=>0, "errmsg"=>"",'data'=>['userinfo'=>$data]]);
        }else{
            return response()->json(["errno"=>$model->errno, "errmsg"=>$model->errmsg]);
        }
    }

     public function multiple_people(Request $request)
    {

        ini_set('memory_limit', '502M');
        $multi_arr = [];
        $arr1 = [];
        $arr2 = [];

        $user_id = Token::getCurrentUid($request);
        if( !$user_id ) {
            return response()->json(["errno"=>-1008, "errmsg"=>"用户名必须填写"]);

        }
        $arr1['user_id'] = $user_id;
        $arr2['user_id'] = $user_id;

        // 课程时间列表上的 item id
        $course_id = request('course_id');

        if( !$course_id ) {
            return response()->json(["errno"=>-1007, "errmsg"=>"课程id必须传递"]);

        }

        $arr1['course_id'] = $course_id;
        $arr2['course_id'] = $course_id;

        $people_num = request('people_num');
        if( !$people_num ) {
            return response()->json(["errno"=>-1011, "errmsg"=>"人数必须传递"]);

        }

        // 课程时间列表上的 item id
        $schedule_id = request('schedule_id');

        if( !$schedule_id ) {
            return response()->json(["errno"=>-1009, "errmsg"=>"课程所对应的当前开课id必须传递"]);

        }


        $arr1['schedule_id'] = $schedule_id;
        $arr2['schedule_id'] = $schedule_id;
        // $people_num = request('people_num');
        // if( !$people_num ) {
        //     return response()->json(["errno"=>-1011, "errmsg"=>"人数必须填写"]);

        // }
        $name1 = request('name1');
        if( !$name1 ) {
            return response()->json(["errno"=>-1012, "errmsg"=>"姓名必须填写"]);

        }
        $arr1['name'] = $name1;


        $name2 = request('name2');
        if( !$name2 ) {
            return response()->json(["errno"=>-1012, "errmsg"=>"姓名必须填写"]);

        }
        $arr2['name'] = $name2;

        $mobile = request('mobile');
        if( !$mobile ) {
            return response()->json(["errno"=>-1013, "errmsg"=>"手机号必须填写"]);

        }
        $arr1['mobile'] = $mobile;
        $arr2['mobile'] = $mobile;

        $gender1 = request('gender1');
        if( !$gender1 ) {
            return response()->json(["errno"=>-1014, "errmsg"=>"性别必须填写"]);
        }
        $arr1['gender'] = $gender1;


        $gender2 = request('gender2');
        if( !$gender2 ) {
            return response()->json(["errno"=>-1014, "errmsg"=>"性别必须填写"]);
        }
        $arr2['gender'] = $gender2;


        $age1 = request('age1');
        if( !$age1) {
            return response()->json(["errno"=>-1015, "errmsg"=>"年龄必须填写"]);

        }
        $arr1['age'] = $age1;
        $age2 = request('age2');
        if( !$age2 ) {
            return response()->json(["errno"=>-1015, "errmsg"=>"年龄必须填写"]);

        }
        $arr2['age'] = $age2;

        $multi_arr[] = $arr1;
        $multi_arr[] = $arr2;
        $model = new UserBespoke;

        if($data = $model->multi_bespoke($multi_arr,$schedule_id)){
            return response()->json(["errno"=>0, "errmsg"=>"",'data'=>['userinfo'=>$data]]);
        }else{
            return response()->json(["errno"=>$model->errno, "errmsg"=>$model->errmsg]);
        }
    }

    public function show(Request $request)
    {
        ini_set('memory_limit', '502M');
        $user_id = Token::getCurrentUid($request);
        $schedule_id = request('schedule_id');

        if( !$schedule_id ) {
            return response()->json(["errno"=>-1009, "errmsg"=>"课程所对应的当前开课id必须传递"]);

        }

        $user_bespoke = UserBespoke::where('user_id','=',$user_id)->where('schedule_id','=',$schedule_id)->get();

        if(count($user_bespoke)>0){
            return response()->json(["errno"=>0, "errmsg"=>"",'data'=>$user_bespoke]);

        }else{
            return ['errno' => '用户预约课程信息不存在','errmsg' => 60001];
        }

    }

    public function bespokeDetail(Request $request){
        ini_set('memory_limit', '502M');
        $teacher_id = AppToken::getAppTeacherUid($request);

        $course_id = request('course_id');

        if( !$course_id ) {
            return response()->json(["errno"=>-1008, "errmsg"=>"课程id必须传递"]);
        }


        $schedule_id = request('schedule_id');

        if( !$schedule_id ) {
            return response()->json(["errno"=>-1009, "errmsg"=>"课程所对应的当前开课id必须传递"]);

        }


        $bespoke_people = UserBespoke::where(['course_id'=>$course_id,'schedule_id'=>$schedule_id])->get();

        if(count($bespoke_people)>0){
            return response()->json(["errno"=>0, "errmsg"=>"",'data'=>$bespoke_people]);
        }else{
            return ['errno' => '-404','errmsg' => '无预约用户信息'];
        }


    }

    public function dismissBespoke(Request $request){
        ini_set('memory_limit', '502M');
//        $teacher_id = AppToken::getAppTeacherUid($request);

        $user_id =  Token::getCurrentUid($request);

        $course_id = request('course_id');

        if( !$course_id ) {
            return response()->json(["errno"=>-1008, "errmsg"=>"课程id必须传递"]);
        }


        $schedule_id = request('schedule_id');

        if( !$schedule_id ) {
            return response()->json(["errno"=>-1009, "errmsg"=>"课程所对应的当前开课id必须传递"]);

        }
        UserBespoke::where(['course_id'=>$course_id,'schedule_id'=>$schedule_id,'user_id'=>$user_id])->delete();

        // if(count($bespoke_people)>0){
            return response()->json(["errno"=>0, "errmsg"=>"success"]);
        // }else{
            // return ['errno' => '-404','errmsg' => '无预约用户信息'];
        // }
    }

}
