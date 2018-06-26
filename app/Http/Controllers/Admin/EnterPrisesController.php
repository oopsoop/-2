<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\EnterPrise;
use Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

use Auth;

use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;



class EnterPrisesController extends Controller
{
    protected $model;
    protected $gl;
    public function __construct(Request $request){

//        $this->middleware(function ($request, $next) {
//            dd(Auth::id());
//        });
        parent::__construct($request);
        $this->showdata['nav'] = 'enterprises';
        $this->model = new EnterPrise();
        $this->gl = 'enterprises';

    }
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        dd($request->session()->get('user'));
//        dd($request->session()->all());
//          dd(session('user')->id);
          //        if (! Gate::allows('enterprise_manage')) {
//            return "UnAuthorization";
//            return abort(401);
//        }

//        $all_enterprise = Enterprise::all();

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

        // 跳转第几页
        $input = $request->input();


        $query = Enterprise::where(function($query) use ($kstime,$jstime){
            if($kstime && $jstime){
                $query->whereBetween('establish_time', array($kstime,$jstime));
            }elseif ($kstime){
                $query->where('establish_time', '>=', $kstime);
            }elseif ($jstime){
                $query->where('establish_time', '<=', $jstime);
            }
        })->where('pid',0);
        $count = $query->count();
        $data = $query->orderBy('created_at','desc')->paginate($pageno);


        $showdata['data'] = $data;


        //状态表查询
//        $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','asc')->where('ty','1')->get(),'status_name');
        $showdata['input'] = [
            'kstime' => $showdata['datac']['kstime'],
            'jstime' => $showdata['datac']['jstime'],
//            'status' => $showdata['datac']['status']
        ];

        $showdata['page-title'] = '企业档案';
        $showdata['app_add_new'] = '新增';
        $showdata['app_edit'] = '编辑';
        $showdata['app_detail'] = '详情';
        $showdata['app_delete'] = '删除';

