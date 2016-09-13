<?php 

namespace App\Services;

use App\Repositories\Contracts\DogRepositoryContract;
use App\Repositories\Contracts\KennelRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;

use App\Services\Contracts\SearchServiceContract;

class SearchService implements SearchServiceContract{

	public function __construct(
    DogRepositoryContract $dogRepository, 
    KennelRepositoryContract $kennelRepository, 
    UserRepositoryContract $userRepository
  )
	{
	  $this->dog = $dogRepository;
	 	$this->kennel = $kennelRepository;
	  $this->user = $userRepository;
	}

	public function searchAll($query)
	{
    $users = $this->user->simpleSearch($query);
		$dogs = $this->dog->simpleSearch($query);
		$kennels = $this->kennel->simpleSearch($query);
		
		$data = [
			'users' => $users,
      'dogs' => $dogs,
      'kennels' => $kennels
    ];

    return $data;
	}

}

