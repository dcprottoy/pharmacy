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
use App\Models\Backend\ExpireDateMedecines;
use App\Models\Backend\Medecine;
use App\Models\Backend\StoreLocation;



class MedecineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['medecines'] = Product::paginate(50);
        $data['manufacturers'] = Manufacturer::all();
        $data['product_types'] = ProductType::get();
        $data['product_categories'] = ProductCategory::get();
        $data['product_sub_categories'] = ProductSubCategory::get();
        $data['medecineusages'] = MedecineUsage::all();
        $data['store_locations'] = StoreLocation::all();
        return view('backend.medecine.index',$data);
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
            // return back()->withErrors($validated)->withInput();
        }else{

            $isExists = Product::where('name','=',$request->name)->first();
            if($isExists){
                return response()->json(['existed'=>$isExists]);
            }
            $inputs = $request->all();

            if($request->has('manufacturer') && $request->manufacturer != 'null')
            {
                $manufacturer = Manufacturer::where('name_eng','=',$inputs['manufacturer'])->first();
                if($manufacturer){
                $inputs['manufacturer_id'] = $manufacturer->id;
                }else{
                    $manufacturer = new Manufacturer();
                    $manufacturer->name_eng = $inputs['manufacturer'];
                    $manufacturer->save();
                    $inputs['manufacturer_id'] = $manufacturer->id;
                }
            }

            if($request->has('product_type_id') && $request->product_type_id != null)
            {
                $inputs['product_type'] = ProductType::find($inputs['product_type_id'])->name_eng;
            }

            if($request->has('product_category_id') && $request->product_category_id != null)
            {
                $inputs['product_category'] = ProductCategory::find($inputs['product_category_id'])->name_eng;
            }

            if($request->has('product_sub_category_id') && $request->product_sub_category_id != null)
            {
                $inputs['product_sub_category'] = ProductSubCategory::find($inputs['product_sub_category_id'])->name_eng;
            }

            if($request->has('medicine_use_for_id') && $request->medicine_use_for_id != null)
            {
                $inputs['use_for'] = MedecineUsage::find($inputs['medicine_use_for_id'])->name_eng;
            }

            if($request->has('stock_location_id') && $request->stock_location_id != null)
            {
                $inputs['stock_location'] = StoreLocation::find($inputs['stock_location_id'])->name_eng;
            }
           
            // return $inputs;
            $advice = new Product();
            $advice->fill($inputs)->save();
            if($request->has('form')){
                return response()->json(['success'=>$advice]);
            }else return back()->with('success','New Medecine Created Successfully');

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

    public function medicineinfoBank(string $id)
    {
        $lastid = Medecine::findOrFail($id);
        return $lastid;
    }

    public function medicineFromBank(Request $request){
        $lastid = Medecine::where('name', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }

    public function productInfo(string $id){
        $stock = Product::find((int)$id);
        $expiryDate = ExpireDateMedecines::where('medecine_id','=',(int)$id)
                        ->where('medecine_id','=',(int)$id)
                        ->where('current_qty','>',0)
                        ->select('expiry_date','current_qty')
                        ->get();

        return response()->json(['item'=>$stock,'expiryDates'=>$expiryDate]);
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
            if($request->has('manufacturer') && $request->manufacturer != 'null')
            {
                $manufacturer = Manufacturer::where('name_eng','=',$inputs['manufacturer'])->first();
                if($manufacturer){
                $inputs['manufacturer_id'] = $manufacturer->id;
                }else{
                    $manufacturer = new Manufacturer();
                    $manufacturer->name_eng = $inputs['manufacturer'];
                    $manufacturer->save();
                    $inputs['manufacturer_id'] = $manufacturer->id;
                }
            }

            if($request->has('product_type_id') && $request->product_type_id != null)
            {
                $inputs['product_type'] = ProductType::find($inputs['product_type_id'])->name_eng;
            }

            if($request->has('product_category_id') && $request->product_category_id != null)
            {
                $inputs['product_category'] = ProductCategory::find($inputs['product_category_id'])->name_eng;
            }

            if($request->has('product_sub_category_id') && $request->product_sub_category_id != null)
            {
                $inputs['product_sub_category'] = ProductSubCategory::find($inputs['product_sub_category_id'])->name_eng;
            }

            if($request->has('medicine_use_for_id') && $request->medicine_use_for_id != null)
            {
                $inputs['use_for'] = MedecineUsage::find($inputs['medicine_use_for_id'])->name_eng;
            }

            if($request->has('stock_location_id') && $request->stock_location_id != null)
            {
                $inputs['stock_location'] = StoreLocation::find($inputs['stock_location_id'])->name_eng;
            }
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


    public function search(Request $request)
    {
        if($request->match == "P"){
            $lastid = Product::where('name', 'like', '%'.$request->search.'%')->get();
        }else if($request->match == "E"){
            $lastid = Product::where('name', 'like', $request->search.'%')->get();
        }
        return $lastid;
    }
}
