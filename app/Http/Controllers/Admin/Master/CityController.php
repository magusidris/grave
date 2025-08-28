<?php

namespace App\Http\Controllers\Admin\Master;

use Inertia\Inertia;
use App\Models\MasterCity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * __invoke
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(Request $request)
    {
        $cities = MasterCity::when($request->q, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        })->paginate(10)->withQueryString();

        return Inertia::render('Admin/Master/Cities/Index', [
            'cities' => fn() => $cities
        ]);
    }
}
