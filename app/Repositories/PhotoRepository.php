<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\PhotoRepositoryContract;

use App\Photo;

/**
* Our pokemon repository, containing commonly used queries
*/
class PhotoRepository extends BaseRepository implements PhotoRepositoryContract {

   // Our Eloquent pokemon model
   protected $model;

   /**
   * Setting our class $DogModel to the injected model
   * 
   * @param Model $dog
   */
   public function __construct(Photo $model) {
      $this->model = $model;
   }

 
}