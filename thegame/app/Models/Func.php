<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Func extends Model
{
    protected $table = 'functions';
    use HasFactory;

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public static function _listfunction($parent_id = 0)
    {
        return self::where(['status' => 1, 'parent_id' => $parent_id, 'allow' => 0])
            ->orderBy('pos', 'asc')
            ->get();
    }

    public static function _listmenuforuser($user_id, $parent_id = 0)
    {
        return self::where([
            'parent_id' => $parent_id,
            'status' => 1,
            'showmenu' => 1
        ])
            ->whereHas('roles', function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            })
            ->orderBy('pos', 'asc')
            ->get();
    }
}
