<?php namespace App\Services;

use App\Repositories\Contracts\RatingRepositoryContract;

use App\Services\Contracts\RatingServiceContract;


class RatingService implements RatingServiceContract{

  public function __construct (
    RatingRepositoryContract $ratingRepository
  )
  {
    $this->ratingRepo = $ratingRepository;
  }

  public function stream() 
	{
	  $stream = $this->ratingRepo->getStream();
    
	  return $stream;
  }

  public function create($data) 
  {
    $new = $this->ratingRepo->create($data);

    return $new;
  }

 
}