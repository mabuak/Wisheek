<?php 

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Contracts\PostRepositoryContract;
use App\Repositories\Contracts\FollowerRepositoryContract;

//use App\Services\Contracts\NotificationServiceContract;
use App\Services\Contracts\UserServiceContract;

use exceptions\AssetNotFoundException;

use Auth;
use Session;
use File;
use Hash;

class UserService implements UserServiceContract{

	protected $userRepository;
	protected $postRepository;
	protected $newsService;

	public function __construct(
		UserRepositoryContract $userRepository, 
		PostRepositoryContract $postRepository,
		FollowerRepositoryContract $followerRepository
	  	//NotificationServiceContract $notificationService

	)
	{
	  $this->user = $userRepository;
	 	$this->post = $postRepository;
	 	$this->follower = $followerRepository;
	 	//$this->notification = $notificationService;
	}



	public function all()
	{
	  return $this->user->getAll();
	}

	public function get($id)
	{	
		return $this->user->get($id);
	}


	public function search($filter)
	{	
		return $this->user->simpleSearch($filter);
	}


	public function show($username)
	{
		if (is_numeric($username))
		{
	  	$user =  $this->user->get($username,['dogs','kennels']);
	  } 
	  else
	  {
	  	$user =  $this
	  	->user
	  	->getOneWhere('username',$username, ['dogs','kennels','dogs.settings','dogs.breed','dogs.likes']);
	  }

	  if (!$user)
	  {
	  	throw new AssetNotFoundException('Asset not found');
	 	}

	 	return $user; 
	}

	public function update($data)
	{
		$user = Auth::user();
		
		//remove empty values
		$data = array_filter($data);

		if (array_key_exists('username', $data))
		{
			$input['username'] = $data['username'];
			$this->user->update($user->id, $input);
		}

		if (array_key_exists('email', $data))
		{
			$input['email'] = $data['email'];
			$this->user->update($user->id, $input);
		}

		if (array_key_exists('contact_email', $data))
		{
			$input['contact_email'] = $data['contact_email'];
			$this->user->update($user->id, $input);
		}

		if (array_key_exists('contact_phone', $data))
		{
			$input['contact_phone'] = $data['contact_phone'];
			$this->user->update($user->id, $input);
		}

		if (array_key_exists('password', $data))
		{
			if (Hash::check($data['password'], Auth::user()->password))
			{
				$input['password'] = Hash::make($data['password']);
				$this->user->update($user->id, $input);
			}
		}


	    // Changing avatar
	    if (Session::has('avatar'))
	    {
	      $filename = Session::pull('avatar');

	      $destinationPath = 'uploads/users/avatars/'.date('m').'_'.date('Y');
	      $fullpath = $destinationPath.'/'.$filename;

	      if (!(File::isDirectory($destinationPath))) File::makeDirectory($destinationPath);
	      File::move('temp/'.$filename, $fullpath);
	        
	      $input['avatar'] = $fullpath;
	      $this->user->update($user->id, $input);
	    };


	}

	public function checkUsername($username)
	{
		return $this->user->countWhere('username', $username);
	}


	public function checkPassword($password)
	{
		return Hash::check($password, Auth::user()->password);
	}

}