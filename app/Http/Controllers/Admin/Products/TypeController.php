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
        })->latest()->paginate(10)->withQueryString();

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
        // render with inertia
        return Inertia::render('Admin/Products/Types/Create');
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
            'width'        => 'required|numeric',
            'height'       => 'required|numeric',
            'price'        => 'required|numeric',
            'description'   => 'required',
        ]);

        GraveType::create([
            'name' => $request->name,
            'width' => $request->width,
            'height' => $request->height,
            'price' => $request->price,
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
        $type = GraveType::findOrFail($id);

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
            'name'          => 'required|unique:grave_types,name,' . $type->id,
            'width'        => 'required|numeric',
            'height'       => 'required|numeric',
            'price'        => 'required|numeric',
            'description'   => 'required',
        ]);

        //update type
        $type->update([
            'name' => $request->name,
            'width' => $request->width,
            'height' => $request->height,
            'price' => $request->price,
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
