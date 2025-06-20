<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\MedecineStock;
use App\Models\Backend\ExpireDateMedecines;
use App\Models\Backend\StockEntryLog;
use App\Models\Backend\Manufacturer;
use App\Models\Backend\Medecine;
use App\Models\Backend\Product;
use App\Models\Backend\Supplier;
use App\Models\Backend\Mrr;
use App\Models\Backend\Invoice;
use App\Models\Backend\InvoiceDetails;
use App\Models\Backend\ProductType;
use App\Models\Backend\ProductCategory;
use App\Models\Backend\ProductSubCategory;
use App\Models\Backend\MedecineUsage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;



class SalesController extends Controller
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
        return view('backend.sales.index',$data);
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

        $date = Carbon::now();
        $validated = Validator::make($request->all(),[
            'item_id' => 'required',
        ]);
        // return response()->json($request->all());
        if($validated->fails()){
            return back()->withErrors($validated)->withInput();
        }
        if($request->has('invoice_no') && $request->invoice_no != null){
            return response()->json(['error'=>'Invoice already exists !!']);
        }
        $checkingID = (int)strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0000';
        $lastid = Invoice::where('invoice_id','>',$checkingID)->orderBy('invoice_id', 'desc')->first();
        if($lastid){
            $invoice_id = $lastid->invoice_id+1;
        }else{
            $invoice_id = strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0001';
        }

        if($request->has('customer_name') && $request->customer_name != null){
            $customer_name = $request->customer_name;
        }else{
            $customer_name = 'Customer';
        }

        if($request->has('contact_no') && $request->contact_no != null){
            $contact_no	 = $request->contact_no	;
        }else{
            $contact_no	 = '';
        }
