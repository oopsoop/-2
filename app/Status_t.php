<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_t extends Model
{
    protected $table = 'status_t';
    protected $fillable = ['id','status_name'];

    public function coursegrade()
    {
        return $this->hasOne('App\Course','course_grade','id');
    }

    public function isetup()
    {
        return $this->hasOne('App\Course','is_setup','id');
    }

    public function xi()
    {
        return $this->hasOne('App\Course','status_id','id');

    }

    public function no()
    {
        return $this->hasOne('App\Stadium','no_id','id');

    }
    public function isorder()
    {
        return $this->hasOne('App\CourseTable','is_order','id');

    }

    public function getStadiumByXiBieId($id)
    {
        $content = $this::find($id);
        if(!count($content)){
            return false;
        }else{
            return true;
        }
    }



}
