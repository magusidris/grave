<?php

namespace App\Http\Controllers\Admin\Management;

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
        return inertia('Admin/Management/Permissions/Index', [
            'permissions' => $permissions
        ]);
    }
}
