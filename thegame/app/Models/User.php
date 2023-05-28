<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //----------Relationship----------//
    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function group()
    {
        return $this->belongsTo(UserGroup::class);
    }

    //----------Tạo thêm thành viên cho model (Thành viên không có trong database của model đang làm)----------//
    public function getGrNameAttribute()
    {
        return $this->group->name ?? ' ';
    }

    public function getGrIdAttribute()
    {
        return $this->group->id ?? ' ';
    }

    //----------SQL----------//
    public static function _item($id)
    {
        return self::where('id', $id)
            ->first();
    }

    public static function _itemuser($id)
    {
        return self::where(['id' => $id, 'status' => 1])
            ->first();
    }

    public static function _list()
    {
        return self::where('status', '!=', -1)
            ->get();
    }

    public static function _checkuser($username)
    {
        return self::where('username', '=', trim($username))->exists();
    }

    public static function _update(
        $user_id,
        $username,
        $update_name,
        $user_image,
        $update_image,
        $user_phone,
        $update_phone,
        $user_status,
        $update_status,
        $user_group,
        $update_group
    ) {
        return self::where(['id' => $user_id])
            ->update([
                'name' => $update_name ? trim($update_name) : $username,
                'image' => $update_image ? trim($update_image) : $user_image,
                'phone' => $update_phone ? trim($update_phone) : $user_phone,
                'status' => $update_status ? trim($update_status) : $user_status,
                'group_id' => $update_group ? trim($update_group) : $user_group
            ]);
    }

    public static function _delete($id)
    {
        return self::where('id', $id)
            ->where('status', '!=', -1)
            ->update(['status' => -1]);
    }
}
