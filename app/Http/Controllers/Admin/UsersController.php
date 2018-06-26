<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;

class UsersController  extends Controller
{
    protected $model;
    protected $gl;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->showdata['nav'] = 'users';
        $this->model = new User();
        $this->gl = 'users';
    }

    public function index(Request $request)
    {

        $showdata = $this->showdata;
        if($request->has('pageno')){
            $pageno = $request->input('pageno');
        }else{
            $pageno = 10;
        }
        $showdata['datac']['pageno'] = $pageno;

        $showdata['datac']['name'] = $request->input('name');
        $name = $showdata['datac']['name'];


        // skip
        $input = $request->input();


        $query = User::where(function($query) use ($name){
            if($name){
                $query->where('name','like','%'.$name.'%');
            }
        });
        $count = $query->count();
        $data = $query->orderBy('created_at','desc')->paginate($pageno);


        $showdata['data'] = $data;

        $showdata['input'] = [
            'name' => $showdata['datac']['name'],

        ];
        $showdata['page-title'] = '用户';
        $showdata['app_list'] = '列表';
        $showdata['app_add_new'] = '新增';
        $showdata['app_edit'] = '编辑';
        $showdata['app_detail'] = '详情';
        $showdata['app_delete'] = '删除';
        return view('admin.users.index', compact('input','showdata'));
    }

    public function create()
    {

        $roles = Role::get()->pluck('name', 'id');
        $showdata =  $this->showdata;
        $showdata['page-title']='用户';
        $showdata['app-create']='添加';
        return view('admin.users.create', compact('roles','showdata'));
    }


    public function store(StoreUsersRequest $request)
    {

        $user = User::create($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {

        $roles = Role::get()->pluck('name', 'name');

        $user = User::findOrFail($id);
        $showdata =  $this->showdata;
        $showdata['page-title']='用户';
        $showdata['app_edit']='编辑';
        return view('admin.users.edit', compact('user', 'roles','showdata'));
    }

    public function update(UpdateUsersRequest $request, $id)
    {

        $user = User::findOrFail($id);
        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {

//        if($this->errorData['statu'] == 3){
//            $arr['statu'] = 3;
//            $arr['msg'] = '没有权限删除';
//        }else if (is_numeric($id)) {

            \DB::table('model_has_roles')->where('model_id',$id)->delete();
            if (User::destroy($id) === 1) {
                $arr['statu'] = 1;
                $arr['msg'] = '删除成功';
            } else {
                $arr['statu'] = 2;
                $arr['msg'] = '删除失败';
            }
//        }
//        return $arr;
//
//
//
//        $user = User::findOrFail($id);
//        $user->delete();
//
//        return redirect()->route('admin.users.index');
    }

    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


}
