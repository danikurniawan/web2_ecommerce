<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FrontController extends Controller
{
    public function index()
    {
        $product = Product::limit(5)->orderByDesc('created_at')->get();

        return view('front.home', compact('product'));
    }
}
