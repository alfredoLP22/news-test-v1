<?php

namespace App\Http\Controllers;

use jcobhams\NewsApi\NewsApi;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function News(Request $request) {

        $api_key = env('NEWS_API_KEY','null');

        $newsapi = new NewsApi($api_key);

        $search = $request->input('search') ?? 'a';

        $page_size = 10;
        $page = 1;

        $news  = $newsapi->getEverything(
        $search,
        null, 
        null, 
        null,
        null, 
        null, 
        $language = 'es', 
        null,  
        $page_size, 
        $page);

        return view('news.news');
    }
}
