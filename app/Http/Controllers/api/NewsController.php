<?php

namespace App\Http\Controllers\api;

use App\Models\AppSettings;
use App\Models\News;

class NewsController extends BaseAPIController
{
    public function get()
    {
        $news = News::with('category')->get();
        return $this->responseJSON($news);
    }
}
