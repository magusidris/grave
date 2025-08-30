<?php

namespace App\Http\Controllers\Admin\Management;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * index
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //get users
        $users = User::when(request()->q, function ($users) {
            $users = $users->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(7)->withQueryString();

        //return inertia
        return Inertia::render('Admin/Management/Users/Index', [
            'users' => $users
        ]);
    }
}
