<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\PinRepositoryContract;

use App\Pin;

/**
* Our pokemon repository, containing commonly used queries
*/
class PinRepository extends BaseRepository implements PinRepositoryContract {

   // Our Eloquent pokemon model
   protected $model;

   /**
   * Setting our class $DogModel to the injected model
   * 
   * @param Model $dog
   */
   public function __construct(Pin $model) {
      $this->model = $model;
   }

  public function getAllPins()
  {
    return $this->model->orderBy('created_at','desc')->paginate();
  }
  

  public function getStream($userid)
  {
    return $this->model->where('user_id', $userid)->orderBy('created_at','desc')->paginate();
  }
  

   public function checkPinEditable($pinid, $userid)
   {
    $pin = $this->model->find($pinid);
    return $userid = $pin->user->id;
   }

}