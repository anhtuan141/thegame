<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function article_group()
    {
        return $this->belongsTo(ArticleGroup::class);
    }

    //----------Tạo thêm thành viên cho model (Thành viên không có trong database của model đang làm)----------//
    public function getArtGrNameAttribute()
    {
        return $this->article_group->name ?? 'NA';
    }

    public function getGrIdAttribute()
    {
        return $this->article_group->id ?? 'NA';
    }

    //----------SQL----------//
    public static function _backend_list()
    {
        return self::where('status', '!=', -1)
            ->get();
    }

    public static function _list($pagi)
    {
        return self::where('status', 1)
            ->paginate($pagi);
    }

    public static function _item($id)
    {
        return self::where(['id' => $id])
            ->first();
    }

    public static function _recent_new()
    {
        return self::where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(3);
    }

    public static function _search($key, $pagi)
    {
        return self::where('status', 1)
            ->where(function ($r) use ($key) {
                $r->where('name', 'like', $key)
                    ->orWhere('summary', 'like', $key)
                    ->orWhere('desc', 'like', $key)
                    ->orWhere('content', 'like', $key);
            })
            ->paginate($pagi);
    }

    public static function _check_article($artdalias)
    {
        return self::where('alias', '=', trim($artdalias))->exists();
    }

    public static function _update(
        $id,
        $name,
        $update_name,
        $alias,
        $update_alias,
        $image,
        $update_image,
        $category,
        $update_category,
        $summary,
        $update_summary,
        $content,
        $update_content,
        $status,
        $update_status
    ) {
        return self::where(['id' => $id])
            ->update([
                'name' => $update_name ? trim($update_name) : $name,
                'alias' => $update_alias ? trim($update_alias) : $alias,
                'image' => $update_image ? trim($update_image) : $image,
                'article_group_id' => $update_category ? trim($update_category) : $category,
                'summary' => $update_summary ? trim($update_summary) : $summary,
                'content' => $update_content ? trim($update_content) : $content,
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
