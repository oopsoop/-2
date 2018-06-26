<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CourseTable extends Model
{
    public $errno = 0;
    public $errmsg = "";
    protected $table = 'course_tables';


    // course_status: 课程状态 空：预约 1：已预约 2：已结束 3: 满员

    protected $fillable = ['id','course_id','started_at','end_at','is_order','course_status','default_num','qrcode'];


    public function no()
    {
        return $this->belongsTo('App\Status_t','no_id','id');

    }

    public function isorder()
    {
        return $this->belongsTo('App\Status_t','is_order','id');

    }
    public function course()
    {

        return $this->belongsTo('App\Course', 'course_id', 'id');
    }
    public function getStadiumById($id)
    {
        $content = $this::find($id);
        $status_name = \App\Status_t::find($content->no_id)->status_name;
        $content['stadium_no']=$status_name;
        if(!count($content)){
            return false;
        }
        return $content;
    }

    //批量更新
    public function updateBatch($multipleData = [])
    {
        \DB::connection()->disableQueryLog();
        try {
            if (empty($multipleData)) {
                throw new \Exception("数据不能为空");
            }
            $tableName = DB::getTablePrefix() . $this->getTable(); // 表名
            $firstRow  = current($multipleData);

            $updateColumn = array_keys($firstRow);
            // 默认以id为条件更新，如果没有ID则以第一个字段为条件
            $referenceColumn = isset($firstRow['id']) ? 'id' : current($updateColumn);
            unset($updateColumn[0]);
            // 拼接sql语句
            $updateSql = "UPDATE " . $tableName . " SET ";
            $sets      = [];
            $bindings  = [];
            foreach ($updateColumn as $uColumn) {
                $setSql = "`" . $uColumn . "` = CASE ";
                foreach ($multipleData as $data) {
                    $setSql .= "WHEN `" . $referenceColumn . "` = ? THEN ? ";
                    $bindings[] = $data[$referenceColumn];
                    $bindings[] = $data[$uColumn];
                }
                $setSql .= "ELSE `" . $uColumn . "` END ";
                $sets[] = $setSql;
            }
            $updateSql .= implode(', ', $sets);
            $whereIn   = collect($multipleData)->pluck($referenceColumn)->values()->all();
            $bindings  = array_merge($bindings, $whereIn);
            $whereIn   = rtrim(str_repeat('?,', count($whereIn)), ',');
            $updateSql = rtrim($updateSql, ", ") . " WHERE `" . $referenceColumn . "` IN (" . $whereIn . ")";
            // 传入预处理sql语句和对应绑定数据
            return DB::update($updateSql, $bindings);
        } catch (\Exception $e) {
            return false;
        }
    }

}

