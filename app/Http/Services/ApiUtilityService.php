<?php

namespace App\Http\Services;

use App\Models\About;
use App\Models\Faq;
use App\Models\Video;

class ApiUtilityService {

    public function getFaqsInfo()
    {
        return Faq::getAllFaqs();
    }

    public function getAboutsInfo($aboutType = null)
    {
        return About::getAbouts($aboutType);
    }

    public function getVideosInfo()
    {
        return Video::getAllVideos();
    }
}
