<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\SelectorRepositoryContract;

use App\Selector;

/**
* Our pokemon repository, containing commonly used queries
*/
class SelectorRepository extends BaseRepository implements SelectorRepositoryContract {

   // Our Eloquent pokemon model
   protected $model;

   /**
   * Setting our class $DogModel to the injected model
   * 
   * @param Model $dog
   */
   public function __construct(Selector $model) {
      $this->model = $model;
   }

<<<<<<< HEAD
  public function storeExists($store)
  {
    return $this->model->where('store',$store)->count();
=======
  public function urlExists($url)
  {
    return $this->model->where('url',$url)->count();
>>>>>>> origin/master
  }
  

}