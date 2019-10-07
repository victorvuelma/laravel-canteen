<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Helpers\CartHelper;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function add(Request $request){
        $validatedData = $request->validate([
            'product' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1'
        ]);

        $id = $validatedData['product'];
        $quantity = $validatedData['quantity'];

        $product = Product::find($id);

        if(!isset($product)){
            return redirect(route('cart.index'))->withErrors('Produto não encontrado.');
        }

        CartHelper::addProduct($product, $quantity);
        
        return redirect(route('cart.index'))->with('success', 'Produto adicionado ao carrinho.');
    }

    public function remove(Request $request){
        $validatedData = $request->validate([
            'product' => 'required|integer|min:1'
        ]);

        $id = $validatedData['product'];

        CartHelper::removeProduct($id);

        return redirect()->back()->with('success', 'Produto removido do carrinho.');
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'product' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1'
        ]);

        $id = $validatedData['product'];
        $quantity = $validatedData['quantity'];

        CartHelper::updateProduct($id, $quantity);

        return redirect()->back()->with('success', 'Produto atualizado no carrinho.');
    }

    public function clear(){
        CartHelper::destroy();

        return redirect()->back()->with('success', 'Carrinho limpo com sucesso!');
    }

    public function index(){
        $cart = CartHelper::getCart();

        $user = Auth::user();

        return view('cart', [
            'title' => 'Carrinho',
            'items' => $cart['items'],
            'totalValue' => CartHelper::getTotalValue(),
            'totalCredit' => $user->cash,
            'route_item_remove' => route('cart.remove'),
            'route_item_update' => route('cart.update'),
            'route_cart_order' => route('cart.order'),
            'route_products' => route('products'),
        ]);
    }


}
