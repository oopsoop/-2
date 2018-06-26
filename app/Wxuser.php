<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Wxuser extends Model
{

    protected $table = 'wxusers';
    protected $fillable = [
        'nickName','email','openid','token','avatarUrl','gender','age','city','province','country','unionId'
    ];
    protected $hidden = [
        'remember_token',
    ];
    public $errno = 0;
    public $errmsg = "";
    public $isLogin = [];
    public function wxuserbespoke()
    {
        return $this->hasOne('App\UserBespoke','user_id','id');
    }
    public function qiandaos()
    {
        return $this->belongsToMany(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher','wechat','id');

    }
    /**
     * 用户是否存在
     * 存在返回uid，不存在返回0
     */
    public static function getByOpenID($openid)
    {
        $user = self::where('openid', '=', $openid)
            ->get();
        return $user;
    }

    public static function wxuser($x)
    {

        $user = self::where('openid', '=', $x)
            ->get();
        return $user;
    }







}
