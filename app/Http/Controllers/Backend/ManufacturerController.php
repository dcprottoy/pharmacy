<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Manufacturer;
use App\Models\Backend\ProductType;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['manufacturer'] = Manufacturer::all();
        $data['product_types'] = ProductType::all();
        return view('backend.manufacturer.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name_eng' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            
            $manufacturer = new Manufacturer();
            $manufacturer->fill($request->all())->save();
            return back()->with('success','New Manufacturer Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = Manufacturer::findOrFail($id);
        return $lastid;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(),[
            'name_eng' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }else{
            $manufacturer = Manufacturer::findOrFail($id);
            $data = $request->only(['name_eng',
                                    'product_type_id',
                                    'status']
                                );
            $manufacturer->fill($data)->save();
            return back()->with('success','Manufacturer '.$manufacturer->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Manufacturer::find($id)){
            $createObject = Manufacturer::find($id);
            $createObject->delete();
            return back()->with('success','Manufacturer Remove Successfully');
        }else{
            return back()->with('danger','Manufacturer Not Found');
        }
    }
}
