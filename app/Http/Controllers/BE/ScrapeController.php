<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;

use App\Services\Contracts\ScrapeServiceContract;

use Illuminate\Http\Request;

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

    public function checkSelector($store){

      $result = $this->BE->checkSelector($store);

      return $result;

    }
 
    public function scrape($url, $price)
    {

      $data = $this->scrapeService->scrape($url, $price);

      if ($data['status']==0)
      {
        return 0;
      } 
      elseif ($data['status']==1)
      {
        return 1;
      }
      
    }

    public function run()
    {
      dispatch(new Scrape());    
    }

 
}