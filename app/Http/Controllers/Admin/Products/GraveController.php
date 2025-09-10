<?php

namespace App\Http\Controllers\Admin\Products;

use Inertia\Inertia;
use App\Models\Grave;
use App\Models\GraveType;
use App\Models\GraveCluster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GraveBlock;

class GraveController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $graves = Grave::with('cluster', 'block', 'type')
            ->orderBy('cluster_id')
            ->orderBy('block_id')
            ->orderBy('number')
            ->get();

        $clusters = GraveCluster::all();
        $blocks = GraveBlock::all();
        $types = GraveType::all();

        return Inertia::render('Admin/Products/Graves/Index', [
            'graves' => $graves,
            'clusters' => $clusters,
            'blocks' => $blocks,
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
        $blocks = GraveBlock::all();
        $types = GraveType::all();

        // render with inertia
        return Inertia::render('Admin/Products/Graves/Create', [
            'clusters' => $clusters,
            'blocks' => $blocks,
            'types' => $types
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
            'type'        => 'required',
            'from'        => 'required',
            'to'        => 'required',
            'code'          => 'required',
        ]);

        foreach (range($request->from, $request->to) as $number) {
            Grave::create([
                'cluster_id' => $request->cluster['id'],
                'block_id' => $request->block['id'],
                'type_id' => $request->type['id'],
                'code' => $request->code . str_pad($number, 3, '0', STR_PAD_LEFT),
                'number' => $number,
                'is_available' => $request->is_available ?? true,
                'is_occupied' => $request->is_occupied ?? false,
                'is_fully_paid' => $request->is_fully_paid ?? false
            ]);
        }
        // Grave::create([
        //     'cluster_id' => $request->cluster['id'],
        //     'block_id' => $request->block['id'],
        //     'type_id' => $request->type['id'],
        //     'name' => $request->name,
        //     'description' => $request->description
        // ]);

        //redirect
        return redirect()->route('admin.products.graves.index');
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        //get grave
        $grave = Grave::findOrFail($id)->load('cluster', 'block', 'type');

        //render with inertia
        return Inertia::render('Admin/Products/Graves/Edit', [
            'grave'   => $grave,
        ]);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $role
     * @return void
     */
    public function update(Request $request, Grave $grave)
    {
        /**
         * validate request
         */
        $request->validate([
            'cluster'      => 'required',
            'block'        => 'required',
            'type'        => 'required',
            'code'          => 'required|unique:graves,code,' . $grave->id,
            'description'   => 'required',
        ]);

        //update grave
        $grave->update([
            'cluster_id' => $request->cluster['id'],
            'block_id' => $request->block['id'],
            'type_id' => $request->type['id'],
            'code' => $request->code,
            'description' => $request->description
        ]);

        //redirect
        return redirect()->route('admin.products.graves.index', $grave->id);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find grave by ID
        $grave = Grave::findOrFail($id);

        //delete grave
        $grave->delete();

        //redirect
        return redirect()->route('admin.products.graves.index');
    }

    /**
     * getNumberOfGraves
     *
     * @return void
     */
    public function getNumberOfGraves()
    {
        $numberOfGraves = Grave::where('cluster_id', request()->cluster_id)
            ->where('block_id', request()->block_id)
            ->max('number') ?? 0;
        $numberOfGraves += 1;

        return response()->json(['count' => $numberOfGraves]);
    }
}
