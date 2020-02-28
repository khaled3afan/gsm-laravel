<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\ServiceRequest;
use App\Service;
use App\Category;
use App\ServiceType;
use Illuminate\Support\Facades\Storage;
class ServicesController extends Controller
{

    // check if there's categories before Add A new Service

    public function __construct() {
        $this->middleware('checkCategory')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create',  ['categories' => Category::all(), 'servicetypes' => ServiceType::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        Service::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'servicetype_id' => $request->servicetype_id,
            'image' => $request->image->store('servicesimages', 'public'),
            'content' => $request->content,
            'price' => $request->price,
            'real_price' => $request->real_price
        ]);
        return redirect()->route('services.index');
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
        return view('services.create', ['service' => Service::find($id), 'categories' => Category::all(),'servicetypes' => ServiceType::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Service $service)
    {
        $data = $request->all();
        if(!$request->hasFile('image')){
            $data['image'] = $service->image;
        }
        else{
            $data['image'] = $request->image->store('servicesimages', 'public');
            Storage::disk('public')->delete($service->image);
        }
        $service->update($data);
        session()->flash('success', 'updated success');
        return redirect()->route('services.edit', $service->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $bundles= $service->bundles;
        DB::transaction(function () use($service, $bundles) {
            if($bundles->count()){
                foreach ($bundles as $bundle) {
                    if($bundle->bundle_codes->count()){
                        foreach ($bundle->bundle_codes as $code) {
                            $code->delete();
                        }
                    }
                    $bundle->delete();
                }
            }
            if ($service->service_codes->count()) {
                foreach($service->service_codes as $code) {
                    $code->delete();
                }
            }   
            $service->delete();
        });

        return redirect()->route('services.index');
    }

    public function serviceType($type) { //display services by type in services.index depending on services/type/{type} route
        $services = Service::whereHas('servicetype', function(Builder $query) use ($type) {
            $query->where('name', '=', $type);
        })->get();

        return view('services.index', ['services' => $services, 'type' => $type]);

    }
 
}
