<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\ExpireDateMedecines;
use App\Models\Backend\StockEntryLog;
use App\Models\Backend\Manufacturer;
use App\Models\Backend\Medecine;
use App\Models\Backend\Product;
use App\Models\Backend\Supplier;
use App\Models\Backend\Mrr;
use App\Models\Backend\ProductType;
use App\Models\Backend\ProductCategory;
use App\Models\Backend\ProductSubCategory;
use App\Models\Backend\MedecineUsage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
class StockEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['medecineList'] = Product::orderBy('name','asc')->get();
        $data['mrrs'] = Mrr::orderBy('mrr_id','desc')->select('mrr_id')->take(10)->get();
        $data['suppliers'] = Supplier::orderBy('name_eng','asc')->select('name_eng')->get();
        $data['manufacturers'] = Manufacturer::orderBy('name_eng','asc')->select('name_eng')->get();
        $data['product_categories'] = ProductCategory::all();
        $data['product_types'] = ProductSubCategory::where('product_type_id',1)->get();
        $data['medecineusages'] = MedecineUsage::all();
        return view('backend.stockentry.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $date = Carbon::now()->format('Y-m-d');
        $validated = Validator::make($request->all(),[
            'item_id' => 'required',
            'expire_date' => 'required',
            'manufacture_date' => 'required',
        ]);
        // return response()->json($request->all());

        if($validated->fails()){
            return response()->json(['error'=>'Something went wrong !!']);
        }

        $item_id = (int)$request->item_id;
        try {
            DB::beginTransaction();
            $medecine = Product::find($item_id);
            // return $medecine;

            $medecine->last_stock = $request->current_stock;
            $medecine->current_stock = $request->current_stock;
            $medecine->mrp_rate = $request->mrp_rate;
            $medecine->tp_rate = $request->tp_rate;
            $medecine->stock_location = $request->stock_location;
            $medecine->stock_per = ceil(((int)$medecine->current_stock/(int)$medecine->last_stock)*100);
            // $medecine->stock_date = $date;
            $medecine->total_stock = $medecine->total_stock + $request->stock_quantity;
            $medecine->save();
            $item_exists_expiry = ExpireDateMedecines::where('medecine_id','=',$medecine->id)->where('expiry_date','=',$request->expire_date)->first();
            if($item_exists_expiry){
                $item_exists_expiry->stock_qty = (int)$item_exists_expiry->stock_qty + (int)$request->stock_quantity;
                $item_exists_expiry->current_qty = (int)$item_exists_expiry->current_qty + (int)$request->stock_quantity;
                $item_exists_expiry->save();
            }else{
                $expiry_wise = new ExpireDateMedecines();
                $expiry_wise->medecine_id = $medecine->id;
                $expiry_wise->expiry_date = $request->expire_date;
                $expiry_wise->stock_qty = $request->stock_quantity;
                $expiry_wise->current_qty = $request->stock_quantity;
                $expiry_wise->save();
            }
            
            $stock_log = new StockEntryLog();
            $stock_log->medecine_id = $medecine->id;
            $stock_log->mrr_id = $request->mrr_id;
            $stock_log->stock_date = $date;
            $stock_log->expiry_date = $request->expire_date;
            $stock_log->manufacture_date = $request->manufacture_date;
            $stock_log->stock_qty = $request->stock_quantity;
            $stock_log->save();

            DB::commit(); 

            return response()->json(['success'=>$medecine,'expiry_log'=>$stock_log]);
            
            } catch (Exception $e) {
                DB::rollBack(); 

                return response()->json(['error' => 'Transaction failed.', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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

        try {

            $stock_log = StockEntryLog::find($id);

            $expiry_wise = ExpireDateMedecines::where('medecine_id','=',$stock_log->medecine_id)->where('expiry_date','=',$stock_log->expiry_date)->first();

            // return response()->json([$request->all()]);

            $item_id = $stock_log->medecine_id;
            $medecine = Product::find($item_id);
            if(((int)$expiry_wise->current_qty - (int)$stock_log->stock_qty) < 0){
                return response()->json(['error'=>'Stock not available !!']);
            }

            DB::beginTransaction(); 

            
            // return $medecine;

            $medecine->last_stock = ((int)$medecine->last_stock - (int)$stock_log->stock_qty)+(int)$request->stock_qty;;
            $medecine->current_stock = ((int)$medecine->current_stock - (int)$stock_log->stock_qty)+(int)$request->stock_qty;
            $medecine->stock_per = ceil(((int)$medecine->current_stock/(int)$medecine->last_stock)*100);
            $medecine->total_stock = ((int)$medecine->total_stock - (int)$stock_log->stock_qty)+(int)$request->stock_qty;
            $medecine->save();

            $expiry_wise->stock_qty = ((int)$expiry_wise->stock_qty - (int)$stock_log->stock_qty)+(int)$request->stock_qty;
            $expiry_wise->current_qty = ((int)$expiry_wise->current_qty - (int)$stock_log->stock_qty)+(int)$request->stock_qty;
            $expiry_wise->update();

           
            $stock_log->stock_qty = $request->stock_qty;
            $stock_log->update();

            DB::commit();
            
            return response()->json(['success'=>$medecine,'expiry_log'=>$stock_log]);

        }catch (Exception $e) {
            DB::rollBack(); 

            return response()->json(['error' => 'Transaction failed.', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stock_log = StockEntryLog::find($id);
        // return response()->json([$stock_log]);
        $expiry_wise = ExpireDateMedecines::where('medecine_id','=',$stock_log->medecine_id)->where('expiry_date','=',$stock_log->expiry_date)->first();

        $item_id = $stock_log->medecine_id;
        $medecine = Product::find($item_id);
        // return $medecine;

        $medecine->last_stock = ((int)$medecine->last_stock - (int)$stock_log->stock_qty);
        $medecine->current_stock = ((int)$medecine->current_stock - (int)$stock_log->stock_qty);
        $medecine->total_stock = ((int)$medecine->total_stock - (int)$stock_log->stock_qty);
        $medecine->stock_per = ceil(((int)$medecine->current_stock/(int)$medecine->last_stock)*100);

        $expiry_wise->stock_qty = ((int)$expiry_wise->stock_qty - (int)$stock_log->stock_qty);
        $expiry_wise->current_qty = ((int)$expiry_wise->current_qty - (int)$stock_log->stock_qty);
        if(((int)$expiry_wise->current_qty - (int)$stock_log->stock_qty) < 0){
            return response()->json(['error'=>'Stock not available !!']);
        }
        $medecine->save();

        $expiry_wise->update();
    
        $stock_log->delete();

        
        return response()->json(['success'=>$medecine]);
    }

    /**
     * Fetch the billing item and associated equipment of a given bill item id
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function search(Request $request)
    {
        $lastid = Product::where('name', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }


}
