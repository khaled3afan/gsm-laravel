<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Service;
use App\ServiceCode;
use App\Bundle;
class ServiceCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = ServiceCode::all();
        return view('servicecodes.index', ['codes' => $codes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($service)
    {
        if (Service::find($service)) {
            $service = Service::find($service);
            $bundles = $service->bundles;
            return view('servicecodes.create', ['service' => $service, 'bundles' => $bundles]);
        }
        else {
            session()->flash('error', 'the page you tring to access is not exist');
            return redirect()->route('home');
        }
 
    }

    public function create_codes_by_bundle($bundle_id)
    {
        $bundle = Bundle::find($bundle_id);
        if($bundle) {
            return view('servicecodes.create')->with('bundle', $bundle);
        }
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $codes = explode(PHP_EOL, $request->codes);
        $service_id = $request->service_id;
        $bundle_id  = $request->bundle_id;
        foreach($codes as $code):
        ServiceCode::create([
            'code' => $code,
            'service_id' => $service_id,
            'bundle_id'  => $bundle_id
        ]);
        endforeach;
        return redirect()->route('servicecodes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
