<?php

namespace App\Helpers;

use Symfony\Component\Console\Helper\Helper;
use Illuminate\Support\Arr;

class CartHelper extends Helper {

    public static function addProduct($product, $quantity){
        $cart = self::getCart();

        if(Arr::has($cart, 'items.' . $product->id)){
            $quantity = Arr::get($cart, 'items.' . $product->id. '.quantity') + $quantity;

            return CartHelper::updateProduct($product->id, $quantity);
        } else {

            $cart = Arr::add($cart, 'items.' . $product->id, [
                "id" => $product->id,
                "product" => $product->name,
                "price" => $product->price,
                "totalPrice" => $product->price * $quantity,
                "quantity" => $quantity
            ]);

        }

        return self::storeCart($cart);
    }

    public static function updateProduct($id, $quantity){
        $cart = self::getCart();

        $quantity = $quantity;
        $price = Arr::get($cart, 'items.' . $id. '.price');

        Arr::set($cart, 'items.' . $id. '.totalPrice', $quantity * $price);
        Arr::set($cart, 'items.' . $id. '.quantity', $quantity);

        return self::storeCart($cart);
    }

    public static function removeProduct($id){
        $cart = self::getCart();

        Arr::forget($cart, 'items.' . $id);

        return self::storeCart($cart);
    }

    public static function destroy(){
        return self::storeCart([]);
    }

    public static function getTotalValue(){
        $value = 0;

        $cart = self::getCart();

        foreach($cart['items'] as $item){
            $value += $item['totalPrice'];
        }

        return $value;
    }

    public static function getCart(){
        $cart = session()->get('cart');

        if(isset($cart)){
            return $cart;
        }

        return [
            "items" => []
        ];
    }

    private static function storeCart($cart){
        return session()->put('cart', $cart);
    }

    public function getName(){
        return 'Cart';
    }

}