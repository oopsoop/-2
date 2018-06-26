<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LatestPolicy;
use Validator;

class LatestPolicyController extends Controller
{
    protected $model;
    protected $gl;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->showdata['nav'] = 'latestpolicy';
        $this->model = new LatestPolicy();
        $this->gl = 'latestpolicy';
    }

    public function index(Request $request)
    {
//        dd(LatestPolicy::find(9)->status_name->status_name);

//        if (! Gate::allows('latestpolicy_manage')) {
//            return "UnAuthorization";
//            return abort(401);
//        }

//        $all_proj = LatestPolicy::all();
        $showdata = $this->showdata;
        if($request->has('pageno')){
            $pageno = $request->input('pageno');
        }else{
            $pageno = 10;
        }
        $showdata['datac']['pageno'] = $pageno;
        // 开始日期
        $showdata['datac']['kstime'] = $request->input('kstime');
        $kstime = $showdata['datac']['kstime'];
        // 结束日期
        $showdata['datac']['jstime'] = $request->input('jstime');
        $jstime = $showdata['datac']['jstime'];


        $showdata['datac']['status'] = $request->input('status')==""?"全部":$request->input('status');
        $status = $showdata['datac']['status'];
        //省
        $showdata['datac']['province_id'] = $request->input('province_id')==""?"全部":$request->input('province_id');
        $province_id = $showdata['datac']['province_id'];
        //市
        $showdata['datac']['city_id'] = $request->input('city_id')==""?"全部":$request->input('city_id');
        $city_id = $showdata['datac']['city_id'];

        // skip
        $input = $request->input();


        $query = LatestPolicy::where(function($query) use ($province_id,$city_id,$kstime,$jstime,$status){
            if ($province_id != "全部") {
                $query->where('province_id', "=", $province_id);
            }
            if ($city_id != "全部") {
                $query->where('city_id', "=", $city_id);
            }
            if ($status != "全部") {
                $query->where('status_id', "=", $status);
            }
            if($kstime && $jstime){
                $query->whereBetween('created_at', array($kstime,$jstime));
            }elseif ($kstime){
                $query->where('created_at', '>=', $kstime.' 00:00:00');
            }elseif ($jstime){
                $query->where('created_at', '<=', $jstime.' 23:59:59');
            }
        })->where('pid',0);
        $count = $query->count();
        $data = $query->orderBy('created_at','desc')->paginate($pageno);


        $showdata['data'] = $data;


        //状态表查询
//      $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','asc')->where('ty','3')->get(),'status_name');
        $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','asc')->where('ty','4')->get(),'status_name');
        $showdata['provinces'] = $this->CreateGlobalData(\App\GlobalRegion::orderBy('linkageid','asc')->where('type','1')->get(),'name',1,'请选择省份');
        $showdata['citys'] = $this->CreateGlobalData(\App\GlobalRegion::orderBy('linkageid','asc')->where('type','2')->get(),'name',1,'请选择市');
        $showdata['input'] = [
            'kstime' => $showdata['datac']['kstime'],
            'jstime' => $showdata['datac']['jstime'],
            'status' => $showdata['datac']['status'],
            'province_id' => $showdata['datac']['province_id'],
            'city_id' => $showdata['datac']['city_id']
        ];

        $showdata['page-title'] = '政策管理';
        $showdata['app_add_new'] = '新增';
        $showdata['app_edit'] = '编辑';
        $showdata['app_chakan'] = '详情';
        $showdata['app_delete'] = '删除';

        return view('admin.latestpolicy.index', compact('showdata','input'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
//        dd($request->all());
        //        if (! Gate::allows('latestpolicy_manage')) {
//            return abort(401);
//        }

        if ($request->input('is') == 1) {
            // unique：表名，字段名，忽略id，限定字段，限定字段的值
            $rules = [
                'article_name' => 'required|min:2|max:191|unique:latestpolicys,article_name',
//                'district' => 'required|min:1|max:40',
            ];
            $messages = [
                'article_name.required' => '文章名称必须填写',
                'article_name.min' => '文章名称必须至少2个汉子',
                'article_name.unique' => '文章名称已经存在',
//                'district.required' => '所属区县必须填写'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect('admin/latestpolicy/create')
                    ->withErrors($validator)
                    ->withInput($request->all());
            }

            $input = $request->except('is', '_token');
            $input['uid'] = Auth()->id();
            $input['uname'] = Auth()->user()->name;
            $input['type'] = 'add';
            $input['created_at'] = date('Y-m-d H:i:s', time());
            $input['updated_at'] = date('Y-m-d H:i:s', time());
            // 日志



            $diffKey = ['article_name','status_id','sortby','cnt'];
            $is_create_ok = $this->model->insertGetId($input);
            if (!$is_create_ok) {
                return "创建失败";
                exit();
            }
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/latestpolicy/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
            return redirect('admin/prompt')->with(['message' => '添加成功', 'url' => '/admin/latestpolicy/index', 'jumpTime' => 3, 'status' => 'success']);
        }
        //状态表查询


        $showdata = $this->showdata;
        $showdata['page-title'] = '';
//        $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','asc')->where('ty','3')->get(),'status_name','add');
        $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','asc')->where('ty','4')->get(),'status_name','add');

        return view('admin.latestpolicy.create', compact('showdata'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        if (! Gate::allows('users_manage')) {
//            return abort(401);
//        }
        $showdata = $this->showdata;


        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
//        if (! Gate::allows('latestpolicy_manage')) {
//            return abort(401);
//        }


        if ($request->input('is') == 1) {
            return $this->update($request, $id);
            // unique：表名，字段名，忽略id，限定字段，限定字段的值
//            $rules = [
//                'latestpolicy_name' => 'required|min:2|max:191|unique:latestpolicys,latestpolicy_name',
//                'district' => 'required|min:1|max:40',
//            ];
//            $messages = [
//                'latestpolicy_name.required' => '项目名称必须填写',
//                'latestpolicy_name.min' => '项目名称必须至少2个汉子',
//                'latestpolicy_name.unique' => '项目名称已经存在',
//                'district.required' => '所属区县必须填写'
//            ];
//            $validator = Validator::make($request->all(), $rules,$messages);
//            if ($validator->fails()){
//                return redirect('admin/latestpolicy/edit/'.$id)
//                    ->withErrors($validator)
//                    ->withInput($request->all());
//            }
//
//            $input = $request->except('is','_token');
//            if(false === $this->model->where('id',$id)->update($input)){
//                return "修改失败";
//                exit();
//            };

//         return $this->tiaozhuan($request,['url.intended.msg'=>'添加成功','url.intended.time'=>'3','url.intended.class'=>'panel-success','url.intended.url'=>'','url.intended.url_default'=>$this->gl]);
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/latestpolicy/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
//            return redirect('admin/prompt')->with(['message'=>'修改成功','url' =>'/admin/latestpolicy', 'jumpTime'=>3,'status'=>'success']);
        }

        $corp = LatestPolicy::findOrFail($id);

        $showdata = $this->showdata;
        $showdata['page-title'] = '政策档案';
        return view('admin.latestpolicy.edit', compact('corp', 'showdata'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        if (! Gate::allows('latestpolicy_manage')) {
//            return abort(401);
//        }

//        dd($request->all());
        if ($request->input('is') == 1) {

            // unique：表名，字段名，忽略id，限定字段，限定字段的值
            $rules = [
                'article_name' => 'required|min:2|max:191',
//                'district' => 'required|min:1|max:40',
            ];
            $messages = [
                'article_name.required' => '文章名称必须填写',
                'article_name.min' => '文章名称必须至少2个汉子',
//                'latestpolicy_name.unique' => '项目名称已经存在',
//                'district.required' => '所属区县必须填写'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect('admin/latestpolicy/update/' . $id)
                    ->withErrors($validator)
                    ->withInput($request->all());
            }

            $input = $request->except('is', '_token');
            // 日志
            $corp = LatestPolicy::findOrFail($id);

            $r = $corp->toArray();
            $r['type'] = 'update';
            $r['pid'] = $id;
            $r['id'] = null;
            $r['uid'] = Auth()->id();
            $r['uname'] = Auth()->user()->name;

//            $diffKey = ['article_name','status_id','sortby','cnt'];
            $diffKey = ['article_name','sortby','cnt'];

            if (LatestPolicy::findOrFail($id)->update($input) === true) {

                $vg = 0;
                foreach ($diffKey as $item){

                    if(LatestPolicy::findOrFail($id)->$item == $r[$item]){
                        $r[$item] = null;
                    }else{

                        $vg = $vg + 1;
                    }
                }
                if($vg > 0){

                    $is_create_ok = $this->model->create($r);
                    if($is_create_ok){
                        return redirect('admin/prompt')->with(['message' => '修改成功', 'url' => '/admin/latestpolicy/index', 'jumpTime' => 3, 'status' => 'success']);

                    }
                }

            }
            return redirect('admin/prompt')->with(['message' => '修改成功', 'url' => '/admin/latestpolicy/index', 'jumpTime' => 3, 'status' => 'success']);


            return "修改失败";
            exit();


//         return $this->tiaozhuan($request,['url.intended.msg'=>'添加成功','url.intended.time'=>'3','url.intended.class'=>'panel-success','url.intended.url'=>'','url.intended.url_default'=>$this->gl]);
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/latestpolicy/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
        }

        $corp = LatestPolicy::findOrFail($id);


        $showdata = $this->showdata;
        $showdata['page-title'] = '最新政策';
//        $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','desc')->where('ty','3')->get(),'status_name','edit');
        $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','desc')->where('ty','4')->get(),'status_name','edit');

        return view('admin.latestpolicy.edit', compact('corp', 'showdata'));
    }

    /*
     * 查看
     */
    public function chakan(Request $request, $id)
    {
//        if (! Gate::allows('latestpolicy_manage')) {
//            return abort(401);
//        }
//        $cache_time = 5;
//        $modified_time = @$_SERVER['HTTP_IF_MODIFIED_SINCE'];
//        if( strtotime($modified_time)+$cache_time > time() ){
//            header("HTTP/1.1 304");
//            exit;
//        }
//        header ("Last-Modified: " .gmdate("D, d M Y H:i:s", time() )." GMT");
//        header ("Expires: " .gmdate("D, d M Y H:i:s", time()+$cache_time )." GMT");
//        header ("Cache-Control: max-age=$cache_time");


        $corp = LatestPolicy::findOrFail($id);
        $history = $this->displayChildCategory2($id);
        $addhistory = $this->displayChildCategory2($id,'add');
//
        $showdata = $this->showdata;
        $showdata['page-title'] = '最新政策';
        $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','desc')->where('ty','3')->get(),'status_name','edit');

        return view('admin.latestpolicy.chakan', compact('corp', 'showdata','history','addhistory'));
    }
    /**
     * Remove User from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        if (! Gate::allows('users_manage')) {
//            return abort(401);
//        }
//        $corp = latestpolicy::findOrFail($id);
//        $corp->delete();

//        return redirect()->route('admin.users.index');
        if($this->errorData['statu'] == 3){
            $arr['statu'] = 3;
            $arr['msg'] = '没有权限删除';
        }else if (is_numeric($id)) {
//            $this->model->where('id', $id)->delete();
            if (LatestPolicy::destroy($id) === 1) {
                $arr['statu'] = 1;
                $arr['msg'] = '删除成功';
            } else {
                $arr['statu'] = 2;
                $arr['msg'] = '删除失败';
            }
        }

        return $arr;


    }



    public function api_show(Request $request,$id)
    {

        $flag = request('flag');

        if($this->errorData['statu'] == 4){
                $arr['statu'] = 4;
                $arr['msg'] = '没有权限设置';
        }else if (is_numeric($id)) {
            $count = count(LatestPolicy::where(['status_id'=>'1','pid'=>'0'])->get());
            if($count > 4 || ($count == 4 && $flag == 1)){
                $arr['statu'] = -1;
                $arr['msg'] = '最多只能有四篇文章显示在首页';
                $arr['count'] = $count;
                return $arr;
            }
            if(true === LatestPolicy::find($id)->update(['status_id'=>$flag])){

                $arr['statu'] = 1;
                $arr['msg'] = '设置成功';
            }else{
                $arr['statu'] = 2;
                $arr['msg'] = '设置失败';
            };

        }

        return $arr;


    }

}
