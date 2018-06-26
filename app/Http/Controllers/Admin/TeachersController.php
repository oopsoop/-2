<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Teacher;

use Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;




class TeachersController extends Controller
{
    protected $model;
    protected $gl;
    public function __construct(Request $request){

        parent::__construct($request);
        $this->showdata['nav'] = 'teachers';
        $this->model = new Teacher();
        $this->gl = 'teachers';

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


//        $query = Course::where(function($query) use ($kstime,$jstime){
//            if($kstime && $jstime){
//                $query->whereBetween('establish_time', array($kstime,$jstime));
//            }elseif ($kstime){
//                $query->where('establish_time', '>=', $kstime);
//            }elseif ($jstime){
//                $query->where('establish_time', '<=', $jstime);
//            }
//        })->where('pid',0);
        $query = Teacher::where('id','>',0);
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

        $showdata['page-title'] = '教师管理';
        $showdata['app_add_new'] = '新增';
        $showdata['app_edit'] = '编辑';
        $showdata['app_detail'] = '详情';
        $showdata['app_delete'] = '删除';

        return view('admin.teacher.index', compact('showdata','input'));
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
//                'name' => 'required|min:2|max:191|unique:teachers,course_name',
                'name' => 'required|min:2|max:191',
                'password' => 'required|min:5|confirmed',
//                'district' => 'required|min:1|max:40', //地址
            ];
            $messages = [
                'name.required' => '教师名称必须填写',
                'name.min' => '教师名称必须至少2个汉子',
                'password.min' => '密码必须至少5个汉子',
//                'course_name.unique' => '教师名称已经存在',
//                'district.required' => '地址必须填写'
            ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()){
            return redirect('admin/teachers/create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $input = $request->except('is','_token');
        $is_create_ok =  $this->model->create($input);

         if(!$is_create_ok){
             return "创建失败";
             exit();
         }
//         Teacher::findOrFail($is_create_ok->id)->update(['qrcode'=>config('app.APP_URL').'getQianDao?id='.$is_create_ok->id]);

//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/Course/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
         return redirect('admin/prompt')->with(['message'=>'添加成功','url' =>'/admin/teachers/index', 'jumpTime'=>3,'status'=>'success']);
        }

//        $stadiumDatas = Teacher::pluck('id','stadium_name')->all();

//        $course_grades = \App\Status_t::where('ty','=','7')->pluck('id','status_name');
//        $is_setups = \App\Status_t::where('ty','=','8')->pluck('id','status_name');
//        $xis = \App\Status_t::where('ty','=','9')->pluck('id','status_name');


        $showdata =  $this->showdata;
        $showdata['page-title']='教师管理';
//        return view('admin.teacher.create', compact('showdata','stadiumDatas','course_grades','is_setups','xis'));
        return view('admin.teacher.create', compact('showdata'));
    }

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
//                'Course_name' => 'required|min:2|max:191|unique:Courses,Course_name',
//                'district' => 'required|min:1|max:40',
//            ];
//            $messages = [
//                'Course_name.required' => '企业名称必须填写',
//                'Course_name.min' => '企业名称必须至少2个汉子',
//                'Course_name.unique' => '企业名称已经存在',
//                'district.required' => '所属区县必须填写'
//            ];
//            $validator = Validator::make($request->all(), $rules,$messages);
//            if ($validator->fails()){
//                return redirect('admin/Course/edit/'.$id)
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
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/Course/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
//            return redirect('admin/prompt')->with(['message'=>'修改成功','url' =>'/admin/Course', 'jumpTime'=>3,'status'=>'success']);
        }

        $corp = Course::findOrFail($id);

        $showdata =  $this->showdata;
        $showdata['page-title']='企业档案';
        return view('admin.Course.edit', compact('corp','showdata'));
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
//        echo Crypt::decrypt('eyJpdiI6IlFVUXpvYTgyTCtoWEFrVFlkbnI0cWc9PSIsInZhbHVlIjoiWU9SeXlVV2JRQ0VyK2JtOE9lQ1ZCZz09IiwibWFjIjoiMzI2MTcwNWJlYTg5ODgyYTI5ZjFlYzA0ZjhkOWI3NDczYzYzMDA3MGMyNDk1Nzc3MDJiZTMzMTcxYjNmMjZhOSJ9');die;
        $corp = Teacher::findOrFail($id);

        if($request->input('is') == 1){
            // unique：表名，字段名，忽略id，限定字段，限定字段的值
            $rules = [
                'name' => 'required|min:2|max:191',
//                'password' => 'min:5',
            ];
            $messages = [
                'name.required' => '教师名称必须填写',
                'name.min' => '教师名称必须至少2个汉子',
//                'password.min' => '密码必须至少5个汉子',
//                'district.required' => '地址必须填写'
            ];
            $validator = Validator::make($request->all(), $rules,$messages);
            if ($validator->fails()){
                return redirect('admin/teachers/update/'.$id)
                    ->withErrors($validator)
                    ->withInput($request->all());
            }
            if($request->input('password')){
                $input1 = $request->except('is','_token');
                $input1['password'] = Crypt::encrypt($input1['password']);
            }else{
                $input1 = $request->except('is','_token','password');
            }




            if(Teacher::findOrFail($id)->update($input1) === true) {
                return redirect('admin/prompt')->with(['message' => '修改成功', 'url' => '/admin/teachers/index', 'jumpTime' => 3, 'status' => 'success']);
            }

            return "修改失败";
            exit();
//         return $this->tiaozhuan($request,['url.intended.msg'=>'添加成功','url.intended.time'=>'3','url.intended.class'=>'panel-success','url.intended.url'=>'','url.intended.url_default'=>$this->gl]);
//         return redirect('admin/prompt')->with(['message'=>'登录成功，即将跳转到后台首页','url' =>'/admin/Course/create', 'jumpTime'=>3,'status'=>'success'])->withCookie($cookie);
        }
