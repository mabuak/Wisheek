<?php 

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	public function register()
	{

		$this->app->bind('dateHelper', function()
	  	{
	    	return new \App\Helpers\DateHelper;
		});

		$this->app->bind('fileHelper', function()
	  	{
	    	return new \App\Helpers\FileHelper;
		});


	}

}
