<?php

namespace App\Http\Controllers\Admin\Management;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // get roles
        $roles = Role::when(\request()->q, function ($roles) {
            $roles = $roles->where('name', 'like', '%' . \request()->q . '%');
        })->with('permissions')->latest()->paginate(5)->withQueryString();

        // render with inertia
        return Inertia::render('Admin/Management/Roles/Index', [
            'roles' => $roles,
        ]);
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        // get permission all
        $permissions = Permission::all();

        // render with inertia
        return Inertia::render('Admin/Management/Roles/Create', [
            'permissions'   => $permissions
        ]);
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

        //create role
        $role = Role::create(['name' => $request->name]);

        //assign permissions to role
        $role->givePermissionTo($request->permissions);

        //redirect
        return redirect()->route('admin.management.roles.index');
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        //get role
        $role = Role::with('permissions')->findOrFail($id);

        //get permission all
        $permissions = Permission::all();

        //render with inertia
        return Inertia::render('Admin/Management/Roles/Edit', [
            'role'          => $role,
            'permissions'   => $permissions,
        ]);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $role
     * @return void
     */
    public function update(Request $request, Role $role)
    {
        /**
         * validate request
         */
        $request->validate([
            'name'          => 'required',
        ]);

        //update role
        $role->update(['name' => $request->name]);

        //sync permissions
        $role->syncPermissions($request->permissions);

        //redirect
        return redirect()->route('admin.management.roles.index');
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find role by ID
        $role = Role::findOrFail($id);

        //delete role
        $role->delete();

        //redirect
        return redirect()->route('admin.management.roles.index');
    }
}
