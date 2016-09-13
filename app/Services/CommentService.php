<?php 

namespace App\Services;

use App\Repositories\Contracts\CommentRepositoryContract;
use App\Services\Contracts\CommentServiceContract;

use Hash;
use Session;
use Auth;

class CommentService implements CommentServiceContract {

  protected $commentRepository;

  public function __construct (
  	CommentRepositoryContract $commentRepository
  )
  {
    $this->comment = $commentRepository;
  }

  public function allComments($type, $id)
  {
    return $this->comment->getAllComments($type, $id);
  }

  public function lastComments($type, $id, $count)
  {
    return $this->comment->getLastComments($type, $id, $count);
  }

  public function create($segment, $id, $input)
  {
    // set the album attributes
    $input['guest'] = 'Guest';
    $input['commentable_type'] = "App\\".ucfirst($segment);
    $input['commentable_id'] = $id;

    // create the user's album
    $comment = $this->comment->create($input);

    return $comment;
  }

  public function update($id, $data)
  {
    $comment = $this->commentRepo->get($id);
    $user = Auth::user();

    if (array_key_exist('likes',$data))
    {
      if (!$this->comment->isLiked($comment)) 
      {
        $data = [
          'dog_comment_id' => $comment->id,
          'user_id' => $user->id
        ];

        $this->commentLikeRepo->create($data);
      } 
      else
      {
        $likeid = $this->comment->getCommentLike($data);
        $this->dogCommentLike->delete($id);
      };
    };
  }

  public function delete($id)
  {
    if (!$this->comment->delete($id))
    {
      throw new Exception('Delete Failed');
    }

    return 1;
  }

 
}