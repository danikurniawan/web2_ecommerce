<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['user_id','name','description','price','image_url','video_url'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'id_product');
    }

    public function productReview()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    public function scopeOrderProducts($query, $orderBy)
    {
        if($orderBy == 'best_seller'){

            $query->select('products.id','products.name','products.price',DB::Raw('SUM(oi.quantity) as qty'))
                    ->rightJoin('order_items as oi','products.id','=','oi.product_id')
                    ->groupBy('oi.quantity','products.id','products.name','products.price')
                    ->orderBy('qty', 'DESC');
        } elseif($orderBy == 'rating_terbaik') {

            $query->select('products.id','products.name','products.price',DB::Raw('SUM(oi.rating) as rating'))
                    ->rightJoin('product_reviews as oi','products.id','=','oi.product_id')
                    ->groupBy('oi.rating','products.id','products.name','products.price')
                    ->orderBy('rating', 'DESC');

        }elseif($orderBy == 'termurah') {

            $query->orderBy('price', 'ASC');

        }elseif($orderBy == 'termahal') {

            $query->orderBy('price', 'DESC');

        }else {
            $query->orderBy('created_at', 'DESC');
        }

        return $query;
    }
}
