<?php

namespace App\Http\Controllers\Admin\Master;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\MasterProvince;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    /**
     * __invoke
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(Request $request)
    {
        $provinces = MasterProvince::when($request->q, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        })->paginate(10)->withQueryString();

        return Inertia::render('Admin/Master/Provinces/Index', [
            'provinces' => fn() => $provinces
        ]);
    }
}
