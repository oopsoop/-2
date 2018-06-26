<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;
use Closure;
use Auth;
use App\Intellectual;

class Controller extends BaseController
{
    protected $user;
    public $errorData =[];
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request){

        if($this->getCurrentAction()['method'] == 'prompt' ){

        }else if($this->getCurrentAction()['method'] == 'file_save' ){

        }else if($this->getCurrentAction()['method'] == 'pic_upload' ){

        }else{

            $this->middleware(function($request,Closure $next){
                $this->user = Auth::user();

                if($this->getCurrentAction()['controller'] == 'Users'){

                }else if($this->getCurrentAction()['controller'] == 'Roles'){

                }else if($this->getCurrentAction()['controller'] == 'Permissions'){

                }else if($request->ajax() && $this->getCurrentAction()['method'] == 'api_show'){
                    if(!$this->chkPri()){

                        $this->errorData = ['statu' => 4, 'msg' => '没有权限设置'];
                    }else{
                        $this->errorData = ['statu' => '', 'msg' => ''];
                    }
                }else if($request->ajax() && $this->getCurrentAction()['method'] == 'destroy' ) {


                    if(!$this->chkPri()){

                        $this->errorData = ['statu' => 3, 'msg' => '没有权限删除'];
                    }else{
                        $this->errorData = ['statu' => '', 'msg' => ''];
                    }
                }else{
//                        dd($this->getCurrentAction());

                    if(!$this->chkPri()){
                        return redirect('admin/prompt')->with([
                            'message' => '没有权限,请勿非法访问！',
                            'url' => '/',
                            'jumpTime' => 3,
                            'status' => 'error'
                        ]);

                    }
                }

                return $next($request);

            });

        }

//          dd(Session::getId());
//        dd(json_decode(Redis::get('user')->id));

//        if(!empty(session('user')->id)){
//            echo 1111;die;
//            return redirect('/');
//        };

//        $this->getBtns();

    }

    public function tiaoZhuan(Request $req,$datas){
//        echo $req->session()->get('_previous.url');die;

        if($_COOKIE['bkey']){

            $datas['url.intended.url'] = $_COOKIE['bkey'];
            return redirect('/')->with($datas);
            exit();
        }
        if(empty($datas['url.intended.url'])){
            // $datas['url.intended.url']=$req->session()->pull('url.intended');
            $datas['url.intended.url']=$req->session()->get('_previous.url');

        }
        return redirect('/')->with($datas);
    }

    public function tiaozhuan_ini(Request $req)
    {
        if (url()->previous() != url()->current() && url()->previous() != '/') {
            $req->session()->put('url.intended', url()->previous());

            \Cookie::queue('bkey', url()->previous(), $minutes = 9999999, $path = null, $domain = null, $secure = false, $httpOnly = false);
        }

    }

    public function prompt()
    {
        if(!empty(session('message')) && !empty(session('url')) && !empty(session('jumpTime'))){
            $data = [
                'message' => session('message'),        //提示信息
                'url' => session('url'),                //跳转的URL
                'jumpTime' => session('jumpTime'),  //跳转的时间 默认3秒
                'status' => session('status')   //状态 success error warning continue
            ];
        } else {
            $data = [
                'message' => '请勿非法访问！',
                'url' => 'javascript: history.go(-1);',
                'jumpTime' => 3,
                'status' => 'error'
            ];
        }
        //显示模板及数据
        return view('admin.prompt',compact('data'));
    }

    /*
     * 图片上传
     * $request 上传资源
     * $filepath 存储路径
     * 返回图片存储路径
     */
    public function file_save(Request $req){
        //\Debugbar::disable();
        $file_path = 'public/'.date('m').'/'.date('d');
        $path = $req->file('file')->store($file_path);
        $array = ['path'=>$path,'url'=>Storage::url($path)];
        return json_encode($array);
    }

    public function pic_upload(Request $req)
    {

        $ajaxData = $req->all();
        $qiye_id = $ajaxData['qiye_id'];
        $cate_id = $ajaxData['cate_id'];
        $doc_pic = $ajaxData['doc_pic'];
        $shoping_service = $ajaxData['shoping_service'];
        $doc_organization_code = $ajaxData['doc_organization_code'];
        $apply_date = $ajaxData['apply_date'];
        $exclusive_rights = $ajaxData['exclusive_rights'];
        $have_company = $ajaxData['have_company'];




//        $id = $id->id;

        if(Intellectual::where('qiye_id','=',$qiye_id)->where('cate_id','=',$cate_id)->exists()) {
            $obj = \DB::table('intellectuals')->where('qiye_id','=',$qiye_id)->where('cate_id','=',$cate_id)->first();

            $res = Intellectual::where('id',$obj->id)->update(['qiye_id'=> $qiye_id, 'cate_id' => $cate_id, 'doc_pic' => $doc_pic, 'shoping_service' => $shoping_service, 'doc_organization_code' => $doc_organization_code, 'apply_date' => $apply_date, 'exclusive_rights' => $exclusive_rights, 'have_company' => $have_company]);
            if($res){
                $array = ['message'=>'create ok','status'=>1];
                return json_encode($array);
            }else{
                $array = ['message'=>'create fail','status'=>2];
                return json_encode($array);
            }

        }else{
            if(false !== Intellectual::create(['qiye_id'=>$qiye_id,'cate_id'=>$cate_id,'doc_pic'=>$doc_pic,'shoping_service'=>$shoping_service,'doc_organization_code'=>$doc_organization_code,'apply_date'=>$apply_date,'exclusive_rights'=>$exclusive_rights,'have_company'=>$have_company])){
                $array = ['message'=>'create ok','status'=>1];
                return json_encode($array);
            }else{
                $array = ['message'=>'create fail','status'=>2];
                return json_encode($array);
            }
        }



    }

    /*
     * 创建select2数据
    */
    public function CreateSelect2Data($data,$key,$method=''){
        if($method == 'add' || $method == 'edit'){
            $datas[0] = ['id'=>" ",'text'=>"无"];
        }else{
            $datas[0] = ['id'=>"",'text'=>"全部"];
        }

        foreach ($data as $k => $v) {
            $datas[$k+1] = ['id'=>$v->id,'text'=>$v->$key];
        }
        return json_encode($datas,JSON_UNESCAPED_UNICODE);
    }

    /*
    * 创建global_region数据
   */
    public function CreateGlobalData($data,$key,$method='',$parameters='全部'){
        if($method == 'add' || $method == 'edit'){
            $datas[0] = ['id'=>" ",'text'=>"无"];
        }else{
            $datas[0] = ['id'=>"",'text'=>$parameters];
        }

        foreach ($data as $k => $v) {
            $datas[$k+1] = ['id'=>$v->linkageid,'text'=>$v->$key];
        }
        return json_encode($datas,JSON_UNESCAPED_UNICODE);
    }

    // 找一个分类所有子分类的ID
    public function getChildren($catId=0,$table='categorys')
    {
        // 取出所有的分类
        $data = \DB::select("select * from $table");
        // 递归从所有的分类中挑出子分类的ID
        return $this->_getChildren($data, $catId, TRUE);
    }
    /**
     * 递归从数据中找子分类
     */
    private function _getChildren($data, $catId, $isClear = FALSE)
    {
        static $_ret = array();  // 保存找到的子分类的ID
        if($isClear)
            $_ret = array();
        // 循环所有的分类找子分类
        foreach ($data as $k => $v)
        {
            if($v->pid == $catId)
            {
                $_ret[] = $v->id;
                // 再找这个$v的子分类
                $this->_getChildren($data, $v->id);
            }
        }
        return $_ret;
    }
    // 获取树形数据
    public function getTree($table='categorys')
    {
        $data = \DB ::select("select * from $table");
        return $this->_getTree($data);
    }
    private function _getTree($data, $pid=0, $level=0)
    {
        static $_ret = array();
        foreach ($data as $k => $v)
        {
            if($v->pid == $pid)
            {
                $v->level = $level;  // 用来标记这个分类是第几级的
                $v->name = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$level).'|----'.$v->name;  // 用来标记这个分类是第几级的
                $_ret[] = $v;
                // 找子分类
                $this->_getTree($data, $v->id, $level+1);
            }
        }
        return $_ret;
    }
    //从子类开始逐级向上获取其父类
    public function getParentCategory($cid,&$category=array())
    {
        $data = \DB::select("select * from categorys where id = ? ",[$cid]);
        foreach ($data as $k=>$v){
            $category[] = $v;
            $this->getParentCategory($v->pid,$category);
        }
        krsort($category);
        return $category;
    }
    public function displayParentCategory($cid)
    {
        $result = $this->getParentCategory($cid);
        $str = '';
        foreach ($result as $item){
            $str .= '<a href="'.$item->id.'">'.$item->cname.'</a> > ';
        }
        return substr($str,0,strlen($str) - 1);
    }
    //从当前分类找其子分类
    public function getChildCategory($cid,&$category=array())
    {
        $data = \DB::select("select * from enterprises where pid = ? ",[$cid]);
        foreach ($data as $k=>$v){
            $category[] = $v;
//            $this->getChildCategory($v->id,$category);
        }
        krsort($category);
        return $category;
    }

    public function getChildCategory2($cid,$type,&$category=array())
    {
        if($type == 'add'){
            $data = \DB::select("select * from latestpolicys where  type = ? ",[$type]);
        }else{
            $data = \DB::select("select * from latestpolicys where pid = ? and type = ?",[$cid,$type]);
        }

        foreach ($data as $k=>$v){
            $category[] = $v;
        }
        krsort($category);
        return $category;
    }
    function getCurrentAction()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);
        $class = substr(strrchr($class,'\\'),1);
        $class = substr($class, 0, -10);

        return ['controller' => $class, 'method' => $method];
    }
    /**
     * 检查当前管理员是否有权限访问这个页面
     */
    public function chkPri()
    {
        // 获取当前管理员正要访问的模型名称、控制器名称、方法名称
        // tP中正带三个常量
        //MODULE_NAME , CONTROLLER_NAME , ACTION_NAME
        $adminId = $this->user->id;

        // 如果是超级管理员直接返回 TRUE
        if($adminId == 1){
            return TRUE;
        }

//        echo $this->getCurrentAction()['controller'];
//        echo $this->getCurrentAction()['method'];die;
        $has = \DB::table('model_has_roles')
            ->leftJoin('role_has_permissions', 'model_has_roles.role_id','=','role_has_permissions.role_id')
            ->leftJoin('permissions','role_has_permissions.permission_id','=','permissions.id')
            ->where('model_has_roles.model_id','=',$adminId)
            ->where('permissions.controller_name','=',$this->getCurrentAction()['controller'])
            ->where('permissions.action_name','=',$this->getCurrentAction()['method'])
            ->count();

        return ($has > 0);

    }


}
