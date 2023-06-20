<?php

namespace App\Http\Controllers;

use App\Models\News;
use jcobhams\NewsApi\NewsApi;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsController extends Controller
{
    public function News(Request $request) {

        $api_key = env('NEWS_API_KEY','null');

        $newsapi = new NewsApi($api_key);

        $page_size  = 6;
        $page       = $request->input('page') ?? 1;

        $search = $request->input('search') ?? 'a';

        $news  = $newsapi->getEverything(
        $search,
        null,
        null,
        null,
        null,
        null,
        $language = 'es',
        'publishedAt',
        $page_size,
        $page);

        $arrayNews = new LengthAwarePaginator(
            $news,
            $news->totalResults,
            $page_size,
            $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('news.news',[
            'arrayNews'          => $arrayNews,
            'search'             => $request->input('search') ?? ''
        ]);
    }


    public function TopHeadlines(Request $request){

        $this->setTopHeadlines();

        $news = News::orderBy('id','desc')->paginate(10);

        // dd($news->items()[2]->getAttributes());
        return view('news.top_news',[
            'arrayNews'          => $news,
            'search'             => $request->input('search') ?? ''
        ]);
    }


    public function setTopHeadlines(){


        $api_key = env('NEWS_API_KEY','null');

        $newsapi = new NewsApi($api_key);
        $page_size  = 30;
        $page       = 1;

        $top_headlines = $newsapi->getTopHeadlines(null, null, $country = 'mx' , null, $page_size, $page);

        foreach($top_headlines->articles as $top){

            $new = News::updateOrCreate([
                "title" => $top->title
            ],[
                'source_id'         => $top->source->id,
                'source_name'       => $top->source->name,
                'author'            => $top->author,
                'description'       => $top->description,
                'url'               => $top->url,
                'url_to_image'      => $top->urlToImage,
                'published_at'      => $top->publishedAt,
                'content'           => $top->content,
            ]
            );

        }

    }
}
