<?php

namespace App\Http\Controllers\Admin\Master;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterEmergencyRelationship;

class RelationshipController extends Controller
{
    /**
     * __invoke
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(Request $request)
    {
        $relationships = MasterEmergencyRelationship::when($request->q, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        })->paginate(10)->withQueryString();

        return Inertia::render('Admin/Master/Relationships/Index', [
            'relationships' => fn() => $relationships
        ]);
    }
}
