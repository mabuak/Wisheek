<?php 

namespace App\Services;

use App\Repositories\Contracts\PostRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;

use App\Services\Contracts\PostServiceContract;

use Hash;
use Auth;
use Session;

/**
* Our DogService, containing all useful methods for business logic around Dogs
*/
class PostService implements PostServiceContract{

	protected $postRepository;

	public function __construct(
		PostRepositoryContract $postRepository,
		UserRepositoryContract $userRepository
	)
	{
		$this->postRepo = $postRepository;
	 	$this->userRepo = $userRepository;
	}

	 public function get($id)
  {
    return $this->postRepo->get($id);
  }

	//some session and files cleanup
	public function initNewPost()
	{
		Session::forget('uploading_original');
		Session::forget('uploading_thumb');
		$files = glob('temp/'.md5(Auth::user()->id).'/original/*'); // get all file names
		if ($files){
			foreach($files as $file){ // iterate files
			  if(is_file($file))
			    unlink($file); // delete file
			}
			$files = glob('temp/'.md5(Auth::user()->id).'/thumb/*'); // get all file names

			foreach($files as $file){ // iterate files
			  if(is_file($file))
			    unlink($file); // delete file
			}
		}
	}

	public function create($data)
	{
		$user = Auth::user();

		// generate the hash for the post
		$hash = $this->postRepo->createHash();

	    $data['hash'] = $hash;
	    $data['user_id'] = $user->id;

	    // CREATE POST
	    $newpost = $this->postRepo->create($data);

		// attach the photo to the post
	   	if ($newpost->type_id==2)
	   	{	
	   		//photos are set as input in jquery
	   		foreach ($data['photos'] as $photo)
	   		{
				$newpost->photos()->attach($photo); 
			}
	   	}
		

	return $newpost;

	}

	public function update($id, $input)
	{
		$this->postRepo->update($id, $input);
	}

	public function destroy($id)
	{
		$post = $this->postRepo->get($id);
		if ($post->user_id == Auth::user()->id){
			$this->postRepo->delete($id);
		}
	}


	public function stream($userid,$limit,$offset) 
	{
	  $stream = $this->postRepo->getUserStream($userid);

	  return $stream;
  }

	public function postsFor($userid) 
	{
	  $stream = $this->postRepo->getUserPosts($userid);
	      
	  return $stream;
   }
}