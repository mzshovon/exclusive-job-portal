<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    public static function getAbouts($type = null)
    {
        $data = !$type ? collect(self::whereIsActive(1)->get()) : collect(self::whereIsActive(1)->whereType($type)->get());
        $abouts = $data->map(function($about) use ($type){
            return [
                'id' => $about->id,
                'title' => $about->title_bn,
                'description' => $about->description_bn,
                'status' => $about->is_active,
                'image' => $about->image_path,
                'position' => $about->image_position == 1 ? 'Top' :($about->image_position == 2 ? 'Middle' : 'Bottom'),
            ] + (!$type ? ['type' => $about->type == 1 ? 'About Us' :($about->type == 2 ? 'About Exams' : 'About Rules')] : []);
        });

        return $abouts;
    }
}
