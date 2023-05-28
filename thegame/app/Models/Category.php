<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //----------Recursion Category----------//
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    //----------SQL----------//
    public static function _item($id)
    {
        return self::where('id', $id)
            ->first();
    }

    public static function _list()
    {
        return self::where('status', '!=', -1)
            ->get();
    }

    public static function _checkcate($catealias)
    {
        return self::where('alias', '=', trim($catealias))->exists();
    }

    public static function _update(
        $id,
        $name,
        $update_name,
        $alias,
        $update_alias,
        $parent_id,
        $update_parent_id,
        $status,
        $update_status
    ) {
        return self::where(['id' => $id])
            ->update([
                'name' => $update_name ? trim($update_name) : $name,
                'alias' => $update_alias ? trim($update_alias) : $alias,
                'parent_id' => $update_parent_id ? trim($update_parent_id) : $parent_id,
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
