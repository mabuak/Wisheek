<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\RatingRepositoryContract;

use App\Rating;

/**
* Our pokemon repository, containing commonly used queries
*/
class RatingRepository extends BaseRepository implements RatingRepositoryContract {

   // Our Eloquent pokemon model
   protected $model;

   /**
   * Setting our class $DogModel to the injected model
   * 
   * @param Model $dog
   */
   public function __construct(Rating $model) {
      $this->model = $model;
   }
 

  public function getStream()
  {
    return $this->model->orderBy('created_at','desc')->paginate();
  }
 
}