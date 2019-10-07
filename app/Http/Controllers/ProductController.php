<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $products = Product::get();

        return view('products', [
            'title' => 'Produtos',
            'products' => $products,
            'route_cart_add' => route('cart.add')
        ]);
    }
}
