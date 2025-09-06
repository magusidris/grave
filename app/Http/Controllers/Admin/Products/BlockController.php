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
    public function index()
    {
        $blocks = GraveBlock::when(request()->q, function ($blocks) {
            $blocks = $blocks->where('name', 'like', '%' . request()->q . '%');
        })->with('cluster')->latest()->paginate(10)->withQueryString();

        return Inertia::render('Admin/Products/Blocks/Index', [
            'blocks' => $blocks
        ]);
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $clusters = GraveCluster::all();

        // render with inertia
        return Inertia::render('Admin/Products/Blocks/Create', [
            'clusters' => $clusters
        ]);
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
            'cluster'      => 'required',
            'name'          => 'required',
            'description'   => 'required',
        ]);

        GraveBlock::create(['cluster_id' => $request->cluster['id'], 'name' => $request->name, 'description' => $request->description]);

        //redirect
        return redirect()->route('admin.products.blocks.index');
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        //get block
        $block = GraveBlock::findOrFail($id)->load('cluster');

        //render with inertia
        return Inertia::render('Admin/Products/Blocks/Edit', [
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
    public function update(Request $request, GraveBlock $block)
    {
        /**
         * validate request
         */
        $request->validate([
            'name'          => 'required|unique:grave_blocks,name,' . $block->id,
            'description'   => 'required',
        ]);

        //update block
        $block->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        //redirect
        return redirect()->route('admin.products.blocks.index', $block->id);
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
