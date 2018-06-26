<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;

class PermissionsController extends Controller
{
    protected $model;
    protected $gl;
    public function __construct()
    {
        $this->showdata['nav'] = 'permissions';
        $this->model = new Permission();
        $this->gl = 'permissions';
    }

    public function index(Request $request)
    {
        $permissions = $this->getTree('permissions');
        return view('admin.permissions.index', compact('permissions'));
    }


    public function create()
    {
        $permissions = $this->getTree('permissions');
        return view('admin.permissions.create',compact('permissions'));
    }


    public function store(StorePermissionsRequest $request)
    {
        Permission::create($request->all());
        return redirect()->route('admin.permissions.index');
    }


    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $permissions = $this->getTree('permissions');
        $children = $this->getChildren($id,'permissions');
        return view('admin.permissions.edit', compact('permission','permissions','children'));
    }


    public function update(UpdatePermissionsRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        return redirect()->route('admin.permissions.index');
    }


    public function destroy($id)
    {
        \DB::table('role_has_permissions')->where('permission_id',$id)->delete();
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('admin.permissions.index');
    }


    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Permission::whereIn('id', $request->input('ids'))->get();
            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
