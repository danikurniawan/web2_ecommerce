<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('front.cart');
    }

    public function add($id)
    {   
        $product = Product::with('images')->find($id);
        
        if(!$product)
        {
            abort(404);
        }

        $cart = session()->get('cart');

        if(!$cart)
        {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "image_url" => $product->images
                ]
            ];

            session()->put('cart', $cart);

            return redirect('carts')->with('success', 'Product added to cart successfully');
        }

        if(isset($cart[$id]))
        {
            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect('carts')->with('success', 'Product added to cart successfully');
        }

        $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image_url" => $product->images
            ];

        session()->put('cart', $cart);

        return redirect('carts')->with('success', 'Product added to cart successfully');
    }

    public function update(Request $req)
    {
        if($req->id and $req->quantity)
        {
            $cart = session()->get('cart');
            $cart[$req->id]["quantity"] = $req->quantity;

            session()->put('cart', $cart);
            session()->flash('success', 'Cart Updated');
        }
    }

    public function remove(Request $req)
    {
        if($req->id)
        {
            $cart = session()->get('cart');

            if(isset($cart[$req->id]))
            {
                unset($cart[$req->id]);
                session()->put('cart', $cart);
            }

            session()->flash('success', 'Cart Deleted');
        }
    }
    
}
