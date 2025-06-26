<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Mrr;
use App\Models\Backend\StockEntryLog;
use Illuminate\Support\Carbon;

class StockEntryReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date = Carbon::now()->subDay(1)->format('Y-m-d');
        $data['mrrs'] = Mrr::where('purchase_date','=',$date)->get();
        $data['stock_entry_logs'] = StockEntryLog::join('products','stock_entry_logs.medecine_id','=','products.id')->whereIn('mrr_id',$data['mrrs']->pluck('mrr_id'))->select('stock_entry_logs.*','products.name','products.product_sub_category','products.generic')->get();
        // return $data;
        return view('backend.stockentryreport.index',$data);
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
        $data['mrrs'] = Mrr::whereBetween('purchase_date',[$request->from_date,$request->to_date])->get();
        $data['stock_entry_logs'] = StockEntryLog::join('products','stock_entry_logs.medecine_id','=','products.id')->whereIn('mrr_id',$data['mrrs']->pluck('mrr_id'))->select('stock_entry_logs.*','products.name','products.product_sub_category','products.generic')->get();
        $data['from_date'] = $request->from_date;
        $data['to_date'] = $request->to_date;
        // return $data;
        return view('backend.stockentryreport.index',$data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
