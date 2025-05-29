<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Backend\MedecineCategory;

class MedicineCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['stores'] = MedecineCategory::all();
        return view('backend.medicinecategory.index',$data);
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
            //     $item = new Store();
            //     $item->name_eng = $i;
            //     $item->save();
            // }
            $item = new MedecineCategory();
            $item->fill($request->all())->save();
            return back()->with('success','New Medicine Type Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lastid = MedecineCategory::findOrFail($id);
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
            $item = MedecineCategory::findOrFail($id);
            $data = $request->only(['name_eng',
                                    'status']
                                );
            $item->fill($data)->save();
            return back()->with('success','Medicine Type '.$item->name_eng.' Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(MedecineCategory::find($id)){
            $createObject = MedecineCategory::find($id);
            $createObject->delete();
            return back()->with('success','Medicine Type Remove Successfully');
        }else{
            return back()->with('danger','Medicine Type Not Found');
        }
    }
}
