<?php

namespace App\Http\Controllers\Admin\Products;

use Inertia\Inertia;
use App\Models\GraveType;
use App\Models\GraveCluster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $types = GraveType::when(request()->q, function ($types) {
            $types = $types->where('name', 'like', '%' . request()->q . '%');
        })->with('cluster')->latest()->paginate(10)->withQueryString();

        return Inertia::render('Admin/Products/Types/Index', [
            'types' => $types
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
        $blocks = GraveType::all();

        // render with inertia
        return Inertia::render('Admin/Products/Types/Create', [
            'clusters' => $clusters,
            'blocks' => $blocks
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
            'block'        => 'required',
            'name'          => 'required',
            'description'   => 'required',
        ]);

        GraveType::create([
            'cluster_id' => $request->cluster['id'],
            'block_id' => $request->block['id'],
            'name' => $request->name,
            'description' => $request->description
        ]);

        //redirect
        return redirect()->route('admin.products.types.index');
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        //get type
        $type = GraveType::findOrFail($id)->load('cluster', 'block');

        //render with inertia
        return Inertia::render('Admin/Products/Types/Edit', [
            'type'   => $type,
        ]);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $role
     * @return void
     */
    public function update(Request $request, GraveType $type)
    {
        /**
         * validate request
         */
        $request->validate([
            'cluster'      => 'required',
            'block'        => 'required',
            'name'          => 'required|unique:grave_blocks,name,' . $type->id,
            'description'   => 'required',
        ]);

        //update type
        $type->update([
            'cluster_id' => $request->cluster['id'],
            'block_id' => $request->block['id'],
            'name' => $request->name,
            'description' => $request->description
        ]);

        //redirect
        return redirect()->route('admin.products.types.index', $type->id);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find type by ID
        $type = GraveType::findOrFail($id);

        //delete type
        $type->delete();

        //redirect
        return redirect()->route('admin.products.types.index');
    }
}
