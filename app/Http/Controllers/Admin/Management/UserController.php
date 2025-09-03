<?php

namespace App\Http\Controllers\Admin\Management;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\MasterTitle;

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
        })->with('roles')->latest()->paginate(7)->withQueryString();

        //return inertia
        return Inertia::render('Admin/Management/Users/Index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titles = MasterTitle::all();
        //get roles
        $roles = Role::all();

        //return inertia
        return Inertia::render('Admin/Management/Users/Create', [
            'titles' => $titles,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Validate request
         */
        $request->validate([
            'title'    => 'required',
            'name'     => 'required',
            'email'    => 'required|unique:users',
            'phone'    => 'required',
            'password' => 'required|confirmed'
        ]);

        /**
         * Create user
         */
        $user = User::create([
            'title_id' => $request->title['id'],
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => bcrypt($request->password)
        ]);

        //assign roles to user
        $user->assignRole($request->roles);

        //redirect
        return redirect()->route('admin.management.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get titles
        $titles = MasterTitle::all();

        //get user
        $user = User::with('title', 'roles')->findOrFail($id);

        //get roles
        $roles = Role::all();

        //return inertia
        return Inertia::render('Admin/Management/Users/Edit', [
            'titles' => $titles,
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($user->id);
        /**
         * validate request
         */
        $request->validate([
            'title'    => 'required',
            'name'     => 'required',
            'email'    => 'required|unique:users,email,' . $user->id,
            'phone'    => 'required|unique:users,phone,' . $user->id,
            'password' => 'nullable|confirmed'
        ]);

        /**
         * check password is empty
         */
        if ($request->password == '') {

            $user->update([
                'title_id' => $request->title['id'],
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone
            ]);
        } else {

            $user->update([
                'title_id' => $request->title['id'],
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'password' => bcrypt($request->password)
            ]);
        }

        //assign roles to user
        $user->syncRoles($request->roles);

        //redirect
        return redirect()->route('admin.management.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find user
        $user = User::findOrFail($id);

        //delete user
        $user->delete();

        //redirect
        return redirect()->route('admin.management.users.index');
    }
}
