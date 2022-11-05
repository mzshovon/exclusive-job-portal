<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public static function getAllFaqs()
    {
        return self::whereIsActive(1)->get(['id', 'title_bn as title', 'description_bn as description',
                                            'is_active as status']);
    }
}
