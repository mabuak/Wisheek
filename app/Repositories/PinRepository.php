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

public function search($filters,$sortBy,$sortOrder,$paginate=1)
  { 

       return $this->model->where(function($query) use ($filters,$sortBy,$sortOrder){

        foreach ((array)$filters as $key=>$temp){
          if ($filters[$key])
          {
            if ($key=='nice')
            {   
              $query->whereColumn("want_price", ">=", "actual_price");
            }
            if ($key=='search')
            {
              $query->whereRaw("title like '%".$filters[$key]['item0']."%'");
            }

          }
        }
    })->orderBy($sortBy,$sortOrder)->paginate();

    
   }

}