<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //----------SQL----------//
    public static function _item($id)
    {
        return self::where('id', $id)
            ->first();
    }

    public static function _itemsupp($id)
    {
        return self::where(['id' => $id, 'status' => 1])
            ->first();
    }

    public static function _list()
    {
        return self::where('status', '!=', -1)
            ->get();
    }

    public static function _checksupp($suppalias)
    {
        return self::where('alias', '=', trim($suppalias))->exists();
    }

    public static function _update(
        $supp_id,
        $suppname,
        $update_name,
        $supp_alias,
        $update_alias,
        $supp_image,
        $update_image,
        $supp_desc,
        $update_desc,
        $supp_title,
        $update_title,
        $supp_status,
        $update_status
    ) {
        return self::where(['id' => $supp_id])
            ->update([
                'name' => $update_name ? trim($update_name) : $suppname,
                'alias' => $update_alias ? trim($update_alias) : $supp_alias,
                'image' => $update_image ? trim($update_image) : $supp_image,
                'desc' => $update_desc ? $update_desc : $supp_desc,
                'title' => $update_title ? $update_title : $supp_title,
                'status' => $update_status ? trim($update_status) : $supp_status,
            ]);
    }

    public static function _delete($id)
    {
        return self::where('id', $id)
            ->where('status', '!=', -1)
            ->update(['status' => -1]);
    }
}
