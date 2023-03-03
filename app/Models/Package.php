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

    /**
     * @return array
     */
    public static function getAllActivePackages()
    {
        return self::whereStatus(1)->get(['id', 'title', 'icon', 'color as color_code',
                                            'description', 'about', 'new_price', 'old_price', 'reference_link as reference',
                                            'status', 'duration']);
    }

    /**
     * @param int|string $packageId
     *
     * @return array
     */
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

    /**
     * @param int|string $packageId
     *
     * @return array
     */
    public static function getAllSectionsByPackageId($packageId)
    {
        $section_array = [];
        $sections = self::with('sections')->find($packageId);

        if($sections) {
            foreach($sections->sections as $section) {
                $section_array[] = [
                        "title" => $section->title,
                        "icon" => $section->icon,
                        "color_code" => $section->color,
                        "position" => $section->position,
                        "description" => $section->description,
                        "status" => $section->status
                    ];
            }
        }

        return $section_array;
    }
}
