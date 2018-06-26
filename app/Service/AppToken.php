<?php


namespace App\Service;

use Illuminate\Http\Request;
use App\Teacher;

class AppToken extends Token
{

    public function get($ac, $se)
    {

        $app = Teacher::check($ac, $se);


        if(count($app)>0)
        {
            //            $scope = $app->scope;
            $uid = $app[0]->id;
            $values = [
//                'scope' => $scope,
                'teacher_uid' => $uid
            ];
            $token = $this->saveToCache($values);
            return $token;

        }
        else{
            throw new \Exception('授权失败');

        }
    }

    public static function getAppTokenVar(Request $request,$key){
        $token = $request->header('teacher-token');


        $vars = \Cache::get($token);
        // print_r($vars);die;
        if (!$vars)
        {
            throw new \Exception('尝试获取的teacher-token变量并不存在或已过期');

        }
        else {
            if(!is_array($vars))
            {
                $vars = json_decode($vars, true);
            }
            if (array_key_exists($key, $vars)) {
                return $vars[$key];
            }
            else{
                throw new \Exception('尝试获取的teacher-token变量并不存在或已过期');
            }
        }
    }
    //appToken
    public static function getAppTeacherUid(Request $request){
        $teacher_uid = self::getAppTokenVar($request,'teacher_uid');
        return $teacher_uid;
    }

    private function saveToCache($values){
        $token = self::generateToken();
        $expire_in = config('wx.token_expire_in');
        \Cache::put($token,json_encode($values),$expire_in);
//        $result = \Cache($token, json_encode($values), $expire_in);
//        if(!$result){
//            throw new TokenException([
//                'msg' => '服务器缓存异常',
//                'errorCode' => 10005
//            ]);
//        }
        return $token;
    }
}