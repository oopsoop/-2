<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service\AppToken;


class Teacher extends Model
{

    protected $table = 'teachers';
    protected $fillable = [
        'wechat','plancourse','name','account','password','mobile','nickName','email','openid','token','avatarUrl','gender','age','city','province','country','unionId'
    ];
    protected $hidden = [
        'remember_token',
    ];
    public $errno = 0;
    public $errmsg = "";
    public $isLogin = [];

    public function course()
    {
        return $this->hasOne('App\Course','teacher_id','id');
    }
    //many   m
    public function mcourse()
    {
        return $this->hasMany('App\Course','teacher_id','id');
    }


    public function wxuser()
    {
        return $this->hasOne('App\Wxuser','wechat','id');
    }
    //

    public static function check($ac='', $se='')
    {
        // todo: 密码要处理
        $app = self::where('account','=',$ac)
            ->where('password', '=',$se)
            ->get();
        return $app;


    }
    public function login($ac='', $se=''){

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET, POST');
//        (new AppTokenGet())->goCheck();
        $app = new AppToken();
        $token = $app->get($ac, $se);
        return $token;
    }



}