//


//        $stadiumDatas = \App\Stadium::pluck('id','stadium_name')->all();

//        $course_grades = \App\Status_t::where('ty','=','7')->pluck('id','status_name');
//        $is_setups = \App\Status_t::where('ty','=','8')->pluck('id','status_name');
//        $xis = \App\Status_t::where('ty','=','9')->pluck('id','status_name');
        $bind_wxuser = \App\Wxuser::pluck('id','nickName');
        
        $showdata =  $this->showdata;
        $showdata['page-title']='教师信息';
        return view('admin.teacher.edit', compact('corp','showdata','bind_wxuser'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->errorData['statu'] == 3){
            $arr['statu'] = 3;
            $arr['msg'] = '没有权限删除';
        }else if (is_numeric($id)) {

//            $this->model->where('id', $id)->delete();
            if (Teacher::destroy($id) === 1) {
                $arr['statu'] = 1;
                $arr['msg'] = '删除成功';
            } else {
                $arr['statu'] = 2;
                $arr['msg'] = '删除失败';
            }
        }
        return $arr;


    }

    public function bind_wxuser(){

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

    public function show_course(Request $request,$id)
    {

        $corp = Course::findOrFail($id);
        $course_tables  = CouseTable::where('course_id','=',$id)->get();
       // echo $id;die;

        if($request->input('is') == 1){

//            CouseTable::where('course_id','=',$id)->delete();
            $ret1 = [];
            $ret2 = [];
            $input = $request->except('is','_token','course_name','stadium_pic');
//            dd($input);
//            if(!count($course_tables)){

                for($i=0;$i<count($input['started_at']);$i++){
                    if($input['started_at'][$i] && $input['end_at'][$i]){
                        if(!empty($input['id']) && !empty($input['id'][$i])){
                            $ret1[] = [
                                'course_id' => $input['course_id'],
                                'started_at'=> $input['started_at'][$i],
                                'end_at'=> $input['end_at'][$i],
                                'default_num'=> $input['default_num'][$i],
                                'id'=> $input['id'][$i],

                            ];

                        }else{
                            $ret2[] = [
                                'course_id' => $input['course_id'],
                                'started_at'=> $input['started_at'][$i],
                                'end_at'=> $input['end_at'][$i],
                                'default_num'=> $input['default_num'][$i],
                            ];

                        }


                    }
                }

            app(\App\CourseTable::class)->updateBatch($ret1);

            CouseTable::insert($ret2);


            return redirect('admin/prompt')->with(['message' => '修改成功', 'url' => '/admin/courses/index', 'jumpTime' => 3, 'status' => 'success']);
        }

        return view('admin.course.show_course', compact('corp','course_tables'));

    }

}
