<?php

<<<<<<< HEAD
namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;

use App\Http\Controllers\BE\ScrapeController as BE;
=======
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\Contracts\ScrapeServiceContract;
>>>>>>> origin/master

use Illuminate\Http\Request;
use JonnyW\PhantomJs\Client;

class ScrapeController extends Controller {
	
	/**
   * Dependecny Injection
   *
   * @return void
   */
<<<<<<< HEAD
  	public function __construct(BE $BE)
  	{
   	  $this->BE = $BE;
=======
  	public function __construct(
      ScrapeServiceContract $scrapeService
    )
  	{
   	  $this->scrapeService = $scrapeService;
>>>>>>> origin/master
  	}	
 
    public function scrape(Request $request)
    {
<<<<<<< HEAD
      $data = $this->BE->scrape($request->get('url'));
      if ($data['result']==1)
=======
      $data = $this->scrapeService->scrape($request->get('url'));
      if ($data['status']==1)
>>>>>>> origin/master
      {
        return view('pins/pinset',$data);
      } 
      else
      {
<<<<<<< HEAD
        return view('pins/selector');
=======
        return view('pins/frame',$data);
>>>>>>> origin/master
      }
    }

    public function run()
    {
      dispatch(new Scrape());    
    }

 
}