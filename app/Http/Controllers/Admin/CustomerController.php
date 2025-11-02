<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Customer;
use App\Models\MasterTitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * index
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //get customers
        $customers = Customer::when(request()->q, function ($customers) {
            $customers = $customers->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(7)->withQueryString();

        //return inertia
        return Inertia::render('Admin/Customers/Index', [
            'customers' => $customers
        ]);
    }

    public function create()
    {
        $titles = MasterTitle::all();

        //return inertia
        return Inertia::render('Admin/Customers/Create', [
            'titles' => $titles,
        ]);
    }
}
