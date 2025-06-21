<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\ExpireDateMedecines;
use App\Models\Backend\StockEntryLog;
use App\Models\Backend\Manufacturer;
use App\Models\Backend\StoreLocation;
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

class StockApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['stores'] = StoreLocation::all();
        
        $data['mrrs'] = Mrr::orderBy('mrr_id','desc')->get();
        return view('backend.stockapprove.index',$data);
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
        // return $request->all();
        $mrr = Mrr::where('mrr_id','=',(int)$request->mrr_id)->first();
        if($request->type == 'update'){
            $mrr->fill($request->all())->save();
        }else if($request->type == 'approve'){
            $mrr->approved = true;
            $mrr->save();
        }else if($request->type == 'not_approve'){
            $mrr->approved = false;
            $mrr->save();
        }else if($request->type == 'done_mrr'){
            $mrr->done = true;
            $mrr->save();
        }else if($request->type == 'not_done_mrr'){
            $mrr->done = false;
            $mrr->save();
        }
        return response()->json(['success'=>'Data Updated successfully !!','mrr'=>$mrr]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['mrrs'] = Mrr::find($id);
        if($data['mrrs'] == null){
            return response()->json(['error'=>'Mrr not found !!']);
        }
        $data['stock_details'] = StockEntryLog::leftJoin('products','stock_entry_logs.medecine_id','=','products.id')->where('mrr_id','=',$data['mrrs']->mrr_id)->select('stock_entry_logs.*','products.name','products.product_sub_category','products.current_stock')->get();
        
        $data['suppliers'] = Supplier::orderBy('name_eng','asc')->select('name_eng')->get();
       
        return view('backend.stockapprove.show',$data);
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

        $stock_log = StockEntryLog::find($id);
        $mrr_status = Mrr::where('mrr_id','=', $stock_log->mrr_id)->first();
        if($mrr_status->approved == 1){
            return response()->json(['error'=>'Mrr already approved !!']);
        }
        if($mrr_status->done == 1){
            return response()->json(['error'=>'Mrr already Completed !!']);
        }

        try {


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
        $mrr_status = Mrr::where('mrr_id','=', $stock_log->mrr_id)->first();
        if($mrr_status->approved == 1){
            return response()->json(['error'=>'Mrr already approved !!']);
        }
        if($mrr_status->done == 1){
            return response()->json(['error'=>'Mrr already Completed !!']);
        }
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

