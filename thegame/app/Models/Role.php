<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function _function()
    {
        return $this->hasOne(Func::class, 'id', 'func_id');
    }

    public function _checked($func_id, $user_id)
    {
        return $this->where(['func_id' => $func_id, 'user_id' => $user_id])
            ->first();
    }

    //----------SQL----------//

    public static function _checkrole($user_id, $route_name)
    {
        $allow = Func::select('id')
            ->where([
                'status' => 1,
                'allow' => 1,
                'route_name' => $route_name
            ])
            ->first();
        if ($allow)
            return true;
        return self::select('func_id')
            ->where('user_id', $user_id)
            ->whereHas('_function', function ($q) use ($route_name) {
                $q->where('status', 1)
                    ->where('route_name', $route_name);
            })->first();
    }

    public static function _recallPermission($user_id)
    {
        return self::where(['user_id' => $user_id])
            ->delete();
    }

    public static function _grandPermission($user_id, $func)
    {
        return self::insert(['user_id' => $user_id, 'func_id' => $func]);
    }
}
