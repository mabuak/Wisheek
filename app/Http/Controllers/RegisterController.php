<?php

namespace App\Http\Controllers;

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

      if (!$response)
      {
         return redirect('/register?code='.$request->get('code'))->withInput()->withErrors('Something went wrong. Try again please');
      }
      
  		return redirect('/');
   }
 
}