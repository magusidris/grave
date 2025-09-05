<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\GraveCluster;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClusterController extends Controller
{
    public function index()
    {
        $clusters = GraveCluster::when(request()->q, function ($clusters) {
            $clusters = $clusters->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10)->withQueryString();

        return Inertia::render('Admin/Products/Clusters/Index', [
            'clusters' => $clusters
        ]);
    }
}
