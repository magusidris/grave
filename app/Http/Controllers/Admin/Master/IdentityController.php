<?php

namespace App\Http\Controllers\Admin\Master;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\MasterIdentityType;
use App\Http\Controllers\Controller;

class IdentityController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $identities = MasterIdentityType::when($request->q, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        })->paginate(10)->withQueryString();

        return Inertia::render('Admin/Master/Identities/Index', [
            'identities' => fn() => $identities
        ]);
    }
}
