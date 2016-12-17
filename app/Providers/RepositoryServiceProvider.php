<?php 

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. 
	 *
	 * @return void
	 */
	public function register()
	{

    $this->app->bind(
      'App\Repositories\Contracts\ScrapeRepositoryContract', 
      'App\Repositories\ScrapeRepository'
    );

 		$this->app->bind(
    	'App\Repositories\Contracts\PinRepositoryContract', 
      'App\Repositories\PinRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\UserRepositoryContract', 
      'App\Repositories\UserRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\SelectorRepositoryContract', 
      'App\Repositories\SelectorRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\VoteRepositoryContract', 
      'App\Repositories\VoteRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\ProfileSectionRepositoryContract', 
      'App\Repositories\ProfileSectionRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\FollowerRepositoryContract', 
      'App\Repositories\FollowerRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\GroupRepositoryContract', 
      'App\Repositories\GroupRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\ChatRepositoryContract', 
      'App\Repositories\ChatRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\DogRepositoryContract', 
      'App\Repositories\DogRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\AssetSettingRepositoryContract', 
      'App\Repositories\AssetSettingRepository'
    );


    $this->app->bind(
      'App\Repositories\Contracts\KennelRepositoryContract', 
      'App\Repositories\KennelRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\KennelInfoRepositoryContract', 
      'App\Repositories\KennelInfoRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\ExamRepositoryContract', 
      'App\Repositories\ExamRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\NotificationRepositoryContract', 
      'App\Repositories\NotificationRepository'
    );

    $this->app->bind(
      'App\Repositories\Contracts\ShowRepositoryContract', 
      'App\Repositories\ShowRepository'
    );

    $this->app->bind(
        'App\Repositories\Contracts\NewsRepositoryContract', 
        'App\Repositories\NewsRepository'
    );

    $this->app->bind(
        'App\Repositories\Contracts\LitterRepositoryContract', 
        'App\Repositories\LitterRepository'
    );

    $this->app->bind(
        'App\Repositories\Contracts\PhotoRepositoryContract', 
        'App\Repositories\PhotoRepository'
    );

    $this->app->bind(
        'App\Repositories\Contracts\PageRepositoryContract', 
        'App\Repositories\PageRepository'
    );

    $this->app->bind(
        'App\Repositories\Contracts\AlbumRepositoryContract', 
        'App\Repositories\AlbumRepository'
    );

    $this->app->bind(
        'App\Repositories\Contracts\PostRepositoryContract', 
        'App\Repositories\PostRepository'
    );

    $this->app->bind(
        'App\Repositories\Contracts\RequestRepositoryContract', 
        'App\Repositories\RequestRepository'
    );

    $this->app->bind(
        'App\Repositories\Contracts\LandingPhotoRepositoryContract', 
        'App\Repositories\LandingPhotoRepository'
    );

    $this->app->bind(
        'App\Repositories\Contracts\CommentRepositoryContract', 
        'App\Repositories\CommentRepository'
    );

    $this->app->bind(
        'App\Repositories\Contracts\VetRepositoryContract', 
        'App\Repositories\VetRepository'
    );

    $this->app->bind(
        'App\Repositories\Contracts\RatingRepositoryContract', 
        'App\Repositories\RatingRepository'
    );
  
   $this->app->bind(
        'App\Repositories\Contracts\PersonRepositoryContract', 
        'App\Repositories\PersonRepository'
    );

	}

	

}
