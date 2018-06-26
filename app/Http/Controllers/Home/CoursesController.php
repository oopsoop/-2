<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;

use App\Course;
use App\Wxuser;
use App\Status_t;
use App\UserBespoke;
use App\Service\Token;


class CoursesController extends Controller
{

    public function getStadiumByXiBieId()
    {
        ini_set('memory_limit', '502M');

        $id = request('id');
        if(!$id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到id"]);
        }
        $model = new Status_t();
        if($model->getStadiumByXiBieId($id ) ) {

//            $course_data = Course::where('status_id','=',$id)->select('id','course_name','course_explain')->with('own_stadium')->get();
            $course_data = \DB::table('courses')->where('is_setup','=',24)->join('stadiums','stadiums.id','=','courses.stadium_id')->where('courses.status_id','=',$id)->select('courses.id','course_name','course_explain','stadiums.stadium_name')->get();
            if(!count($course_data)){
                return response()->json([
                    "errno"=>0,
                    "errmsg"=>"",
                    "course_data"=>[],
                ]);
            }else{
                return response()->json([
                    "errno"=>0,
                    "errmsg"=>"",
                    "course_data"=>$course_data,
                ]);
            }


        } else {
            return response()->json([  "errno"=>-2012, "errmsg"=>"获取课程信息失败"]);
        }

    }

