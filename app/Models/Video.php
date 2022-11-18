<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasUser;

    public static function getAllVideos()
    {
        return self::whereStatus(1)->get(['id', 'title', 'description', 'link as video_link', 'status']);
    }
}
