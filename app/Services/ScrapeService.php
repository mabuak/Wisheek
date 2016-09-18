<?php 

namespace App\Services;
 
use App\Repositories\Contracts\ScrapeRepositoryContract;
use App\Repositories\Contracts\PinRepositoryContract;

use App\Services\Contracts\ScrapeServiceContract;

use App\Services\Contracts\MailServiceContract;
  
use JonnyW\PhantomJs\Client;

use Symfony\Component\DomCrawler\Crawler;

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
    $data['pins'] = [];

    $client = Client::getInstance();
   //$client->isLazy();
    $client->getEngine()->setPath('../bin/phantomjs');

    $request  = $client->getMessageFactory()->createRequest();
    $response = $client->getMessageFactory()->createResponse();
    
    $request->setMethod('GET');
    $request->setUrl($url);
    
    $client->send($request, $response);

    $page =  $response->getContent();

    $crawler = new Crawler($page);

    $price = $crawler->filterXPath('//*[ancestor::*[contains(@id, "content") or contains(@id, "fiche") or contains(@id, "main")]]')
                   ->reduce(function ($node, $i) {
                       return strpos($node->attr('id'),'price') || strpos($node->attr('class'),'price');    ;           
                    })
                   ->first()->text();
    $price = filter_var($price,FILTER_SANITIZE_NUMBER_INT);
    $price = rtrim($price, '-');

    $title = $crawler->filter('title')
                   ->reduce(function ($node, $i) {
                      return 0 == 0;                    
                    })
                   ->text();

    $store = parse_url($url)['host'];

    $images = $crawler->filter('img')
                      ->filterXPath('//img[ancestor::*[contains(@id, "content") or contains(@id, "fiche") or contains(@id, "main")]]')
                      ->reduce(function ($node, $i) {


                        return strpos($node->attr('src'),'logo') == false && ($node->attr('height')>150 || $node->attr('height')==null) && $node->attr('src') && strpos($node->attr('src'),'blank')===false;


                    })->each(function ($node, $i) {
                      return $node->attr('src');
                    });

    $pins = []; 

    foreach ($images as $i=>$image){

  
      $pin['price'] = $price;
      $pin['title'] = $title;
      $pin['store'] = $store;
      
      $pin['url'] = $url;
   
      $pin['image'] = $image;
      if (strpos($pin['image'],'http') === false){
        $pin['image'] = 'http//'.$pin['store'].$pin['image'];
      }

      // generate the hash for the post
      $hash = $this->pin->createHash();

      $pin['hash'] = $hash;

      array_push($pins, $pin);
    }

    $data['pins'] = $pins;
    return $data;
    return $page;

  }
 
}