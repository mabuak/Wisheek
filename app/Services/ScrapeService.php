<?php 

namespace App\Services;
 
use App\Repositories\Contracts\ScrapeRepositoryContract;
use App\Repositories\Contracts\PinRepositoryContract;

use App\Services\Contracts\ScrapeServiceContract;

use App\Services\Contracts\MailServiceContract;

use Goutte;
use Image;
use Hash;

class ScrapeService implements ScrapeServiceContract{
 
  public function __construct(
    ScrapeRepositoryContract $scrapeRepository,
    PinRepositoryContract $pinRepository,
    MailServiceContract $mailService
  )
  {
    $this->scrape = $scrapeRepository;
    $this->pin = $pinRepository;
    $this->mailService = $mailService;

   }
 
  public function scrape($url)
  {
    $crawler = Goutte::request('GET', $url);  

    $price = $crawler->filter('#prix, #main .price')
                   ->reduce(function ($node, $i) {
                      return 0 == 0;                    
                    })
                   ->first()->text();
    $price = filter_var($price,FILTER_SANITIZE_NUMBER_INT);

    $title = $crawler->filter('title')
                   ->reduce(function ($node, $i) {
                      return 0 == 0;                    
                    })
                   ->text();

    $store = parse_url($url)['host'];

    $images = $crawler->filter('img')
                      ->filterXPath('//img[ancestor::*[contains(@id, "content") or contains(@id, "fiche")]]')
                      ->reduce(function ($node, $i) {


                      return strpos($node->attr('src'),'logo') == false && strpos($node->attr('src'),'http') !==false;


                    })->each(function ($node, $i) {
                      return $node->attr('src');
                    });

    $pins = []; 

    foreach ($images as $i=>$image){

      $imageI = Image::make($image);
      $height = $imageI->height();

      $pin['price'] = $price;
      $pin['title'] = $title;
      $pin['store'] = $store;
      $pin['url'] = $url;
      $pin['image'] = $image;

      // generate the hash for the post
      $hash = $this->pin->createHash();

      $pin['hash'] = $hash;

      if ($height > 100) array_push($pins, $pin);
    }

    $data['pins'] = $pins;
    return $data;
  }
 
}