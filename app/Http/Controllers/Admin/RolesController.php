<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;



class RolesController extends Controller
{
    protected $model;
    protected $gl;

    public function __construct()
    {

        $this->showdata['nav'] = 'roles';
        $this->model = new Role();
        $this->gl = 'roles';
    }

    public function index()
    {

        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::get();

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(StoreRolesRequest $request)
    {

        $role = Role::create($request->except('permission'));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $rp = array();
        foreach ($permissions as $k=>$v){
            $rp[] =array('role_id' => $role->id, 'permission_id' => $v);
        }
        \DB::table('role_has_permissions')->insert($rp);


        return redirect()->route('admin.roles.index');
    }


    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        if (! Gate::allows('users_manage')) {
//            return abort(401);
//        }
//        $permissions = Permission::get()->pluck('name', 'name');
        $permissions = Permission::get();

        $role = Role::findOrFail($id);

        $rpData = \DB::table('role_has_permissions')->select(\DB::raw('GROUP_CONCAT(permission_id) permission_id'))->where('role_id','=',$id)->get()->toArray();
        $r_permission = $rpData[0]->permission_id;

        return view('admin.roles.edit', compact('role', 'permissions','r_permission'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdateRolesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolesRequest $request, $id)
    {
//        if (! Gate::allows('users_manage')) {
//            return abort(401);
//        }
        $role = Role::findOrFail($id);
        $role->update($request->except('permission'));
        $permissions = $request->input('permission') ? $request->input('permission') : [];

        \DB::table('role_has_permissions')->where('role_id','=',$id)->delete();

        $rp = array();
        foreach ($permissions as $k=>$v){
            $rp[] =array('role_id' => $id, 'permission_id' => $v);
        }
        \DB::table('role_has_permissions')->insert($rp);
//        dd($permissions);
//        $role->syncPermissions($permissions);

        return redirect()->route('admin.roles.index');
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        if (! Gate::allows('users_manage')) {
//            return abort(401);
//        }

//        \DB::transaction(function($id){
//            \DB::delete("delete * from model_has_roles where role_id = ?",$id);
        \DB::table('model_has_roles')->where('role_id',$id)->delete();
        \DB::table('role_has_permissions')->where('role_id',$id)->delete();
        $role = Role::findOrFail($id);
        $role->delete();
//        });



        return redirect()->route('admin.roles.index');
    }

    /**
     * Delete all selected Role at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
//        if (! Gate::allows('users_manage')) {
//            return abort(401);
//        }
        if ($request->input('ids')) {
            $entries = Role::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
