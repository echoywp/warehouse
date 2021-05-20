<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $list = Product::whereStatus(1)->get();
        return view('home.index')->with([
            'list' => $list
        ]);
    }

    public function show(Product $product) {
        return view('home.show')->with([
            'product' => $product
        ]);
    }
}
