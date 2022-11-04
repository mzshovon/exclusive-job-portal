<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Section extends Model
{
    use HasUser;

    public static function getAllSections()
    {
        return self::whereStatus(1)->get(['id', 'title', 'icon', 'color as color_code', 'description', 'section_position as position']);
    }
}
