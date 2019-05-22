<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['user_id','total_price','status','shipping_address','kelurahan','kecamatan','kota','provinsi','phone_number','zip_code'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
