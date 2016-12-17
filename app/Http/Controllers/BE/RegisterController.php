<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\Controller;

use App\Services\Contracts\RegisterServiceContract;
use App\Http\Requests\RegisterRequest;

use App\Validators\ValidationException;

use Illuminate\Http\Request;
use Config;

class RegisterController extends Controller {
	
	/**
   * Dependecny Injection
   *
   * @return void
   */
  	public function __construct(
      RegisterServiceContract $registerService
    )
  	{
   	  $this->registerService = $registerService;
  	}	
 
    public function getCode()
    {
      return view('register.code');
    }

  	/**
    * Display the form for creating a new user
    *
    * @return View
    */
  	public function getRegister()
  	{
   	  return view('register.index');
  	}

   /**
    * Create a new user
    *
    * @return Redirect
    */
  	public function postRegister(RegisterRequest $request)
	  {
    	$response = $this->registerService->create($request->all());

      return $response;
   }

    public function sendWelcomeEmail()
    { 
      return $this->registerService->sendWelcomeEmail();
    }
 
}