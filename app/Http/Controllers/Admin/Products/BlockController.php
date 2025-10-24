<?php

namespace App\Http\Controllers\Admin\Products;

use Inertia\Inertia;
use App\Models\GraveBlock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GraveCluster;

class BlockController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(GraveCluster $cluster)
    {
        $blocks = GraveBlock::where('cluster_id', $cluster->id)->when(request()->q, function ($blocks) {
            $blocks = $blocks->where('name', 'like', '%' . request()->q . '%');
        })->orderBy('sequence')->latest()->paginate(7)->withQueryString();

        return Inertia::render('Admin/Products/Clusters/Blocks/Index', [
            'cluster' => $cluster,
            'blocks' => $blocks
        ]);
    }

    /**
     * create
     *
     * @return void
     */
    public function create(GraveCluster $cluster)
    {
        $clusters = GraveCluster::all();

        // render with inertia
        return Inertia::render('Admin/Products/Clusters/Blocks/Create', [
            'cluster' => $cluster,
            'clusters' => $clusters
        ]);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(GraveCluster $cluster, Request $request)
    {
        /**
         * Validate request
         */
        $request->validate([
            'amount'   => 'required',
        ]);

        for ($i = 0; $i < $request->amount; $i++) {
            GraveBlock::create([
                'cluster_id' => $cluster->id,
            ]);
        }

        //redirect
        return redirect()->route('admin.products.clusters.blocks.index', $cluster->id);
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit(GraveCluster $cluster, $id)
    {
        //get block
        $block = GraveBlock::findOrFail($id);

        //render with inertia
        return Inertia::render('Admin/Products/Clusters/Blocks/Edit', [
            'cluster' => $cluster,
            'block'   => $block,
        ]);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $role
     * @return void
     */
    public function update(GraveCluster $cluster, Request $request, GraveBlock $block)
    {
        /**
         * validate request
         */
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
        ]);

        //update block
        $block->update([
            'cluster_id' => $cluster->id,
            'name' => $request->name,
            'description' => $request->description
        ]);

        //redirect
        return redirect()->route('admin.products.clusters.blocks.index', $cluster->id);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find block by ID
        $block = GraveBlock::findOrFail($id);

        //delete block
        $block->delete();

        //redirect
        return redirect()->route('admin.products.blocks.index');
    }
}
