<?php 

namespace App\Services;
 
use App\Repositories\Contracts\ScrapeRepositoryContract;
use App\Repositories\Contracts\PinRepositoryContract;
use App\Repositories\Contracts\SelectorRepositoryContract;

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
    SelectorRepositoryContract $selectorRepository,
    MailServiceContract $mailService
  )
  {
    $this->scrape = $scrapeRepository;
    $this->pin = $pinRepository;
    $this->selector = $selectorRepository;
    $this->mailService = $mailService;

   }
 
  public function scrapePrice($url, Crawler $crawler = null)
  {
    if ($crawler == null)
    {
      $client = Client::getInstance();
      $client->isLazy();
      $client->getEngine()->setPath('bin/phantomjs');

      $request  = $client->getMessageFactory()->createRequest();
      $response = $client->getMessageFactory()->createResponse();
      
      $request->setMethod('GET');
      $request->setUrl($url);
      
      $client->send($request, $response);

      $page =  $response->getContent();

      $crawler = new Crawler($page);
    }
    else
    {
      $client = Client::getInstance();
      $client->getEngine()->setPath('../bin/phantomjs');
    }



    $xprice = '//*[(';

    foreach (config('app.attributes') as $attributes){
        foreach (config('app.price_best') as $selectors_ok){
                $xprice = $xprice.'contains(@'.$attributes.',"'.$selectors_ok.'") or ';
        }
    };

    $xprice = rtrim($xprice, 'or ');
    $xprice = $xprice.')]';

    if ($crawler->filterXPath($xprice)->count() > 0) {

      $price = $crawler->filterXPath($xprice)->first()->text();

    } else {

      $xprice = '//*[(';

      foreach (config('app.attributes') as $attributes){
          foreach (config('app.price_ok') as $selectors_ok){
                  $xprice = $xprice.'contains(@'.$attributes.',"'.$selectors_ok.'") or ';
          }
      };

      $xprice = rtrim($xprice, 'or ');
      $xprice = $xprice.') and (ancestor::*[';

      foreach (config('app.main_selectors') as $main){
        $xprice = $xprice.'contains(@id,"'.$main.'") or ';
      }

      $xprice = rtrim($xprice, 'or ');
      $xprice = $xprice. ']';

      $xprice = $xprice.') and not(ancestor-or-self::*[';

      foreach (['class','id'] as $attributes){
          foreach (config('app.price_nok') as $selectors_nok){
                  $xprice = $xprice.'contains(@'.$attributes.',"'.$selectors_nok.'") or ';
          }
      };

      $xprice = rtrim($xprice, 'or ');
      $xprice = $xprice. '])]';
      
      //dd($xprice);

      $price = $crawler->filterXPath($xprice)->last()->text();

    }

      $price = filter_var($price,FILTER_SANITIZE_NUMBER_INT);
      $price = rtrim($price, '-');

      return $price;


  }

  public function scrapePriceKnown($url, $price, Crawler $crawler = null){

    if ($crawler == null)
    {
      $client = Client::getInstance();
      $client->isLazy();
      $client->getEngine()->setPath('bin/phantomjs');

      $request  = $client->getMessageFactory()->createRequest();
      $response = $client->getMessageFactory()->createResponse();
      
      $request->setMethod('GET');
      $request->setUrl($url);
      
      $client->send($request, $response);

      $page =  $response->getContent();

      $crawler = new Crawler($page);
    }
    else
    {
      $client = Client::getInstance();
      $client->getEngine()->setPath('../bin/phantomjs');
    }


      $xprice = "//*[(number(text(".$price."))]";

      $price = $crawler->filterXPath($xprice)->first()->text();
      
      dd($xprice);
  }


  public function scrape($url, $price = null)
  {
    $store = parse_url($url)['host'];

    if ($this->selector->storeExists($store) || $price!=null)
    {
    $data['pins'] = [];

    $client = Client::getInstance();
    $client->isLazy();
    $client->getEngine()->setPath('../bin/phantomjs');

    $request  = $client->getMessageFactory()->createRequest();
    $response = $client->getMessageFactory()->createResponse();
    
    $request->setMethod('GET');
    $request->setUrl($url);
    $request->setTimeout(1000);

    $client->send($request, $response);

    $page =  $response->getContent();

    $crawler = new Crawler($page);

    $title = $crawler->filter('title')
                   ->reduce(function ($node, $i) {
                      return 0 == 0;                    
                    })
                   ->text();

    //$price = $this->scrapePrice($url, $crawler);
    $price = $this->scrapePriceKnown($url, $price, $crawler);

 
    $images = $crawler->filter('img')
                      ->filterXPath('//img[ancestor::*[contains(@id, "content") or contains(@id, "fiche") or contains(@id, "main")]]')
                      ->reduce(function ($node, $i) {


                        return strpos($node->attr('src'),'logo') == false && ($node->attr('height')>150 || $node->attr('height')==null) && $node->attr('src') && strpos($node->attr('src'),'blank')==false && strpos($node->attr('src'),'gif') == false;


                    })->each(function ($node, $i) {
                      return $node->attr('src');
                    });
    $pins = []; 

    $images = array_slice($images,0,5);

    foreach ($images as $i=>$image){

  
      $pin['price'] = $price;
      $pin['title'] = $title;
      $pin['store'] = $store;
      
      $pin['url'] = $url;
   
      $pin['image'] = $image;
      if (strpos($pin['image'],'http') === false){
        $pin['image'] = 'http://'.$pin['store'].'/'.$pin['image'];
      }

      // generate the hash for the post
      $hash = $this->pin->createHash();

      $pin['hash'] = $hash;

      array_push($pins, $pin);
    }

    $data['pins'] = $pins;

    return $data;

  } else {
    $data['status']=1;

    $data['url']=$url;
    return $data;
  } 
}
 
}