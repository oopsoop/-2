<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use Validator;
class NewsController extends Controller
{
    protected $model;
    protected $gl;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->showdata['nav'] = 'news';
        $this->model = new News();
        $this->gl = 'news';
    }

    public function index(Request $request)
    {
//        dd(News::find(9)->status_name->status_name);

//        if (! Gate::allows('latestpolicy_manage')) {
//            return "UnAuthorization";
//            return abort(401);
//        }

//        $all_proj = News::all();
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

//
//        $showdata['datac']['status'] = $request->input('status')==""?"全部":$request->input('status');
//        $status = $showdata['datac']['status'];

        // skip
        $input = $request->input();


//        $query = News::where(function($query) use ($kstime,$jstime,$status){
        $query = News::where(function($query) use ($kstime,$jstime){
//            if ($status != "全部") {
//                $query->where('status_id', "=", $status);
//            }
            if($kstime && $jstime){
                $query->whereBetween('created_at', array($kstime,$jstime));
            }elseif ($kstime){
                $query->where('created_at', '>=', $kstime.' 00:00:00');
            }elseif ($jstime){
                $query->where('created_at', '<=', $jstime.' 23:59:59');
            }
        });
        $count = $query->count();
        $data = $query->orderBy('created_at','desc')->paginate($pageno);


        $showdata['data'] = $data;


        //状态表查询
//        $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','asc')->where('ty','4')->get(),'status_name');
        $showdata['input'] = [
            'kstime' => $showdata['datac']['kstime'],
            'jstime' => $showdata['datac']['jstime'],
//            'status' => $showdata['datac']['status']
        ];

        $showdata['page-title'] = '新闻资讯';
        $showdata['app_add_new'] = '新增';
        $showdata['app_edit'] = '编辑';
        $showdata['app_chakan'] = '详情';
        $showdata['app_delete'] = '删除';

        return view('admin.news.index', compact('showdata','input'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        //        if (! Gate::allows('latestpolicy_manage')) {
//            return abort(401);
//        }

        if ($request->input('is') == 1) {
            // unique：表名，字段名，忽略id，限定字段，限定字段的值
            $rules = [
                'title' => 'required|min:2|max:191|unique:news,title',
//                'district' => 'required|min:1|max:40',
            ];
            $messages = [
                'title.required' => '标题必须填写',
                'title.min' => '标题必须至少2个汉子',
                'title.unique' => '标题已经存在',
//                'district.required' => '所属区县必须填写'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect('admin/news/create')
                    ->withErrors($validator)
                    ->withInput($request->all());
            }

            $input = $request->except('is', '_token');
//            $input['uid'] = Auth()->id();
//            $input['uname'] = Auth()->user()->name;
//            $input['type'] = 'add';
//            $input['created_at'] = date('Y-m-d H:i:s', time());
//            $input['updated_at'] = date('Y-m-d H:i:s', time());
            // 日志



//            $diffKey = ['title','status_id','sortby','cnt'];
            $is_create_ok = $this->model->create($input);
            if (!$is_create_ok) {
                return "创建失败";
                exit();
            }
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/latestpolicy/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
            return redirect('admin/prompt')->with(['message' => '添加成功', 'url' => '/admin/news/index', 'jumpTime' => 3, 'status' => 'success']);
        }
        //状态表查询


        $showdata = $this->showdata;
        $showdata['page-title'] = '';
//        $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','asc')->where('ty','4')->get(),'status_name','add');

        return view('admin.news.create', compact('showdata'));
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


        return redirect()->route('admin.news.index');
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
        // policy
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

        $corp = News::findOrFail($id);

        $showdata = $this->showdata;
        $showdata['page-title'] = '';
        return view('admin.news.edit', compact('corp', 'showdata'));
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


        if ($request->input('is') == 1) {
            // unique：表名，字段名，忽略id，限定字段，限定字段的值
            $rules = [
                'title' => 'required|min:2|max:191',
//                'district' => 'required|min:1|max:40',
            ];
            $messages = [
                'title.required' => '标题必须填写',
                'title.min' => '标题必须至少2个汉子',
//                'latestpolicy_name.unique' => '项目名称已经存在',
//                'district.required' => '所属区县必须填写'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect('admin/news/update/' . $id)
                    ->withErrors($validator)
                    ->withInput($request->all());
            }

            $input = $request->except('is', '_token');
            // 日志
//            $corp = News::findOrFail($id);
//
//            $r = $corp->toArray();
//            $r['type'] = 'update';
//            $r['pid'] = $id;
//            $r['id'] = null;
//            $r['uid'] = Auth()->id();
//            $r['uname'] = Auth()->user()->name;
//
//            $diffKey = ['title','status_id','sortby','cnt'];

            if (News::findOrFail($id)->update($input) === true) {
//                $vg = 0;
//                foreach ($diffKey as $item){
//
//                    if(News::findOrFail($id)->$item == $r[$item]){
//                        $r[$item] = null;
//                    }else{
//
//                        $vg = $vg + 1;
//                    }
//                }
//                if($vg > 0){
//                    $is_create_ok = $this->model->create($r);
//                    if($is_create_ok){
                        return redirect('admin/prompt')->with(['message' => '修改成功', 'url' => '/admin/news/index', 'jumpTime' => 3, 'status' => 'success']);
//
//                    }
//                }

            }

            return "修改失败";
            exit();


//         return $this->tiaozhuan($request,['url.intended.msg'=>'添加成功','url.intended.time'=>'3','url.intended.class'=>'panel-success','url.intended.url'=>'','url.intended.url_default'=>$this->gl]);
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/latestpolicy/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
        }

        $corp = News::findOrFail($id);


        $showdata = $this->showdata;
        $showdata['page-title'] = '';
//        $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','desc')->where('ty','4')->get(),'status_name','edit');

        return view('admin.news.edit', compact('corp', 'showdata'));
    }

    /*
     * 查看
     */
    public function chakan(Request $request, $id)
    {
//        if (! Gate::allows('latestpolicy_manage')) {
//            return abort(401);
//        }



        $corp = News::findOrFail($id);
        $history = $this->displayChildCategory2($id);
        $addhistory = $this->displayChildCategory2($id,'add');
//
        $showdata = $this->showdata;
        $showdata['page-title'] = '';
        $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','desc')->where('ty','4')->get(),'status_name','edit');

        return view('admin.news.chakan', compact('corp', 'showdata','history','addhistory'));
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
            if (News::destroy($id) === 1) {
                $arr['statu'] = 1;
                $arr['msg'] = '删除成功';
            } else {
                $arr['statu'] = 2;
                $arr['msg'] = '删除失败';
            }
        }

        return $arr;


    }

}
