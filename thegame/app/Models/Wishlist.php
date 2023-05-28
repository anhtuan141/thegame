<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
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

    public function getProAliasAttribute()
    {
        return $this->product->alias ?? ' ';
    }

    //----------SQL----------//
    public static function _list($id)
    {
        return self::where(['status' => 1, 'customer_id' => $id])
            ->get();
    }

    public static function _create($id, $cus_id)
    {
        return self::updateOrInsert(
            ['product_id' => $id, 'customer_id' => $cus_id],
            ['status' => '1']
        );
    }

    public static function _delete($id)
    {
        return self::where('product_id', $id)
            ->update(['status' => -2]);
    }
}