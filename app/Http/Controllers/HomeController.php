<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public $retailers = [
        [
            'name' => 'abercrombie and fitch',
            'popularity' => 20,
            'country' => 'US'
        ],
        [
            'name' => 'about you',
            'popularity' => 60,
            'country' => 'DE'
        ],
        [
            'name' => 'amazon',
            'popularity' => 200,
            'country' => 'US'
        ],
        [
            'name' => 'asos',
            'popularity' => 100,
            'country' => 'US'
        ],
        [
            'name' => 'asos',
            'popularity' => 80,
            'country' => 'UK'
        ],
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        dd($this->autocomplete('as'));
        return view('home');


    }


    /* 1. Find the most popular retailer for every country *
    */
    public function mostPopularRetailer($country) {
        $retailers_in_country = array_filter($this->retailers, function($retailer) use ($country){
            return $retailer['country'] == $country;
        });
        $most_popular = $this->mostPopularInSet($retailers_in_country);
        return isset($most_popular['name']) ? $most_popular['name'] : null;
    }

    //Helper function
    public function mostPopularInSet($retailer_subset)
    {
        $most_popular = null;
        foreach ($retailer_subset as $retailer) {
            if (is_null($most_popular) || $retailer['popularity'] > $most_popular['popularity']) {
                $most_popular = $retailer;
            }
        }
        return $most_popular;
    }

    /* 2. Write an autocomplete function *
 *
 *    Returns the (string) name of the most popular retailer
 *    whose name starts with the autocomplete string.
  If the string matches exactly a retailer's name, return that name.
    */
    public function autocomplete($autocomplete_prefix) {
        $retailers_with_prefix = array_filter($this->retailers, function($retailer) use ($autocomplete_prefix) {
            return strpos($retailer['name'], $autocomplete_prefix) === 0;
        });
        $most_popular = $this->mostPopularInSet($retailers_with_prefix);
        return isset($most_popular['name']) ? $most_popular['name'] : null;
    }
}
