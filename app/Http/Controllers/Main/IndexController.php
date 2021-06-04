<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\ProductCategory;

use App\Models\Product;
use App\Models\Coupon;


class IndexController extends Controller
{
    public function index(){
        return redirect('/main');
    }

    public function launcher(){
        $catOfProducts = ProductCategory::with('products')->get();

        return Inertia::render('main/index', [
            'catOfProducts' => $catOfProducts
        ]);
    }

    public function showCart(){
        return Inertia::render('main/cart/index');
    }

    public function getCarts(Request $request)
    {
       $total_price = 0;
       $products = Product::find($request->ids);
        foreach ($products as $product){
            $total_price += $product->price;
        }
        return response(['products' => $products, 'total_price' => round($total_price)]);
    }

    public function couponValue(Request $request){
       $discount = Coupon::where('code', $request->code)->first(['discount'])->discount;
       return $discount;
    }

}
