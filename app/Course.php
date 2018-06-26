<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CourseTable;
use App\UserBespoke;
class Course extends Model
{
    public $errno = 0;
    public $errmsg = "";
    protected $table = 'courses';

    protected $fillable = ['id','course_name','teacher_id','stadium_id','course_explain','default_num','course_grade','is_setup','started_at','end_at','qrcode','status_id','period'];
    protected $hidden = ['started_at','end_at'];
    public function wxusers()
    {
        return $this->belongsToMany(Wxuser::class);
    }
    public function xi()
    {
        return $this->belongsTo('App\Status_t','status_id','id');

    }
    public function coursetable()
    {
        return $this->hasMany('App\CourseTable','course_id','id');
    }

    public function coursegrade()
    {
        return $this->belongsTo('App\Status_t','course_grade','id');

    }
    // one o // 所属关系
    public function oteacher()
    {
        return $this->belongsTo('App\Teacher', 'teacher_id', 'id');
    }
    public function isetup()
    {
        return $this->belongsTo('App\Status_t','is_setup','id');
    }
    public function own_stadium()
    {
        return $this->belongsTo('App\Stadium','stadium_id','id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher','teacher_id','id');
    }

    public function coursebespoke()
    {
        return $this->hasOne('App\UserBespoke','course_id','id');
    }

    public function getOne($id,$user_id)
    {
        ini_set('memory_limit', '512M');
        $content = $this::find($id);

//        $status_name = \App\Status_t::findOrFail($content->no_id)->status_name;
//        $content['stadium_no']=$status_name;

        $courseTable = $this->getCourseTable($id);

        $user_bespoke = UserBespoke::where(['user_id'=>$user_id,'course_id'=>$id])->select('schedule_id')->distinct()->get()->all();

//        // 剩余名额数据计算
//        $user_bespoke = UserBespoke::where(['course_id'=>$id])->select('schedule_id')->distinct()->get()->all();

        if(isset($user_bespoke)){
            $temp_arr = [];
            foreach($user_bespoke as $k1=>$v1){
                $temp_arr[] = $v1->schedule_id;
            }
        }
        //判断用户是否预约了这个course的schedule
        if(count($courseTable)>0){

            foreach($courseTable as $k=>&$v){
                if (in_array($v['id'],$temp_arr)) {
                      // bespoke_status 1:预约 2：已预约
                      $v['bespoke_status'] = '2';
                }else{
                    $v['bespoke_status'] = '';
                }
            }
        }
        $content->courseTable = $courseTable;
        if (!count($content)) {
            return false;
        }
        return $content;
    }

    public function getQianDao($id,$schedule_id,$user_id)
    {

//        $sd = $this::find($id);
//        return $sd;die;
        $content = $this::with('own_stadium')->with('teacher')->with(['coursetable' => function ($q) use ($schedule_id) {
            $q->where('id', '=', $schedule_id);
        }])->find($id);

        $has_someone = UserBespoke::where(['course_id' => $id, 'schedule_id' => $schedule_id, 'user_id' => $user_id])->get();
        

        if (count($has_someone) > 0) {

            $content->mybespokepeople = $has_someone;
        }

        return $content;
    }
    public function selectUserBespoke($id,$schedule_id,$user_id,$hasqiandao){



    }

    public function getCourseTable($id){
//        return CourseTable::where('course_id','=',$id)->select('id','course_id','started_at','end_at','course_status')->get()->all();
        return CourseTable::where('course_id','=',$id)->selectRaw('id,default_num,course_id,started_at as origin_started_at,end_at as origin_end_at,DATE_FORMAT(started_at,"%H:%i") as started_at,DATE_FORMAT(end_at,"%H:%i") as end_at,course_status')->get()->all();

    }

}

