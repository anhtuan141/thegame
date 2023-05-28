<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_details';
    public $timestamps = false;
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    //----------Tạo thêm thành viên cho model (Thành viên không có trong database của model đang làm)----------//
    public function getProNameAttribute()
    {
        return $this->product->name ?? ' ';
    }

    public function getProPriceAttribute()
    {
        return $this->product->price ?? ' ';
    }

    public function getProImgAttribute()
    {
        return $this->product->image ?? ' ';
    }

    public function getOrdCodeAttribute()
    {
        return $this->order->code ?? ' ';
    }
    //----------SQL----------//
    public static function _list($id)
    {
        return self::where(['order_id' => $id])
            ->get();
    }
}