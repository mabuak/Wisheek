<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\CommentRepositoryContract;

use App\Comment;
use App\Vote;

/**
* Our pokemon repository, containing commonly used queries
*/
class CommentRepository extends BaseRepository implements CommentRepositoryContract {

   // Our Eloquent pokemon model
   protected $model;

   /**
   * Setting our class $DogModel to the injected model
   * 
   * @param Model $dog
   */
   public function __construct(Comment $model, Vote $vote) {
      $this->model = $model;
      $this->vote = $vote;
   }

   public function getAllComments($type, $id)
   {
      return $this->model
                  ->where('commentable_type',ucfirst($type))
                  ->where('commentable_id', $id)
                  ->orderBy('created_at','asc')
                  ->get();
   }

   public function getLastComments($type, $id, $count)
   {
      return $this->model
                  ->where('commentable_type','App\\'.ucfirst($type))
                  ->where('commentable_id', $id)
                  ->orderBy('created_at','desc')
                  ->take($count)
                  ->get()
                  ->reverse(); 
   }


   public function isLiked($commentid, $userid)
   {
      return $this->vote->where('id', $commentid)->where('user_id',$userid)->first()->id;
   }
 
 
}