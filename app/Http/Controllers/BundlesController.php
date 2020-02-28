<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Bundle;
use App\Service;

class BundlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bundles = Bundle::all();
        // foreach($bundles as $bundle){
        //     dd($bundle->service);
        // }
        return view('bundles.index',['bundles' => Bundle::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $service = Service::find($id);
        $bundletypes = \App\ServiceType::all();
        return view('bundles.create', ['service' => $service, 'bundletypes' => $bundletypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Bundle::create($request->all());
        return redirect()->route('bundles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bundle = Bundle::find($id);

        return view('bundles.show', ['bundle' => $bundle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bundle = Bundle::find($id);
        DB::transaction(function () use ($bundle) {
                if($bundle->bundle_codes->count()){
                    foreach ($bundle->bundle_codes as $code) {
                        $code->delete();
                    }
                }
                $bundle->delete();   
        });
        return redirect()->route('bundles.index');
    }
}