try {


        DB::beginTransaction();
        $invoice = new Invoice();
        $invoice->invoice_id = $invoice_id;
        $invoice->bill_date = $date->format('Y-m-d');
        $invoice->discount_amount = $request->bill_dis_amt;
        $invoice->total_amount = $request->bill_amount;
        $invoice->paid_amount = $request->bill_paid_amount;
        $invoice->discount_percent = $request->bill_in_per;
        $invoice->payable_amount = $request->bill_total_amount;
        $invoice->due_amount = $request->bill_due_amount;
        $invoice->customer_name = $customer_name;
        $invoice->contact_no = $contact_no;
        $invoice->save();

        foreach($request->item_id as $key => $id){
            $product_id = $request->product_id[$id];
            $product = Product::find($product_id);
            // return $product;
            if(((int)$product->current_stock - (int)$request->quantity[$id]) >= 0 && $request->final_price[$id] > 0){
                
                $invoice_details = new InvoiceDetails();
                $invoice_details->invoice_id = $invoice->invoice_id;
                $invoice_details->product_id = $product->id;
                $invoice_details->product_name =$product->name;
                $invoice_details->bill_date = $date;
                $invoice_details->mrp_price = $request->mrp_price[$id];
                $invoice_details->price = $request->price[$id];
                $invoice_details->quantity = $request->quantity[$id];
                $invoice_details->final_price = $request->final_price[$id];
                $invoice_details->discount_percent = $request->discount_percent[$id];
                $invoice_details->discount_amount = $request->discount_amount[$id];
                $invoice_details->save();
                
            }else{
                $invoice->delete();
            }

            $product->current_stock = $product->current_stock - $request->quantity[$id];
            $product->total_sale = $product->total_sale + $request->quantity[$id];
            $product->stock_per =  ceil(((int)$product->current_stock/(int)$product->last_stock)*100);
            $product->save();

        }

        DB::commit();
            return response()->json(['success'=>'Item Added Successfully !!','invoice'=>$invoice]);

        }catch (Exception $e) {
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
        
        // try {
        //         $invoice_details = InvoiceDetails::find($id);
        //         $medecine = Product::find($invoice_details->product_id);
        //         $expire_wise = ExpireDateMedecines::where('medecine_id','=',$medecine->id)->where('expiry_date','=',$invoice_details->expire_date)->first();
        //         $invoice = Invoice::where('invoice_id','=',$invoice_details->invoice_id)->first();

        //         if(((int)$expire_wise->current_qty + (int)$invoice_details->quantity ) - (int)$request->quantity < 0){
        //                 return response()->json(['error'=>'Stock not available !!']);
        //         }

        //         DB::beginTransaction();

               


        //         $expire_wise->current_qty = ($expire_wise->current_qty + $invoice_details->quantity ) - $request->quantity;
        //         $expire_wise->sell_qty = ($expire_wise->sell_qty - $invoice_details->quantity) + $request->quantity;
        //         $expire_wise->save();
                
        //         $medecine->current_stock = ( $medecine->current_stock + $invoice_details->quantity ) - $request->quantity;
        //         $medecine->total_sale = ($medecine->total_sale - $invoice_details->quantity) + $request->quantity;
        //         $medecine->stock_per =  ceil(((int)$medecine->current_stock/(int)$medecine->last_stock)*100);
        //         $medecine->save();

        //         $invoice->total_amount = ((int)$invoice->total_amount - (int)$invoice_details->price) + (int)$request->price;
        //         $invoice->discount_amount = ((int)$invoice->discount_amount - (int)$invoice_details->discount_amount) + (int)$request->discount_amount;
        //         $invoice->discount_percent = ceil(((int)$invoice->discount_amount / (int)$invoice->total_amount)*100);
        //         $invoice->payable_amount = (int)$invoice->total_amount - (int)$invoice->discount_amount;
        //         $invoice->due_amount = $invoice->payable_amount - $invoice->paid_amount;
        //         $invoice->save();

        //         $invoice_details->price = $request->price;
        //         $invoice_details->quantity = $request->quantity;
        //         $invoice_details->final_price = $request->final_price;
        //         $invoice_details->discount_percent = $request->discount_percent;
        //         $invoice_details->discount_amount = $request->discount_amount;
        //         $invoice_details->save();
                

        //         DB::commit();

        //         return response()->json(["invoice_details" => $invoice_details,"invoice" => $invoice]);


        // }catch (Exception $e) {
        //     DB::rollBack(); 

        //     return response()->json(['error' => 'Transaction failed.', 'message' => $e->getMessage()], 500);
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // try {
        //     DB::beginTransaction();

        //         $invoice_details = InvoiceDetails::find($id);
        //         $medecine = Product::find($invoice_details->product_id);
        //         $expire_wise = ExpireDateMedecines::where('medecine_id','=',$medecine->id)->where('expiry_date','=',$invoice_details->expire_date)->first();
        //         $invoice = Invoice::where('invoice_id','=',$invoice_details->invoice_id)->first();


        //         $expire_wise->current_qty = ($expire_wise->current_qty + $invoice_details->quantity );
        //         $expire_wise->sell_qty = ($expire_wise->sell_qty - $invoice_details->quantity);
        //         $expire_wise->save();
                
        //         $medecine->current_stock = ( $medecine->current_stock + $invoice_details->quantity );
        //         $medecine->total_sale = ($medecine->total_sale - $invoice_details->quantity);
        //         $medecine->stock_per =  ceil(((int)$medecine->current_stock/(int)$medecine->last_stock)*100);
        //         $medecine->save();

        //         $invoice->total_amount = ((int)$invoice->total_amount - (int)$invoice_details->price);
        //         $invoice->discount_amount = ((int)$invoice->discount_amount - (int)$invoice_details->discount_amount);
        //         if($invoice->total_amount !=0 ){
        //             $invoice->discount_percent = ceil(((int)$invoice->discount_amount / (int)$invoice->total_amount)*100);
        //         }
        //         else{
        //             $invoice->discount_percent = 0;
        //         }
        //         $invoice->payable_amount = (int)$invoice->total_amount - (int)$invoice->discount_amount;
        //         $invoice->due_amount = $invoice->payable_amount - $invoice->paid_amount;
        //         $invoice->save();

               
        //         $invoice_details->delete();
                

        //         DB::commit();

        //         return response()->json(["invoice_details" => $invoice_details,"invoice" => $invoice]);


        // }catch (Exception $e) {
        //     DB::rollBack(); 

        //     return response()->json(['error' => 'Transaction failed.', 'message' => $e->getMessage()], 500);
        // }
    }

    /**
     * Fetch the billing item and associated equipment of a given bill item id
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function billingitems(string $id){
       
    }



    public function search(Request $request)
    {
        $lastid = Product::where('name', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }


}
