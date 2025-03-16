<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\MedecineStock;
use App\Models\Backend\StockEntryLog;
use App\Models\Backend\Medecine;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MedecineStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.medecinestock.index');
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
            "name"=>'required',
            "type"=>'required',
            "manufacturer"=>'required',
            "generic"=>'required',
            "strength"=>'required',
            "use_for"=>'required'
        ]);
        // return response()->json($request->all());

        if($validated->fails()){
            return back()->withErrors($validated)->withInput();
        }

        $isExists = MedecineStock::where('name','=',$request->name)->first();
        if($isExists){
            return response()->json(['existed'=>$isExists]);
        }
        $stock = new MedecineStock();
        $stock->manufacturer = $request->manufacturer;
        $stock->name = $request->name;
        $stock->generic = $request->generic;
        $stock->strength = $request->strength;
        $stock->type = $request->type;
        $stock->use_for = $request->use_for;
        $stock->category = $request->category;
        $stock->save();
        return response()->json(['success'=>$stock]);



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stock = MedecineStock::find((int)$id);

        return response()->json($stock);
    }

    public function todaySummary()
    {

        $date = Carbon::now()->format('Y-m-d');


        $data['todaystock'] = StockEntryLog::leftJoin('medecine_stocks','stock_entry_logs.medecine_id','=','medecine_stocks.id')
        ->select('stock_entry_logs.stock_qty','stock_entry_logs.stock_date','medecine_stocks.manufacturer','medecine_stocks.name','medecine_stocks.generic','medecine_stocks.strength','medecine_stocks.type','medecine_stocks.use_for','medecine_stocks.category','medecine_stocks.current_stock' )
        ->where('stock_entry_logs.stock_date','=',$date)
        ->get();
        // return $data;
        return view('backend.medecinestock.todaystocksummary',$data);

    }

    public function stockEntrySummary()
    {

        $date = Carbon::now()->format('Y-m-d');


        $data['todaystock'] = StockEntryLog::leftJoin('medecine_stocks','stock_entry_logs.medecine_id','=','medecine_stocks.id')
        ->select('stock_entry_logs.stock_qty','stock_entry_logs.stock_date','medecine_stocks.manufacturer','medecine_stocks.name','medecine_stocks.generic','medecine_stocks.strength','medecine_stocks.type','medecine_stocks.use_for','medecine_stocks.category','medecine_stocks.current_stock' )
        ->where('stock_entry_logs.stock_date','=',$date)
        ->get();
        // return $data;
        return view('backend.medecinestock.stocksummary',$data);

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
        return view('backend.medecinestock.stocksummary',$data);

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





    public function search(Request $request)
    {
        $lastid = Medecine::leftJoin('medecine_stocks','medecines.stock_id','=','medecine_stocks.id')
                ->where('medecines.name', 'like', '%'.$request->search.'%')
                ->select('medecines.id','medecines.manufacturer','medecines.name','medecines.generic','medecines.strength','medecines.type','medecines.use_for','medecines.category','medecines.stock_id','medecine_stocks.current_stock')
                ->get();
        return $lastid;
    }
}
