<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\UserRepositoryContract;

use App\User;

/**
* Our pokemon repository, containing commonly used queries
*/
class UserRepository extends BaseRepository implements UserRepositoryContract {

   // Our Eloquent pokemon model
   protected $model;

   /**
   * Setting our class $DogModel to the injected model
   * 
   * @param Model $dog
   */
   public function __construct(User $model) {
      $this->model = $model;
   }


  public function getFollowingsIds($userid)
  {
    $user = $this->model->find($userid);
    return $user->userFollowings()->where('followable_type','User')->lists('followable_id');
  }

  public function simpleSearch($query)
  {
    return $this->model->where('first_name','like','%'.$query.'%')
                        ->orWhere('last_name','like','%'.$query.'%')
                        ->get();
  }

  
}