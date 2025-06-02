<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\MedecineStock;
use App\Models\Backend\Manufacturer;
use App\Models\Backend\MedecineCategory;
use App\Models\Backend\MedecineType;
use App\Models\Backend\MedecineUsage;


class MedecineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['medecines'] = MedecineStock::paginate(50);
        $data['manufacturers'] = Manufacturer::all();
        $data['medecinecategories'] = MedecineCategory::all();
        $data['medecinetypes'] = MedecineType::all();
        $data['medecineusages'] = MedecineUsage::all();
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
            
            $advice = new MedecineStock();
            $advice->fill($request->all())->save();
            return back()->with('success','New Medecine Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = MedecineStock::findOrFail($id);
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
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }else{
            $advice = MedecineStock::findOrFail($id);
            $data = $request->only(['manufacturer',
            'name',
            'generic',
            'strength',
            'type',
            'use_for',
            'category']
                                );
            $advice->fill($data)->save();
            return back()->with('success','Medecine '.$advice->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(MedecineStock::find($id)){
            $createObject = MedecineStock::find($id);
            $createObject->delete();
            return back()->with('success','Medecine Remove Successfully');
        }else{
            return back()->with('danger','Medecine Not Found');
        }
    }
}
