<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasUser;

    public function model_sets() {
        return $this->belongsToMany('App\Models\ModelSets');
    }

    public function sections() {
        return $this->belongsToMany('App\Models\Section');
    }

    public static function getAllActivePackages()
    {
        return self::whereStatus(1)->get(['id', 'title', 'icon', 'color as color_code',
                                            'description', 'about', 'new_price', 'old_price', 'reference_link as reference',
                                            'status', 'duration']);
    }

    public static function getAllCoursesByPackageId($packageId)
    {
        $course_array = [];
        $courses = self::with('model_sets')->find($packageId);

        if($courses) {
            foreach($courses->model_sets as $course) {
                $course_array[] = [
                        "title" => $course->title,
                        "icon" => $course->icon,
                        "color_code" => $course->color,
                        "description" => $course->description,
                        "status" => $course->status
                    ];
            }
        }

        return $course_array;
    }
}