        return view('admin.enterprise.index', compact('showdata','input'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        if($request->input('is') == 1){
            // unique：表名，字段名，忽略id，限定字段，限定字段的值
            $rules = [
                'enterprise_name' => 'required|min:2|max:191|unique:enterprises,enterprise_name',
                'district' => 'required|min:1|max:40',
            ];
            $messages = [
                'enterprise_name.required' => '企业名称必须填写',
                'enterprise_name.min' => '企业名称必须至少2个汉子',
                'enterprise_name.unique' => '企业名称已经存在',
                'district.required' => '所属区县必须填写'
            ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()){
            return redirect('admin/enterprises/create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $input = $request->except('is','_token');
        $is_create_ok =  $this->model->create($input);
         if(!$is_create_ok){
             return "创建失败";
             exit();
         }
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/enterprise/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
         return redirect('admin/prompt')->with(['message'=>'添加成功','url' =>'/admin/enterprises/index', 'jumpTime'=>3,'status'=>'success']);
        }


        $showdata =  $this->showdata;
        $showdata['page-title']='企业档案';
        return view('admin.enterprise.create', compact('showdata'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $showdata = $this->showdata;
        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        if($request->input('is') == 1){
            return  $this->update($request, $id);
            // unique：表名，字段名，忽略id，限定字段，限定字段的值
//            $rules = [
//                'enterprise_name' => 'required|min:2|max:191|unique:enterprises,enterprise_name',
//                'district' => 'required|min:1|max:40',
//            ];
//            $messages = [
//                'enterprise_name.required' => '企业名称必须填写',
//                'enterprise_name.min' => '企业名称必须至少2个汉子',
//                'enterprise_name.unique' => '企业名称已经存在',
//                'district.required' => '所属区县必须填写'
//            ];
//            $validator = Validator::make($request->all(), $rules,$messages);
//            if ($validator->fails()){
//                return redirect('admin/enterprise/edit/'.$id)
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
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/enterprise/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
//            return redirect('admin/prompt')->with(['message'=>'修改成功','url' =>'/admin/enterprise', 'jumpTime'=>3,'status'=>'success']);
        }

        $corp = EnterPrise::findOrFail($id);

        $showdata =  $this->showdata;
        $showdata['page-title']='企业档案';
        return view('admin.enterprise.edit', compact('corp','showdata'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $corp = EnterPrise::findOrFail($id);
        $corp_uid = $corp->corp_uid ? $corp->corp_uid : '';
        $person_info = \App\PersonalDossier::where('corp_uid',$corp_uid)->get();
        $person_info = $person_info->toArray();
//        dd($request->all());
        if($request->input('is') == 1){
            // unique：表名，字段名，忽略id，限定字段，限定字段的值
            $rules = [
                'enterprise_name' => 'required|min:2|max:191',
                'district' => 'required|min:1|max:40',
            ];
            $messages = [
                'enterprise_name.required' => '企业名称必须填写',
                'enterprise_name.min' => '企业名称必须至少2个汉子',
//                'enterprise_name.unique' => '企业名称已经存在',
                'district.required' => '所属区县必须填写'
            ];
            $validator = Validator::make($request->all(), $rules,$messages);
            if ($validator->fails()){
                return redirect('admin/enterprises/update/'.$id)
                    ->withErrors($validator)
                    ->withInput($request->all());
            }

            $input1 = $request->except('is','_token','legal_name','mobile','fax','email','responsibility_name','responsibility_mobile','responsibility_fax','responsibility_email','lianxiren_name','lianxiren_mobile','lianxiren_fax','lianxiren_email');
            $input2 = $request->only('legal_name','mobile','fax','email','responsibility_name','responsibility_mobile','responsibility_fax','responsibility_email','lianxiren_name','lianxiren_mobile','lianxiren_fax','lianxiren_email');
            // 日志
            $corp = EnterPrise::findOrFail($id);

            $r = $corp->toArray();
            $r['type'] = 'update';
            $r['pid'] = $id;
            $r['corp_uid'] = null;
            $r['corp_name'] = null;
            $r['id'] = null;
            $r['uid'] = Auth()->id();
            $r['uname'] = Auth()->user()->name;

            $diffKey = ['enterprise_name','district','organization_code','establish_time','regAddress','license','deposit_bank','account_bank','total_people','junior_total_people','research_total_people','technical_field'
                ,'archival_information'];
            if(EnterPrise::findOrFail($id)->update($input1) === true){

                if(count($person_info) > 0){
                    if(true === \App\PersonalDossier::findOrFail($person_info[0]['id'])->update($input2)){

                    }else{
                        return "修改失败";
                        exit();

                    };
                }


                $vg = 0;
                foreach ($diffKey as $item){

                    if(EnterPrise::findOrFail($id)->$item == $r[$item]){
                        $r[$item] = null;
                    }else{

                        $vg = $vg + 1;
                    }
                }
                if($vg > 0){
                    $is_create_ok = $this->model->create($r);
                    if($is_create_ok){
                        return redirect('admin/prompt')->with(['message'=>'修改成功','url' =>'/admin/enterprises/index', 'jumpTime'=>3,'status'=>'success']);
                    }
                }
            }

                return "修改失败";
                exit();


//         return $this->tiaozhuan($request,['url.intended.msg'=>'添加成功','url.intended.time'=>'3','url.intended.class'=>'panel-success','url.intended.url'=>'','url.intended.url_default'=>$this->gl]);
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/enterprise/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
        }
//



        $history = $this->displayChildCategory($id);

        $showdata =  $this->showdata;
        $showdata['page-title']='企业档案';
        return view('admin.enterprise.edit', compact('corp','showdata','history','person_info'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        if (! Gate::allows('users_manage')) {
//            return abort(401);
//        }
//        $corp = EnterPrise::findOrFail($id);
//        $corp->delete();

//        return redirect()->route('admin.users.index');

        if($this->errorData['statu'] == 3){
            $arr['statu'] = 3;
            $arr['msg'] = '没有权限删除';
        }else if (is_numeric($id)) {

//            $this->model->where('id', $id)->delete();
            if (EnterPrise::destroy($id) === 1) {
                $arr['statu'] = 1;
                $arr['msg'] = '删除成功';
            } else {
                $arr['statu'] = 2;
                $arr['msg'] = '删除失败';
            }
        }
        return $arr;


    }

//    public function del(Request $request, $id)
//    {
////        if (!Gate::allows('用户管理-删除') && !Gate::allows('ADMIN')) {
////            return $this->tiaozhuan($request, ['url.intended.msg' => '没有权限', 'url.intended.time' => '3',
////                'url.intended.class' => 'panel-success', 'url.intended.url' => url()->previous(), 'url.intended.url_default' => $this->gl]);
////        }
//        if (is_numeric($id)) {
//            if(){
//
//            }
//            $this->model->where('id', $id)->delete();
//            $arr['statu'] = 1;
//            $arr['msg'] = '删除成功';
//        } else {
//            $arr['statu'] = 2;
//            $arr['msg'] = '删除失败';
//        }
//        return $arr;
//
//
//    }


    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function archives()
    {

    }

}
