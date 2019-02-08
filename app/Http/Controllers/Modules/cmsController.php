<?php

namespace App\Http\Controllers\modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdminCMS;
use STR_ENC;

class cmsController extends Controller
{

    public function viewNews($news_id){
        $news = AdminCMS::where('id', STR_ENC::exec('decrypt', $news_id))->get();
        $cms = AdminCMS::get(['id', 'post_title', 'created_at']);

        return view('cms.view_news', compact('news', 'cms'));
    }

}
