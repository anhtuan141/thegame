<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    //----------Tạo thêm thành viên cho model (Thành viên không có trong database của model đang làm)----------//
    public function getCusNameAttribute()
    {
        return $this->customer->name ?? 'N/A';
    }

    public function getCusEmailAttribute()
    {
        return $this->customer->email ?? 'N/A';
    }

    //----------SQL----------//
    public static function _item($id)
    {
        return self::where(['id' => $id])
            ->first();
    }

    public static function _list()
    {
        return self::orderByDesc('id')
            ->get();
    }

    public static function _list_status($status)
    {
        return self::where(['order_status' => $status])
            ->orderByDesc('id')
            ->get();
    }

    public static function _list_order_status($id, $pagi)
    {
        return self::where(['customer_id' => $id])
            ->orderByDesc('id')
            ->paginate($pagi);
    }

    public static function _new_order($customer_id, $code, $order_status, $total, $sus_total, $address, $note)
    {
        return $order = self::create();
        $order->customer_id = $customer_id;
        $order->code = $code;
        $order->order_status = $order_status;
        $order->total = $total;
        $order->sustotal = $sus_total;
        $order->address_ship = $address;
        $order->note = $note;
        $order->save();
    }

    public static function _update($id, $status)
    {
        return self::where(['id' => $id])
            ->update([
                'order_status' => $status
            ]);
    }
}
