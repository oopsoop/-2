<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Stadium;
use Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

use Auth;

use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;



class StadiumsController extends Controller
{
    protected $model;
    protected $gl;
    public function __construct(Request $request){
//        $this->middleware(function ($request, $next) {
//            dd(Auth::id());
//        });
        parent::__construct($request);
        $this->showdata['nav'] = 'stadiums';
        $this->model = new Stadium();
        $this->gl = 'stadiums';

    }
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $showdata = $this->showdata;
        if($request->has('pageno')){
            $pageno = $request->input('pageno');
        }else{
            $pageno = 10;
        }
        $showdata['datac']['pageno'] = $pageno;
//        // 开始日期
//        $showdata['datac']['kstime'] = $request->input('kstime');
//        $kstime = $showdata['datac']['kstime'];
//        // 结束日期
//        $showdata['datac']['jstime'] = $request->input('jstime');
//        $jstime = $showdata['datac']['jstime'];

        // 跳转第几页
        $input = $request->input();


//        $query = Stadium::where(function($query) use ($kstime,$jstime){
//            if($kstime && $jstime){
//                $query->whereBetween('establish_time', array($kstime,$jstime));
//            }elseif ($kstime){
//                $query->where('establish_time', '>=', $kstime);
//            }elseif ($jstime){
//                $query->where('establish_time', '<=', $jstime);
//            }
//        })->where('pid',0);
        $query = Stadium::where('id','>',0);
        $count = $query->count();
        $data = $query->orderBy('created_at','desc')->paginate($pageno);


        $showdata['data'] = $data;


        //状态表查询
//        $showdata['status_t'] = $this->CreateSelect2Data(\App\Status_t::orderBy('id','asc')->where('ty','1')->get(),'status_name');
        $showdata['input'] = [
//            'kstime' => $showdata['datac']['kstime'],
//            'jstime' => $showdata['datac']['jstime'],
//            'status' => $showdata['datac']['status']
        ];

        $showdata['page-title'] = '场馆管理';
        $showdata['app_add_new'] = '新增';
        $showdata['app_edit'] = '编辑';
        $showdata['app_detail'] = '详情';
        $showdata['app_delete'] = '删除';

        return view('admin.stadium.index', compact('showdata','input'));
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
                'stadium_name' => 'required|min:2|max:191|unique:stadiums,stadium_name',
                'district' => 'required|min:1|max:190', //地址
                'distance' => 'required|integer',
            ];
            $messages = [
                'stadium_name.required' => '场馆名称必须填写',
                'stadium_name.min' => '场馆名称必须至少2个汉子',
                'stadium_name.unique' => '场馆名称已经存在',
                'district.required' => '地址必须填写',
                'distance.required' => '设置范围必须填写',
                'distance.integer' => '设置范围必须是数字'
            ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()){
            return redirect('admin/stadiums/create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $input = $request->except('is','_token');
        $is_create_ok =  $this->model->create($input);
         if(!$is_create_ok){
             return "创建失败";
             exit();
         }
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/Stadium/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
         return redirect('admin/prompt')->with(['message'=>'添加成功','url' =>'/admin/stadiums/index', 'jumpTime'=>3,'status'=>'success']);
        }
        $no_ids = \App\Status_t::where('ty','=','10')->pluck('id','status_name');

        $showdata =  $this->showdata;
        $showdata['page-title']='场次管理';
        return view('admin.stadium.create', compact('showdata','xis','no_ids'));
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
//                'Stadium_name' => 'required|min:2|max:191|unique:Stadiums,Stadium_name',
//                'district' => 'required|min:1|max:40',
//            ];
//            $messages = [
//                'Stadium_name.required' => '企业名称必须填写',
//                'Stadium_name.min' => '企业名称必须至少2个汉子',
//                'Stadium_name.unique' => '企业名称已经存在',
//                'district.required' => '所属区县必须填写'
//            ];
//            $validator = Validator::make($request->all(), $rules,$messages);
//            if ($validator->fails()){
//                return redirect('admin/Stadium/edit/'.$id)
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
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/Stadium/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
//            return redirect('admin/prompt')->with(['message'=>'修改成功','url' =>'/admin/Stadium', 'jumpTime'=>3,'status'=>'success']);
        }

        $corp = Stadium::findOrFail($id);

        $showdata =  $this->showdata;
        $showdata['page-title']='企业档案';
        return view('admin.stadium.edit', compact('corp','showdata'));
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
        $corp = Stadium::findOrFail($id);

        if($request->input('is') == 1){
            // unique：表名，字段名，忽略id，限定字段，限定字段的值
            $rules = [
                'stadium_name' => 'required|min:2|max:191',
                'district' => 'required|min:1|max:40',
                'distance' => 'required|integer',
//                'district' => 'required|min:1|max:40',
            ];
            $messages = [
                'stadium_name.required' => '场馆名称必须填写',
                'stadium_name.min' => '场馆名称必须至少2个汉子',
//                'Stadium_name.unique' => '企业名称已经存在',
                'district.required' => '地址必须填写',
                'distance.required' => '设置范围必须填写',
                'distance.integer' => '设置范围必须是数字'
            ];
            $validator = Validator::make($request->all(), $rules,$messages);
            if ($validator->fails()){
                return redirect('admin/stadiums/update/'.$id)
                    ->withErrors($validator)
                    ->withInput($request->all());
            }

            $input1 = $request->except('is','_token');


            if(Stadium::findOrFail($id)->update($input1) === true) {
                return redirect('admin/prompt')->with(['message' => '修改成功', 'url' => '/admin/stadiums/index', 'jumpTime' => 3, 'status' => 'success']);
            }

            return "修改失败";
            exit();


//         return $this->tiaozhuan($request,['url.intended.msg'=>'添加成功','url.intended.time'=>'3','url.intended.class'=>'panel-success','url.intended.url'=>'','url.intended.url_default'=>$this->gl]);
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/Stadium/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
        }
//



        $xis = \App\Status_t::where('ty','=','9')->pluck('id','status_name');
        $showdata =  $this->showdata;
        $showdata['page-title']='场地信息';
        return view('admin.stadium.edit', compact('corp','showdata','xis'));
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
//        $corp = Stadium::findOrFail($id);
//        $corp->delete();

//        return redirect()->route('admin.users.index');

        if($this->errorData['statu'] == 3){
            $arr['statu'] = 3;
            $arr['msg'] = '没有权限删除';
        }else if (is_numeric($id)) {

//            $this->model->where('id', $id)->delete();
            if (Stadium::destroy($id) === 1) {
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
    

    //生成二维码
    public static function gqrcode(Request $request, $id){

        //生成这个场馆的id
        $qrcode_url = 'https://'.$_SERVER['HTTP_HOST'].'/api/stadiumid/'.$id;
        return view('admin.stadium.gqrcode', compact('qrcode_url'));

    }


    public function archives()
    {

    }

}
