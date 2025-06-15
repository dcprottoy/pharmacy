<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Backend\ProductType;
use App\Models\Backend\Manufacturer;
use App\Models\Backend\ProductCategory;
use App\Models\Backend\ProductSubCategory;
use App\Models\Backend\MedecineUsage;

class OtherProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['products'] = Product::whereNotIn('product_type_id',[1])->paginate(50);
        $data['manufacturers'] = Manufacturer::all();
        $data['product_types'] = ProductType::whereNotIn('id',[1])->get();
        $data['product_categories'] = ProductCategory::whereNotIn('product_type_id',[1])->get();
        $data['product_sub_categories'] = ProductSubCategory::whereNotIn('product_type_id',[1])->get();
        return view('backend.otherprducts.index',$data);
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
            'name' => 'required',
        ]);
        // return response()->json($request->all());
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            return back()->withErrors($validated)->withInput();
        }else{

            $inputs = $request->all();
            $manufacturer = Manufacturer::where('name_eng','=',$inputs['manufacturer'])->first();
            if($manufacturer){
               $inputs['manufacturer_id'] = $manufacturer->id;
            }else{
                $manufacturer = new Manufacturer();
                $manufacturer->name_eng = $inputs['manufacturer'];
                $manufacturer->save();
                $inputs['manufacturer_id'] = $manufacturer->id;
            }
            $inputs['product_type'] = ProductType::find($inputs['product_type_id'])->name_eng;
            $inputs['product_category'] = ProductCategory::find($inputs['product_category_id'])->name_eng;
            $inputs['product_sub_category'] = ProductSubCategory::find($inputs['product_sub_category_id'])->name_eng;
           
            // return $inputs;
            $advice = new Product();
            $advice->fill($inputs)->save();
            return back()->with('success','New Product Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = Product::findOrFail($id);
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
            'name' => 'required',
            'manufacturer' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }else{
            $advice = Product::findOrFail($id);
            $inputs = $request->all();
            $manufacturer = Manufacturer::where('name_eng','=',$inputs['manufacturer'])->first();
            if($manufacturer){
               $inputs['manufacturer_id'] = $manufacturer->id;
            }else{
                $manufacturer = new Manufacturer();
                $manufacturer->name_eng = $inputs['manufacturer'];
                $manufacturer->save();
                $inputs['manufacturer_id'] = $manufacturer->id;
            }
             $inputs['product_type'] = ProductType::find($inputs['product_type_id'])->name_eng;
            $inputs['product_category'] = ProductCategory::find($inputs['product_category_id'])->name_eng;
            $inputs['product_sub_category'] = ProductSubCategory::find($inputs['product_sub_category_id'])->name_eng;
           
            // return $inputs;
           
            $advice->fill($inputs)->save();
            return back()->with('success','Medecine '.$advice->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Product::find($id)){
            $createObject = Product::find($id);
            $createObject->delete();
            return back()->with('success','Medecine Remove Successfully');
        }else{
            return back()->with('danger','Medecine Not Found');
        }
    }
}
