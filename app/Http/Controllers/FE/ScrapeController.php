<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\BE\ScrapeController as BE;
namespace App\Http\Controllers;

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

      $data = $this->BE->scrape($request->get('url'));
      if ($data['result']==1)
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