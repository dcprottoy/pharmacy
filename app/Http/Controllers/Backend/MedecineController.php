<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Medecine;

class MedecineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['medecines'] = Medecine::paginate(50);
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
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            $advice = new Medecine();
            $advice->fill($request->all())->save();
            return back()->with('success','New Advice Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = Medecine::findOrFail($id);
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
            $advice = Medecine::findOrFail($id);
            $data = $request->only(['manufacturer',
            'name',
            'generic',
            'strength',
            'type',
            'use_for',
            'category']
                                );
            $advice->fill($data)->save();
            return back()->with('success','Advice '.$advice->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Medecine::find($id)){
            $createObject = Medecine::find($id);
            $createObject->delete();
            return back()->with('success','Diagnosis Remove Successfully');
        }else{
            return back()->with('danger','Diagnosis Not Found');
        }
    }
}
