<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\BE\ScrapeController as BE;
use App\Http\Controllers\Controller;
use App\Services\Contracts\ScrapeServiceContract;
use Illuminate\Http\Request;
use JonnyW\PhantomJs\Client;

class ScrapeController extends Controller {
	
	/**
   * Dependecny Injection
   *
   * @return void
   */
  	public function __construct(BE $BE)
  	{
   	  $this->BE = $BE;
    }

    public function checkSelector(Request $request){

      $store = $request->get('store');
      $result = $this->BE->checkSelector($store);

      return $result;

    }

   public function scrape(Request $request){
      $url = $request->get('url');
      $price = $request->get('price');

      $result = $this->BE->scrape($url, $price);
      $data = [];

      if ($result==0)
      {
        return view('pins/pinset',$data);
      } 
      else
      {
        return view('pins/selector');
      }
    }

    public function run()
    {
      dispatch(new Scrape());    
    }

 
}