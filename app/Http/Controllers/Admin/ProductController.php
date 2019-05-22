<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Auth;
use Image;
use App\Models\ProductReview;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $orderBy = $req->get('orderBy');
        $product = Product::OrderProducts($orderBy)
                    ->where('products.user_id', Auth::user()->id)
                    ->with('images')->get();

        if($req->ajax())
            return $product;

        return view('admin.products.index', compact('product','orderBy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $product                = new Product;
        $product->name          = $request->name;
        $product->description   = $request->description;
        $product->price         = $request->price;
        $product->user_id       = Auth::user()->id;
        $product->save();

        $jml_gambar = count($request->img_src);

        if($jml_gambar > 0)
        {
            for($i=0; $i < $jml_gambar; $i++)
            {
                if($request->file('img_src')[$i])
                {
                    $file = $request->file('img_src')[$i];
                    $ext = $file->getClientOriginalExtension();

                    $dateTime = date('Ymdhis');
                    $newName = 'image_product'.$dateTime.'_'.$i.'.'.$ext;

                    $file->move(storage_path(env('PATH_PRODUCT_IMAGE')), $newName);
                    ProductImage::create(['id_product' => $product->id, 'src' => $newName]);
                }
            }
        }
        return redirect('admin/product')->with('success','Product berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with(['user','images'])->find($id);
        
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('admin.products.edit', compact('product'));
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
        $product = Product::find($id);
        if($product->name === $request->name)
        {
            $this->validate(request(), [
                'price' => 'required|numeric',
                'description' => 'required',
            ]);
        }

        else{

            $this->validate(request(), [
                'name' => 'required|unique:products,name',
                'price' => 'required|numeric',
                'description' => 'required',
            ]);
        }

        $product->name          = $request->name;
        $product->price         = $request->price;
        $product->description   = $request->description;
        $product->user_id       = Auth::user()->id;
        $product->save();

        $jml_gambar = count($request->img_src);

        if($jml_gambar > 0)
        {
            for($i=0; $i < $jml_gambar; $i++)
            {
                if($request->file('img_src')[$i])
                {
                    $file = $request->file('img_src')[$i];
                    $ext = $file->getClientOriginalExtension();

                    $dateTime = date('Ymdhis');
                    $newName = 'image_product'.$dateTime.'_'.$i.'.'.$ext;

                    $file->move(storage_path(env('PATH_PRODUCT_IMAGE')), $newName);
                    ProductImage::create(['id_product' => $id, 'src' => $newName]);
                }
            }
        }

        return redirect('admin/product')->with('success','Product berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect('admin/product')->with('success','Product berhasil dihapus');
    }

    public function viewImage($fileImage)
    {
        $path = storage_path(env('PATH_PRODUCT_IMAGE'). $fileImage);

        return Image::make($path)->response();
    }

    public function product_public(Request $req)
    {
        $orderBy = $req->get('orderBy');
        $product = Product::OrderProducts($orderBy)->with('images')->get();

        if($req->ajax())
            return $product;
        
        return view('front.shop', compact('product','orderBy'));
    }

    public function detail_product($id)
    {
        $product = Product::with(['user','images'])->find($id);
        $review = ProductReview::with(['user', 'product'])
                        ->where('product_id', $product->id)
                        ->get();

        $rating = ceil(ProductReview::where('product_id', $product->id)->avg('rating'));
        // dd($rating);
        return view('front.detail_product', compact('product', 'review', 'rating'));
    }

    public function simpan_review(Request $req)
    {
        try {
            
            $input = $req->all();
            $input['user_id'] = Auth::user()->id;
            ProductReview::create($input);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Review terkirim');
    }
}
