<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    //----------Tạo thêm thành viên cho model (Thành viên không có trong database của model đang làm)----------//
    public function getCatNameAttribute()
    {
        return $this->category->name ?? 'NA';
    }

    public function getCatIdAttribute()
    {
        return $this->category->id ?? 'NA';
    }

    public function getSupNameAttribute()
    {
        return $this->supplier->name ?? 'NA';
    }

    public function getSupIdAttribute()
    {
        return $this->supplier->id ?? 'NA';
    }

    //----------SQL----------//
    public static function _item($id)
    {
        return self::where('id', $id)
            ->first();
    }

    public static function _itemprod($id)
    {
        return self::where([
            'id' => $id,
            'status' => 1
        ])
            ->first();
    }

    public static function _list()
    {
        return self::where('status', '!=', -1)
            ->get();
    }

    public static function _hot()
    {
        return self::whereIn('id', [11, 8, 24, 12, 16, 29])
            ->get();
    }

    public static function _game()
    {
        return self::whereIn('id', [2, 3, 6, 8, 9, 11, 13, 15, 16, 17, 18, 22, 23, 36, 38, 39])
            ->where(['kind' => 'game', 'status' => 1])
            ->get();
    }

    public static function _console()
    {
        return self::where(['kind' => 'console', 'status' => 1])
            ->whereIn('id', [25, 28, 29, 32])
            ->get();
    }
    public static function _coming($pagi)
    {
        return self::where('launch_date', 'coming')
            ->paginate($pagi);
    }

    public static function _rate($pagi)
    {
        return self::where('rate', '=', 5)
            ->where(['status' => 1, 'launch_date' => 'released', 'kind' => 'game'])
            ->orderBy('id', 'desc')
            ->paginate($pagi);
    }

    public static function _sale($pagi)
    {
        return self::where('status', 1)
            ->where('price', '<', 40)
            ->paginate($pagi);
    }

    public static function _preorder()
    {
        return self::where(['status' => 1, 'launch_date' => 'coming'])
            ->whereIn('id', [11, 16])
            ->get();
    }

    public static function _shop($pagi)
    {
        return self::where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate($pagi);
    }

    public static function _detail($a)
    {
        return self::where(['status' => 1, 'alias' => $a])
            ->first();
    }

    public static function _cate_prod($id)
    {
        return self::where(['status' => 1, 'category_id' => $id])
            ->get();
    }

    public static function _search($key, $kind, $pagi)
    {
        return self::where(['status' => 1, 'kind' => $kind])
            ->where(function ($r) use ($key) {
                $r->where('name', 'like', $key)
                    ->orWhere('summary', 'like', $key)
                    ->orWhere('desc', 'like', $key)
                    ->orWhere('title', 'like', $key);
            })
            ->paginate($pagi);
    }

    public static function _checkprod($prodalias)
    {
        return self::where('alias', '=', trim($prodalias))->exists();
    }

    public static function _updateQty($id, $qty, $buyqty)
    {
        return self::where(['id' => $id])
            ->update(['qty' => ($qty - $buyqty)]);
    }

    public static function _update(
        $id,
        $name,
        $update_name,
        $alias,
        $update_alias,
        $image,
        $update_image,
        $supplier,
        $update_supplier,
        $category,
        $update_category,
        $platforms,
        $update_platforms,
        $kind,
        $update_kind,
        $price,
        $update_price,
        $qty,
        $update_qty,
        $desc,
        $update_desc,
        $status,
        $update_status
    ) {
        return self::where(['id' => $id])
            ->update([
                'name' => $update_name ? trim($update_name) : $name,
                'alias' => $update_alias ? trim($update_alias) : $alias,
                'image' => $update_image ? trim($update_image) : $image,
                'supplier_id' => $update_supplier ? trim($update_supplier) : $supplier,
                'category_id' => $update_category ? trim($update_category) : $category,
                'platforms' => $update_platforms ? trim($update_platforms) : $platforms,
                'kind' => $update_kind ? trim($update_kind) : $kind,
                'price' => $update_price ? trim($update_price) : $price,
                'qty' => $update_qty ? trim($update_qty) : $qty,
                'desc' => $update_desc ? trim($update_desc) : $desc,
                'status' => $update_status ? trim($update_status) : $status
            ]);
    }

    public static function _delete($id)
    {
        return self::where('id', $id)
            ->where('status', '!=', -1)
            ->update(['status' => -1]);
    }
}