    public function getOne(Request $request)
    {
        ini_set('memory_limit', '502M');

        $id = request('id');

        // TODO: 为了判断用户是否预约了关于这个course的schedule_id 需要用户传 token
        $user_id = Token::getCurrentUid($request);
        if(!$id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到id"]);
        }
        $model = new Course();
        if($data = $model->getOne($id,$user_id) ) {
//            return $data;
            return response()->json([  "errno"=>0,"errmsg"=>"","data"=>$data]);

        } else {
            return response()->json([  "errno"=>-2012, "errmsg"=>"获取课程信息失败"]);
        }
    }
    //签退
    public function signout(Request $request){
        ini_set('memory_limit', '502M');

        $user_id = Token::getCurrentUid($request);
        $course_id = request('course_id');
        if(!$course_id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到课程id"]);
        }

        $schedule_id = request('schedule_id','');
        if(!$schedule_id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到课时id"]);
        }
        \DB::connection()->disableQueryLog();
        $signout = \DB::table('course_wxuser')->where(['course_id'=>$course_id,'wxuser_id'=>$user_id,'schedule_id'=>$schedule_id])->update(['signout'=>1]);
//        if( $signout == 1){
            return response()->json(["errno"=>0, "errmsg"=>"",'data'=>['signout'=>'success']]);
//        }else{
//            return response()->json(["errno"=>-500, "errmsg"=>'error']);
//        }

    }
    public function getQianDao(Request $request){
//        ini_set('memory_limit', '512M');
        $user_id = Token::getCurrentUid($request);

        $course_id = request('course_id');

        if(!$course_id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到课程id"]);
        }

        $schedule_id = request('schedule_id','');
        if(!$schedule_id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到课时id"]);
        }

        \DB::connection()->disableQueryLog();
        //判断用户有没有预约这个课时
        if(!UserBespoke::where(['course_id'=>$course_id,'user_id'=>$user_id,'schedule_id'=>$schedule_id])->count()){
            return response()->json([  "errno"=>0,"errmsg"=>"未找到二维码对应的课程，请先预约课程","data"=>'nofound']);
        }

        $wxuser = Wxuser::find($user_id);
        // 签到成功后是否还能再签？ 覆盖写  or 追加写
        //if(){

        //}
        // TODO: qiandao_status: ‘’ or null 未知 1 签到 2 签退
        
        $has = \DB::table('course_wxuser')->where(['course_id'=>$course_id,'wxuser_id'=>$user_id,'schedule_id'=>$schedule_id])->count();
        // 2次或多次签到，通过更新 updated_at 跟 第一次的不同以及记录qiandao_num 判断
        if($has > 0){

            $qiandao_status = request('qiandao_status','');
            if($qiandao_status == 2){
                $res = \DB::table('course_wxuser')->where(['course_id'=>$course_id,'wxuser_id'=>$user_id,'schedule_id'=>$schedule_id])->update(['updated_at'=> date('Y-m-d H:i:s',time()),'qiandao_status'=>$qiandao_status]);
            }else{
                $res = \DB::table('course_wxuser')->where(['course_id'=>$course_id,'wxuser_id'=>$user_id,'schedule_id'=>$schedule_id])->increment('qiandao_num',1,['updated_at'=> date('Y-m-d H:i:s',time()),'qiandao_status'=>1]);
            }



        }else{
//            \DB::table('course_wxuser')->insert([
//                ['course_id'=>$course_id,'wxuser_id'=>$user_id,'created_at'=> date('Y-m-d H:i:s',time()),'updated_at'=> date('Y-m-d H:i:s',time()),'qiandao_status'=>1,'qiandao_num'=>1,'schedule_id'=>$schedule_id]
//            ]);
//            $wxuser->qiandaos()->attach($course_id);
//            \DB::table('course_wxuser')->where(['course_id'=>$course_id,'wxuser_id'=>$user_id])->update(['created_at'=> date('Y-m-d H:i:s',time()),'updated_at'=> date('Y-m-d H:i:s',time()),'qiandao_status'=>1,'qiandao_num'=>1,'schedule_id'=>$schedule_id]);
        }

//      return \DB::table('course_wxuser')->where(['course_id'=>$id,'wxuser_id'=>$user_id])->get();die;


        $model = new Course();

        if($data = $model->getQianDao($course_id,$schedule_id,$user_id)){

            return response()->json([  "errno"=>0,"errmsg"=>"","data"=>$data]);

        } else {
            return response()->json([  "errno"=>-2012, "errmsg"=>"获取课程信息失败"]);
        }
    }
    public static function array_unique_fb($array2D){
        foreach ($array2D as $v){
            $v = implode(",",$v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
            $temp[] = $v;
        }
        $temp = array_unique($temp);    //去掉重复的字符串,也就是重复的一维数组
        foreach ($temp as $k => $v){
            $temp[$k] = explode(",",$v);   //再将拆开的数组重新组装
        }
        return $temp;
    }
    // todo 我的预约
    public function mybespoke(Request $request)
    {
            ini_set('memory_limit', '502M');

            $user_id =  Token::getCurrentUid($request);
           // return 111;die;
            //获取用户预约的课程id和课程相关的schedule_id

            //通过用户的 user_id找   course_id------schedule_id
            //再查找和这个用户的      course_id------schedule_id
            //对应的     user_id
            //

            // todo: (1)
            // todo:一个用户假如预定了一个课时的，那么对应的就存在一条和这个用户相关的 course_id和 schedule_id
            // todo: 那么相应的就可以查找到和这个 course_id 和 schedule_id 相同的    user_id
            // todo: (2)
            // todo:一个用户预约了多个课时，那么就可以查找对应的和每个课时相关的 course_id 和 schedule_id 相同的 user_id
            //

            //再获取其他预约了这个课的人
            // todo: 获取当前用户的所有 course_id 和 schedule_id
            $user_bespoke = UserBespoke::where('user_id','=',$user_id)->select('course_id','schedule_id')->get()->all();
            if(count($user_bespoke)>0){
                $temparr = [];
                foreach ($user_bespoke as $kk=>$vv){

                    $temparr[$kk]['course_id'] = $vv['course_id'];
                    $temparr[$kk]['schedule_id'] = $vv['schedule_id'];
                }

                $user_bespoke = self::array_unique_fb($temparr);

            }
            //return $user_bespoke;
            // todo: 查找和当前用户的每个 course_id 和 schedule_id 一样的 其他记录 （此处是取user_id 还是 name 有待商议）
            $users = [];
            foreach($user_bespoke as $k=>&$v){

    //            $users[] = UserBespoke::where(['course_id'=>$v['course_id'],'schedule_id'=>$v['schedule_id']])->select('id','user_id','course_id','schedule_id','name')->with('course.own_stadium')->with(['course.coursetable'=>function($query) use ($v){
                $users[] = UserBespoke::where(['course_id'=>$v[0],'schedule_id'=>$v[1]])->select('id','user_id','course_id','schedule_id','name')->with('course.own_stadium')->with(['course.coursetable'=>function($query) use ($v){
                    $query->where('id',$v[1]);
                }])->with('wxuser')->get();
    //                $query->where('id',$v['schedule_id']);
    //                $query->where('id',$v['schedule_id']);
    //            }])->with('wxuser')
    //            }])->with('wxuser')->get();
            }


            return response()->json([  "errno"=>0,"errmsg"=>"","data"=>$users]);

    //        $course_arr = [];
    //        foreach ($user_bespoke as $k=>$v){
    //            $course_arr[] = $v['course_id'];
    //        }
    //        $course_arr = array_unique($course_arr,SORT_NUMERIC);
    //        return $course_arr;die;
    //        $wxuser = Wxuser::find($user_id);
    //        return $wxuser->toJson();
        }

    //我的记录
    // todo 我的预约
    public function myRecord(Request $request)
    {
        ini_set('memory_limit', '502M');

        $user_id =  Token::getCurrentUid($request);
        // return 111;die;
        //获取用户预约的课程id和课程相关的schedule_id

        //通过用户的 user_id找   course_id------schedule_id
        //再查找和这个用户的      course_id------schedule_id
        //对应的     user_id
        //

        // todo: (1)
        // todo:一个用户假如预定了一个课时的，那么对应的就存在一条和这个用户相关的 course_id和 schedule_id
        // todo: 那么相应的就可以查找到和这个 course_id 和 schedule_id 相同的    user_id
        // todo: (2)
        // todo:一个用户预约了多个课时，那么就可以查找对应的和每个课时相关的 course_id 和 schedule_id 相同的 user_id
        //

        //再获取其他预约了这个课的人
        // todo: 获取当前用户的所有 course_id 和 schedule_id
        $user_bespoke = UserBespoke::where('user_id','=',$user_id)->select('course_id','schedule_id')->get()->all();
        if(count($user_bespoke)>0){
            $temparr = [];
            foreach ($user_bespoke as $kk=>$vv){

                $temparr[$kk]['course_id'] = $vv['course_id'];
                $temparr[$kk]['schedule_id'] = $vv['schedule_id'];
            }

            $user_bespoke = self::array_unique_fb($temparr);

        }
        //return $user_bespoke;
        // todo: 查找和当前用户的每个 course_id 和 schedule_id 一样的 其他记录 （此处是取user_id 还是 name 有待商议）
        $users = [];
        foreach($user_bespoke as $k=>&$v){

            //            $users[] = UserBespoke::where(['course_id'=>$v['course_id'],'schedule_id'=>$v['schedule_id']])->select('id','user_id','course_id','schedule_id','name')->with('course.own_stadium')->with(['course.coursetable'=>function($query) use ($v){
            $qiandao_qiantui = \DB::table('course_wxuser')->where(['wxuser_id'=>$user_id,'course_id'=>$v[0],'schedule_id'=>$v[1],'signout'=>1])->exists();
            if($qiandao_qiantui){
                $users[] = UserBespoke::where(['course_id'=>$v[0],'schedule_id'=>$v[1]])->select('id','user_id','course_id','schedule_id','name')->with('course.own_stadium')->with(['course.coursetable'=>function($query) use ($v){
                    $query->where('id',$v[1]);
                }])->with('wxuser')->get();
            }
            //                $query->where('id',$v['schedule_id']);
            //                $query->where('id',$v['schedule_id']);
            //            }])->with('wxuser')
            //            }])->with('wxuser')->get();
        }


        return response()->json([  "errno"=>0,"errmsg"=>"","data"=>$users]);

        //        $course_arr = [];
        //        foreach ($user_bespoke as $k=>$v){
        //            $course_arr[] = $v['course_id'];
        //        }
        //        $course_arr = array_unique($course_arr,SORT_NUMERIC);
        //        return $course_arr;die;
        //        $wxuser = Wxuser::find($user_id);
        //        return $wxuser->toJson();
    }
    public function getCourseDetail(Request $request){
        ini_set('memory_limit', '502M');

        $user_id =  Token::getCurrentUid($request);

        $course_id = request('course_id');
        if(!$course_id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到课程id"]);
        }
        $schedule_id = request('schedule_id');
        if(!$schedule_id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到课程所对应的schedule_id"]);
        }
        $users[] = UserBespoke::where(['course_id'=>$course_id,'schedule_id'=>$schedule_id])->select('id','user_id','course_id','schedule_id','name')->with('course.own_stadium')->with(['course.coursetable'=>function($query) use ($schedule_id){
            $query->where('id',$schedule_id);
        }])->with('wxuser')->get();



        return response()->json([  "errno"=>0,"errmsg"=>"","data"=>$users]);
    }

    public function selectUserBespoke(Request $request){
        ini_set('memory_limit', '512M');
        $user_id = Token::getCurrentUid($request);

        $course_id = request('course_id');
        if(!$course_id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到课程id"]);
        }

        $schedule_id = request('schedule_id','');
        if(!$schedule_id){
            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到课时id"]);
        }

        $hasqiandao = request('hasqiandao','');
//        if(!$hasqiandao){
//            return response()->json([  "errno"=>-404, "errmsg"=>"未获取到课时id"]);
//        }

        \DB::connection()->disableQueryLog();

        $wxuser = Wxuser::findOrFail($user_id);
        if(strlen($hasqiandao)>0){
            $qiandaoArr = explode("&",$hasqiandao);
            foreach ($qiandaoArr as $v){
                $temparr = explode('=',$v);
                if($temparr[1]){
                    UserBespoke::where(['course_id' => $course_id, 'schedule_id' => $schedule_id, 'user_id' => $user_id])->update(['id'=>$temparr[1],'hasqiandao'=>$temparr[1]]);
                }

            }
        }
        return response()->json(["errno"=>0, "errmsg"=>"",'data'=>'success']);
//        $model = new Course();
//
//
//        if($data = $model->selectUserBespoke($course_id,$schedule_id,$user_id,$hasqiandao)){
//
//            return response()->json([  "errno"=>0,"errmsg"=>"","data"=>$data]);
//
//        } else {
//            return response()->json([  "errno"=>-2012, "errmsg"=>"获取课程信息失败"]);
//        }
    }


}
