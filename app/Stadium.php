<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CourseTable;
class Stadium extends Model
{
    public $errno = 0;
    public $errmsg = "";
    protected $table = 'stadiums';


    protected $fillable = ['id','stadium_name','district','stadium_pic','status_id','latitude','longitude','distance','search_addr','no_id'];

    //场馆编号
    public function no()
    {
        return $this->belongsTo('App\Status_t','no_id','id');

    }

    public function course()
    {
        return $this->hasOne('App\Course','stadium_id','id');
    }
    //
//
//    public function getStadiumById($id)
//    {
//        $content = $this::find($id);
//        $status_name = \App\Status_t::findOrFail($content->no_id)->status_name;
//        $content['stadium_no']=$status_name;
//
//        $courseTable = $this->getCourseTable($id);
//
//        if(!count($content)){
//            return false;
//        }
//        return $content;
//    }




    public function Wxuser()
    {
        return $this->belongsTo('App\Wxuser','corp_uid','id');

    }


}

