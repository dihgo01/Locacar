<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Goutte\Client;


class ScraperController extends Controller
{
    private $results = array();
    private $image = array();

    public function scraper()
    {
       $client = new Client();
        $url = 'https://www.icarros.com.br/ford';
        $page = $client->request('GET', $url);

        //$page->filter('.titulo_anuncio')->each(function($item){
        //    $this->result = $item->filter('span')->text();
        //});

        $page->filter('.card--review')->each(function ($node) {
            $this->result = $node->filter('title--brand')->text();
            $node->filter('.img-responsive')->each(function ($node)  {

                $link = $node->filter('img')->attr('src');
                dd($link);
            });
        });

        $data = $this->results;
        

        return view('scraper', compact('data'));
    }
}