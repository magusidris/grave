<?php

namespace App\Http\Controllers\Admin\Master;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\MasterSubdistrict;
use App\Http\Controllers\Controller;

class SubdistrictController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $subdistricts = MasterSubdistrict::when($request->q, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        })->paginate(10)->withQueryString();

        return Inertia::render('Admin/Master/Subdistricts/Index', [
            'subdistricts' => fn() => $subdistricts
        ]);
    }
}
