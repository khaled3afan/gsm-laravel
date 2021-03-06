<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Service;

class IndexController extends Controller
{
    public function index() {
        $categories = Category::all();
        $carousel= DB::table('services')->take(5)->inRandomOrder()->get();
        return view('index.index', ['categories' => $categories, 'carousel' => $carousel]);
    }


    public function show_service($service_id) {
        $service = Service::find($service_id);
        return view('index.service', ['service' => $service]);
    }

    public function show_category($category_id) {
        $category = Category::find($category_id);
        $services = Service::where('category_id', $category_id)->get();
        return view('index.category', ['category' => $category, 'services' => $services]);
    }
}
