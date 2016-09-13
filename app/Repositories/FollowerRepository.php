<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\FollowerRepositoryContract;

use App\Follower;

/**
* Our pokemon repository, containing commonly used queries
*/
class FollowerRepository extends BaseRepository implements FollowerRepositoryContract {

   // Our Eloquent pokemon model
   protected $model;

   /**
   * Setting our class $DogModel to the injected model
   * 
   * @param Model $dog
   */
   public function __construct(Follower $model) {
      $this->model = $model;
   }
 

  public function checkUserFollowed($loggedid, $userid)
  {
    return  $this->model
                 ->where('follower_id', $loggedid)
                 ->where('followable_type','User')
                 ->where('followable_id',$userid)
                 ->count();
  }
 
   public function getFollow($type, $id, $userid)
   {
      return $this->model
                  ->where('follower_id', $userid)
                  ->where('followable_type', $type)
                  ->where('followable_id',$id)
                  ->first();
   }
}