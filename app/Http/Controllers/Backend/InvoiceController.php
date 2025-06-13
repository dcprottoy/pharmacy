<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\ExpireDateMedecines;
use App\Models\Backend\Invoice;
use App\Models\Backend\Mrr;
use Illuminate\Support\Carbon;
use App\Models\Backend\Supplier;

class InvoiceController extends Controller
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
        $lastid = Invoice::where('invoice_id','>',$checkingID)->orderBy('invoice_id', 'desc')->first();
        if($lastid){
            $invoice_id = $lastid->invoice_id+1;
        }else{
            $invoice_id = strval($date->year).str_pad(strval($date->month),2,'0',STR_PAD_LEFT).'0001';
        }
        // return response()->json($request->all());

        $inputs = $request->all();
       


        $invoice = new Invoice();
        $invoice->fill($inputs);
        $invoice->invoice_id = (int)$invoice_id;
        $invoice->bill_date = $date->format('Y-m-d');
        $invoice->save();

        return $invoice;
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
