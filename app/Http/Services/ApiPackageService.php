<?php

namespace App\Http\Services;

use App\Models\ModelSets;
use App\Models\Package;

class ApiPackageService {

    public function getPackagesInfo()
    {
        return Package::getAllActivePackages();
    }

    public function getCoursesInfo($packageId)
    {
        return Package::getAllCoursesByPackageId($packageId);
    }

    public function getSubjectsByCourseIdInfo($courseId)
    {
        return ModelSets::getAllSubjectsByCourseId($courseId);
    }
}
