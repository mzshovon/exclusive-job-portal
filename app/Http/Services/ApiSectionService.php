<?php

namespace App\Http\Services;

use App\Models\Section;

class ApiSectionService {

    public function getSectionsInfo()
    {
        return Section::getAllSections();
    }
}
