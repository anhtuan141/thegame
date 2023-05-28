<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory;

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    //----------SQL----------//
    public static function _list()
    {
        return self::where('status', '!=', -1)
            ->get();
    }

    public static function _item($id)
    {
        return self::where('id', $id)
            ->first();
    }


    public static function _customer_order($id)
    {
        return OrderItem::join('products', 'order_details.product_id', '=', 'products.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select(
                'orders.code as order_code',
                'orders.created_at as order_date',
                'orders.address_ship as order_address',
                'customers.name as customer_name',
                'products.name as prod_name',
                'order_details.qty as qty',
                'products.price as prod_price',
                'orders.order_status as order_status'
            )
            ->where('customers.id', $id)
            ->get();
    }

    public static function _checkcustomer($email)
    {
        return self::where('email', '=', trim($email))->exists();
    }

    public static function _customer($email)
    {
        return self::where('email', '=', trim($email))
            ->first();
    }

    public static function _update($id, $cus_name, $update_name, $cus_address, $update_address, $cus_phone, $update_phone, $cus_status, $update_status)
    {
        return self::where(['id' => $id])
            ->update([
                'name' => $update_name ? trim($update_name) : $cus_name,
                'address' => $update_address ? trim($update_address) : $cus_address,
                'phone' => $update_phone ? trim($update_phone) : $cus_phone,
                'status' => $update_status ? trim($update_status) : $cus_status
            ]);
    }
}
