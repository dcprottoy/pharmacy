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

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StockMedecineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['medecineList'] = Product::orderBy('name','asc')->get();
        $data['manufacturer'] = Manufacturer::orderBy('name_eng','asc')->select('name_eng')->get();;
        return view('backend.stockmedecine.index',$data);
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
        ]);
        // return response()->json($request->all());

        if($validated->fails()){
            return back()->withErrors($validated)->withInput();
        }

        $medecine_id = (int)$request->item_id;

        $medecine = MedecineStock::find($medecine_id);
        // return $medecine;

        $medecine->last_stock = $request->current_stock;
        $medecine->current_stock = $request->current_stock;
        $medecine->mrp_rate = $request->mrp_rate;
        $medecine->tp_rate = $request->tp_rate;
        $medecine->stock_cell = $request->stock_cell;
        $medecine->stock_per = 100;
        $medecine->stock_date = $date;
        $medecine->total_stock = $medecine->total_stock + $request->stock_quantity;
        $medecine->save();

             // {
        //     "item_id": "1",
        //     "name": "Napa 125",
        //     "stock_cell": "0.00",
        //     "mrp_rate": "0.00",
        //     "tp_rate": "0.00",
        //     "stock_per": null,
        //     "current_stock": "0.00",
        //     "stock_quantity": "0",
        //     "expire_date": null,
        //     "_token": "YpjkIFL7vVadow526OuIauFEMTF2qShHLFTq3nZR"
        //   }
        if($request->expire_date != ""){

            $expiry_wise = new ExpireDateMedecines();
            $expiry_wise->medecine_id = $medecine->id;
            $expiry_wise->stock_date = $date;
            $expiry_wise->expiry_date = $request->expire_date;
            $expiry_wise->stock_qty = $request->stock_quantity;
            $expiry_wise->current_qty = $request->stock_quantity;
            $expiry_wise->save();

            $stock_log = new StockEntryLog();
            $stock_log->medecine_id = $medecine->id;
            $stock_log->stock_date = $date;
            $stock_log->expiry_date = $request->expire_date;
            $stock_log->stock_qty = $request->stock_quantity;
            $stock_log->save();

        }



        return response()->json(['success'=>$medecine]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stock = MedecineStock::find((int)$id);
        $expiryDate = ExpireDateMedecines::where('medecine_id','=',(int)$id)
                        ->where('medecine_id','=',(int)$id)
                        ->where('current_qty','>',0)
                        ->select('expiry_date','current_qty')
                        ->get();

        return response()->json(['item'=>$stock,'expiryDates'=>$expiryDate]);
    }

    public function todaySummary()
    {

        $date = Carbon::now()->format('Y-m-d');


        $data['todaystock'] = StockEntryLog::leftJoin('medecine_stocks','stock_entry_logs.medecine_id','=','medecine_stocks.id')
        ->select('stock_entry_logs.stock_qty','stock_entry_logs.stock_date','medecine_stocks.manufacturer','medecine_stocks.name','medecine_stocks.generic','medecine_stocks.strength','medecine_stocks.type','medecine_stocks.use_for','medecine_stocks.category','medecine_stocks.current_stock' )
        ->where('stock_entry_logs.stock_date','=',$date)
        ->get();
        // return $data;
        return view('backend.stockmedecine.todaystocksummary',$data);

    }

    public function stockEntrySummary()
    {

        $date = Carbon::now()->format('Y-m-d');


        $data['todaystock'] = StockEntryLog::leftJoin('medecine_stocks','stock_entry_logs.medecine_id','=','medecine_stocks.id')
        ->select('stock_entry_logs.stock_qty','stock_entry_logs.stock_date','medecine_stocks.manufacturer','medecine_stocks.name','medecine_stocks.generic','medecine_stocks.strength','medecine_stocks.type','medecine_stocks.use_for','medecine_stocks.category','medecine_stocks.current_stock' )
        ->where('stock_entry_logs.stock_date','=',$date)
        ->get();
        // return $data;
        return view('backend.stockmedecine.stocksummary',$data);

    }

    public function stockEntrySummaryDate(Request $request)
    {


        $validated = Validator::make($request->all(),[
            'from_date' => 'required',
            'to_date' => 'required',
        ]);

        if($validated->fails()){
            return back()->withErrors($validated)->withInput();
        }
        $date = Carbon::now()->format('Y-m-d');
        $date1 = $request->from_date;
        $date2 = $request->to_date;

        $data['todaystock'] = StockEntryLog::leftJoin('medecine_stocks','stock_entry_logs.medecine_id','=','medecine_stocks.id')
        ->select('stock_entry_logs.stock_qty','stock_entry_logs.stock_date','medecine_stocks.manufacturer','medecine_stocks.name','medecine_stocks.generic','medecine_stocks.strength','medecine_stocks.type','medecine_stocks.use_for','medecine_stocks.category','medecine_stocks.current_stock' )
        ->whereBetween('stock_entry_logs.stock_date',[$date1,$date2])
        ->get();
        // return $data;
        return view('backend.stockmedecine.stocksummary',$data);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Fetch the billing item and associated equipment of a given bill item id
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function billingitems(string $id){
        $lastid = BillItems::findOrFail($id);
        $equip = InvestigationEquipSetup::with('equip')->where('investigation_main_id','=',$id)->get();

        return response()->json(["equipments"=>$equip,"item"=>$lastid]);
    }



    public function search(Request $request)
    {
        $lastid = MedecineStock::where('name', 'like', '%'.$request->search.'%')->get();
        return $lastid;
    }


}
