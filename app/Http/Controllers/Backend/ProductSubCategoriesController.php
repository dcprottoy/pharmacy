<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\ProductType;
use App\Models\Backend\ProductCategory;
use App\Models\Backend\ProductSubCategory;

class ProductSubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['stores'] = ProductSubCategory::with('producttype')->with('producttype')->get();
        $data['product_types'] = ProductType::all();
        $data['product_categories'] = ProductCategory::all();
        return view('backend.productsubcategory.index',$data);
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
            // return $request->input();
            // for($i=1;$i<61;$i++){
            //     $advice = new Store();
            //     $advice->name_eng = $i;
            //     $advice->save();
            // }
            $advice = new ProductSubCategory();
            $advice->fill($request->all())->save();
            return back()->with('success','New Cell Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = ProductSubCategory::with('producttype')->findOrFail($id);
        return $lastid;
    }





     public function subList(string $id)
    {
        $data = ProductSubCategory::where('product_category_id','=',(int)$id)->get();
        return $data;
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
            $item = ProductSubCategory::findOrFail($id);
            $data = $request->only(['name_eng',
                                    'product_type_id']
                                );
            $item->fill($data)->save();
            return back()->with('success','Product Category '.$item->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(ProductSubCategory::find($id)){
            $createObject = ProductSubCategory::find($id);
            $createObject->delete();
            return back()->with('success','Cell Remove Successfully');
        }else{
            return back()->with('danger','Cell Not Found');
        }
    }
}

