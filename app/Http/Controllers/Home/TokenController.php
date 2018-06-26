<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;
use App\UserToken;
use App\Wxuser;
use App\Teacher;
use App\Service\Token;

/**
 * 获取令牌，相当于登录
 */

class TokenController extends Controller
{
    /**
     * 用户获取令牌（登陆）
     * @url /token
     * @POST code
     * @note 虽然查询应该使用get，但为了稍微增强安全性，所以使用POST
     */
    public function post_myuser(Request $request){
        ini_set('memory_limit', '512M');
        $user_id =  Token::getCurrentUid($request);
        $userInfo = request('userInfo');

        $isValid = Wxuser::where('id',$user_id)->update(['nickName'=>$userInfo['nickName'],'gender'=>$userInfo['gender'],'avatarUrl'=>$userInfo['avatarUrl'],'city'=>$userInfo['city'],'province'=>$userInfo['province'],'country'=>$userInfo['country']]);
        return [
            'isValid' => $isValid
        ];
    }
    public function auth_teacher(Request $request){
        $user_id =  Token::getCurrentUid($request);
        $count = Teacher::where('wechat',$user_id)->get();
        if(count($count)>0){
            return [
                'isauth' => true
            ];
        }else{
            return [
                'isauth' => false
            ];
        }
    }
    public function wxuser(Request $request)
    {


         $user_id =  Token::getCurrentUid($request);
         $wxuser = Wxuser::find($user_id);
         return $wxuser->toJson();
//        $token = $request->header('token');
//        echo $token;
//        $token = request('token','');

//        $df = \Cache::put('aa','wwwwwwwwww23',1200);
//        echo $df;
//        $re = \Cache::get($token);
//
//        print_r($re);die;
//        $expire_in = config('wx.token_expire_in');
//        echo $expire_in;die;
//        $x = request('x');
//        if(!$x){
//            return response()->json(['errcode'=>-1,'errmsg'=>'whoops!']);
//        }
//        return Wxuser::wxuser($x);
//        return app(\App\Wxuser::class)->wxuser($x);
    }
    public function getToken()
    {
       // (new TokenGet())->goCheck();

        $code = request('code','');
        $encryptedData = request('encryptedData','');
        $iv = request('iv','');

        $wx = new UserToken($code,$encryptedData,$iv);
        $ARR = $wx->get();
        return [
            'token' => $ARR['token'],
            'openid'=> $ARR['openid']
        ];
    }

    /**
     * 第三方应用获取令牌
     * @url /app_token?
     * @POST ac=:ac se=:secret
     */
    public function getAppToken($ac='', $se='')
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET');
        (new AppTokenGet())->goCheck();
        $app = new AppToken();
        $token = $app->get($ac, $se);
        return [
            'token' => $token
        ];
    }

    public function verifyToken()
    {

        $token = request('token');

        if(!$token){
            return [
                'token不允许为空'
            ];
        }
        $valid = self::verifyTokenIsValid($token);
        return [
            'isValid' => $valid
        ];
    }

    public static function verifyTokenIsValid($token)
    {
//        $token = request($token);
        $exist = \Cache::get($token);
        if($exist){
            return true;
        }
        else{
            return false;
        }
    }
}
