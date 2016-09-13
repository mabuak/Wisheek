<?php 

namespace App\Repositories;

use App\Repositories\AssetRepository;
use App\Repositories\Contracts\DogRepositoryContract;

use App\Dog;

/**
* Our pokemon repository, containing commonly used queries
*/
class DogRepository extends AssetRepository implements DogRepositoryContract {

   // Our Eloquent pokemon model
   protected $model;

   /**
   * Setting our class $DogModel to the injected model
   * 
   * @param Model $dog
   */
   public function __construct(Dog $model) {
      $this->model = $model;

   }
 
   public function segment()
   {
      return 'dog';
   }

   public function getParentSiblings($dogid)
   { 
      $dog = $this->model->find($dogid);
      $siblings = $this->model
                       ->where('father_id', $dog->father_id)
                       ->where('mother_id', $dog->mother_id)
                       ->whereNotNull('father_id')
                       ->whereNotNull('mother_id')
                       ->where('father_id','!=', 0)
                       ->where('mother_id','!=', 0)
                       ->where('id','!=',$dogid)
                       ->get();
      return $siblings;
   }

   public function getLitterSiblings($dogid)
   { 
      $dog = $this->model->find($dogid);
      return  $this->model
                   ->where('litter_id', $dog->litter_id)
                   ->whereNotNull('litter_id')
                   ->where('id','!=', $dogid)
                   ->get();
   }
 
  public function checkDuplicateDog($dogName, $dogBreedId, $kennelName)
  {
    $dog = $this->model
                  ->where('breed_id', $dogBreedId)
                  ->where('kennel_name', $kennelName)
                  ->where('name', $dogName)
                  ->first();
    if ($dog) {return $dog->id;}
    return false;
  }

  public function checkIfDogHasOwner($id)
  {
    $dog = $this->model->find($id);
    $owners = $dog->owners->count();
    return $owners;
  }

  public function getNewestDogsByBreed($breed, $limit)
  {
    return $this->model 
                ->where('breed_id',$breed)
                ->take($limit)
                ->orderBy('created_at','desc')
                ->get();
  }
 
}