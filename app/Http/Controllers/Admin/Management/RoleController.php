<?php

namespace App\Http\Controllers\Admin\Management;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

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
        return inertia('Admin/Management/Roles/Index', [
            'roles' => $roles,
        ]);
    }
}
