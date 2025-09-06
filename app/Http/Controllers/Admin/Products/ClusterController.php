<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\GraveCluster;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClusterController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $clusters = GraveCluster::when(request()->q, function ($clusters) {
            $clusters = $clusters->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10)->withQueryString();

        return Inertia::render('Admin/Products/Clusters/Index', [
            'clusters' => $clusters
        ]);
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        // render with inertia
        return Inertia::render('Admin/Products/Clusters/Create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        /**
         * Validate request
         */
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
        ]);

        GraveCluster::create(['name' => $request->name, 'description' => $request->description]);

        //redirect
        return redirect()->route('admin.products.clusters.index');
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        //get cluster
        $cluster = GraveCluster::findOrFail($id);

        //render with inertia
        return Inertia::render('Admin/Products/Clusters/Edit', [
            'cluster'   => $cluster,
        ]);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $role
     * @return void
     */
    public function update(Request $request, GraveCluster $cluster)
    {
        /**
         * validate request
         */
        $request->validate([
            'name'          => 'required|unique:grave_clusters,name,' . $cluster->id,
            'description'   => 'required',
        ]);

        //update cluster
        $cluster->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        //redirect
        return redirect()->route('admin.products.clusters.index', $cluster->id);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find cluster by ID
        $cluster = GraveCluster::findOrFail($id);

        //delete cluster
        $cluster->delete();

        //redirect
        return redirect()->route('admin.products.clusters.index');
    }
}
