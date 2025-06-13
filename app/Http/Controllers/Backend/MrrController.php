<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\StockEntryLog;
use App\Models\Backend\Mrr;
use Illuminate\Support\Carbon;
use App\Models\Backend\Supplier;


class MrrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $checkingID = (int)strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0000';
        $lastid = Mrr::where('mrr_id','>',$checkingID)->orderBy('mrr_id', 'desc')->first();
        if($lastid){
            $mrr_id = $lastid->mrr_id+1;
        }else{
            $mrr_id = strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0001';
        }
        // return response()->json($request->all());

        $inputs = $request->all();
        $supplier = Supplier::where('name_eng','=',$inputs['supplier_name'])->first();
        if($supplier){
            $inputs['supplier_id'] = $supplier->id;
        }else{
            $supplier = new Supplier();
            $supplier->name_eng = $inputs['supplier_name'];
            $supplier->save();
            $inputs['supplier_id'] = $supplier->id;
        }


        $mrr = new Mrr();
        $mrr->fill($inputs);
        $mrr->mrr_id = (int)$mrr_id;
        $mrr->save();

        return $mrr;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = Mrr::where('mrrs.mrr_id', '=', $id)->first();
        $stock_entries = StockEntryLog::join('products','stock_entry_logs.medecine_id','=','products.id')
                    ->select('stock_entry_logs.*','products.name')
                    ->where('mrr_id','=',$id)->get();
        return response()->json(['mrr'=>$lastid,'stock'=>$stock_entries]);
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
     * Search the specified resource in storage.
     */
    public function search(Request $request)
    {
        $lastid = Mrr::where('mrrs.mrr_id', 'like', '%'.$request->search.'%')->select('mrr_id')->get();
        return $lastid;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
