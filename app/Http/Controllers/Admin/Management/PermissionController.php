<?php

namespace App\Http\Controllers\Admin\Management;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        //get permissions
        $permissions = Permission::when(request()->q, function ($permissions) {
            $permissions = $permissions->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10)->withQueryString();

        //return inertia view
        return Inertia::render('Admin/Management/Permissions/Index', [
            'permissions' => $permissions
        ]);
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        // render with inertia
        return Inertia::render('Admin/Management/Permissions/Create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        /**
         * Validate request
         */
        $request->validate([
            'name'          => 'required',
        ]);

        Permission::create(['name' => $request->name]);

        //redirect
        return redirect()->route('admin.management.permissions.index');
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        //get permission
        $permission = Permission::findOrFail($id);

        //render with inertia
        return Inertia::render('Admin/Management/Permissions/Edit', [
            'permission'   => $permission,
        ]);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $role
     * @return void
     */
    public function update(Request $request, Permission $permission)
    {
        /**
         * validate request
         */
        $request->validate([
            'name'          => 'required',
        ]);

        //update permission
        $permission->update(['name' => $request->name]);

        //redirect
        return redirect()->route('admin.management.permissions.index', $permission->id);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find permission by ID
        $permission = Permission::findOrFail($id);

        //delete permission
        $permission->delete();

        //redirect
        return redirect()->route('admin.management.permissions.index');
    }
}
