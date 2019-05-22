<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::where('user_id', Auth::user()->id)->get();
        return view('admin.order.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = session()->get('cart');
        
        if($cart)
            return view('front.checkout', compact('cart'));
        else
            return redirect('carts')->with('success','Anda harus belanja terlebih dahulu');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = session()->get('cart');
        $total_price = 0;
        foreach($cart as $id => $product)
        {
            $total_price += $product['price'] * $product['quantity'];
        }
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['status'] = 'PENDING';
        $input['total_price'] = $total_price;

        $order = Order::create($input);

        foreach($cart as $id => $product)
        {
            $oi = new OrderITem;
            $oi->order_id = $order->id;
            $oi->product_id = $id;
            $oi->quantity = $product['quantity'];
            $oi->price = $product['price'];
            $oi->save();
        }

        session()->forget('cart');

        return redirect('carts')->with('success', 'Order berhasil dikirim');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        
        if($order)
            return view('admin.order.show', compact('order'));
        else
            return redirect()->back()->with('success', 'Order tidak ditemukan');
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
