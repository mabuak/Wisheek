<?php

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
  	public function __construct(
      ScrapeServiceContract $scrapeService
    )
  	{
   	  $this->scrapeService = $scrapeService;
  	}	
 
    public function scrape(Request $request)
    {
      $data = $this->scrapeService->scrape($request->get('url'));
      if ($data['status']==1)
      {
        return view('pins/pinset',$data);
      } 
      else
      {
        return view('pins/frame',$data);
      }
    }

    public function run()
    {
      dispatch(new Scrape());    
    }

 
}