<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'detail' => $product,
                'inventory' => $product->getInventory() ?? '{}'
        ]);
    }

    public function inventoryPost(ProductRequest $request) {
        Inventory::changeInventory($request->type, $request->id, $request->quantity, 'available_inventory');
        return responseJson(200, '操作成功');
    }
}
