<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\CourseTable;

class UserBespoke extends Model
{

    protected $table = 'user_bespoke';
    protected $fillable = [
        'user_id','course_id','schedule_id','people_num','name','mobile','gender','age','id','hasqiandao'
    ];
    protected $hidden = [
        'remember_token',
    ];
    public $errno = 0;
    public $errmsg = "";

    public function wxuser()
    {
        return $this->belongsTo('App\Wxuser','user_id','id');
    }
    public function course()
    {
        return $this->belongsTo('App\Course','course_id','id');
    }
    public function coursetable()
    {
        return $this->belongsTo('App\Course','course_id','id');
    }

    public function bespoke($user_id,$course_id,$schedule_id,$people_num,$name,$mobile,$gender,$age)
    {
        if (strlen($mobile) != 11) {
            $this->errno = -1002;
            $this->errmsg = "手机号必须是11位";

            return false;
        }
        if (!preg_match("/^1[34578]{1}\d{9}$/", $mobile)) {
            $this->errno = -1003;
            $this->errmsg = "手机号码格式不对";

            return false;
        }
        \DB::connection()->disableQueryLog();
        if ($this::where('user_id', '=', $user_id)->where('schedule_id', '=', $schedule_id)->exists()) {
            $obj = \DB::table('user_bespoke')->where('user_id','=',$user_id)->where('schedule_id','=',$schedule_id)->first();
            $res = $this::where('id',$obj->id)->update(['people_num'=> $people_num,'name'=>$name, 'mobile' => $mobile, 'gender' => $gender, 'age'=>$age]);
//            $res = Intellectual::where('id',$obj->id)->update(['qiye_id'=> $qiye_id, 'cate_id' => $cate_id, 'doc_pic' => $doc_pic, 'shoping_service' => $shoping_service, 'doc_organization_code' => $doc_organization_code, 'apply_date' => $apply_date, 'exclusive_rights' => $exclusive_rights, 'have_company' => $have_company]);
            if($res){
                return true;
//                $array = ['message'=>'create ok','status'=>1];
//                return json_encode($array);
            }else{
                $this->errno = -2006;
                $this->errmsg = "预约失败";
                return false;
            }
        } else {
            $user = $this->create(compact('user_id', 'course_id','schedule_id', 'people_num', 'name', 'mobile', 'gender', 'age'));

            if (!$user) {
                $this->errno = -1007;
                $this->errmsg = "预约失败，写入数据失败";

                return false;
            }

            CourseTable::where('id','=',$schedule_id)->decrement('default_num',1);
            return true;

        }




    }

    public function multi_bespoke($multi_arr,$schedule_id)
    {
        \DB::connection()->disableQueryLog();
        $ret = [];

        for($i=0;$i<count($multi_arr);$i++){

                    $ret[] = [
                        'user_id' => $multi_arr[$i]['user_id'],
                        'course_id'=> $multi_arr[$i]['course_id'],
                        'schedule_id'=> $multi_arr[$i]['schedule_id'],
                        'name'=> $multi_arr[$i]['name'],
                        'mobile'=> $multi_arr[$i]['mobile'],
                        'gender'=> $multi_arr[$i]['gender'],
                        'age'=> $multi_arr[$i]['age']

                    ];
        }


        $this::insert($ret);
        CourseTable::where('id','=',$schedule_id)->decrement('default_num',2);
        return true;

    }

//        if (strlen($mobile) != 11) {
//            $this->errno = -1002;
//            $this->errmsg = "手机号必须是11位";
//
//            return false;
//        }
//        if (!preg_match("/^1[34578]{1}\d{9}$/", $mobile)) {
//            $this->errno = -1003;
//            $this->errmsg = "手机号码格式不对";
//
//            return false;
//        }

//        if ($this::where('user_id', '=', $user_id)->where('schedule_id', '=', $schedule_id)->exists()) {
//            $obj = \DB::table('user_bespoke')->where('user_id','=',$user_id)->where('schedule_id','=',$schedule_id)->first();
//            $res = $this::where('id',$obj->id)->update(['people_num'=> $people_num,'name'=>$name, 'mobile' => $mobile, 'gender' => $gender, 'age'=>$age]);
////            $res = Intellectual::where('id',$obj->id)->update(['qiye_id'=> $qiye_id, 'cate_id' => $cate_id, 'doc_pic' => $doc_pic, 'shoping_service' => $shoping_service, 'doc_organization_code' => $doc_organization_code, 'apply_date' => $apply_date, 'exclusive_rights' => $exclusive_rights, 'have_company' => $have_company]);
//            if($res){
//                return true;
////                $array = ['message'=>'create ok','status'=>1];
////                return json_encode($array);
//            }else{
//                $this->errno = -2006;
//                $this->errmsg = "预约失败";
//                return false;
//            }
//        } else {
//            $user = $this->create(compact('user_id', 'course_id','schedule_id', 'people_num', 'name', 'mobile', 'gender', 'age'));
//            if (!$user) {
//                $this->errno = -1007;
//                $this->errmsg = "预约失败，写入数据失败";
//
//                return false;
//            }
//            CourseTable::where('id','=',$schedule_id)->update(['course_status'=>1]);
//            return true;
//
//        }


    public function bespokeDetail(){

    }

}
