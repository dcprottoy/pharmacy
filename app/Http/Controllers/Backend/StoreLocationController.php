<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\StoreLocation;

class StoreLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['stores'] = StoreLocation::all();
        return view('backend.storelocation.index',$data);
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
            'name_eng' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
            // return back()->withErrors($validated)->withInput();
        }else{
            // return $request->input();
            // for($i=1;$i<61;$i++){
            //     $advice = new Store();
            //     $advice->name_eng = $i;
            //     $advice->save();
            // }
            $advice = new StoreLocation();
            $advice->fill($request->all())->save();
            return back()->with('success','New Store Location Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = StoreLocation::findOrFail($id);
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
            'name_eng' => 'required',
        ]);
        if($validated->fails()){
            return back()->with('error','Something went wrong !!')->withInput();
        }else{
            $advice = StoreLocation::findOrFail($id);
            $data = $request->only(['name_eng',
                                    'status']
                                );
            $advice->fill($data)->save();
            return back()->with('success','Store Location '.$advice->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(StoreLocation::find($id)){
            $createObject = StoreLocation::find($id);
            $createObject->delete();
            return back()->with('success','Store Location Remove Successfully');
        }else{
            return back()->with('danger','Store Location Not Found');
        }
    }
}
