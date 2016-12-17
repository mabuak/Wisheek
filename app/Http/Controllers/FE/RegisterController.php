<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BE\RegisterController as BE;

use App\Http\Requests\RegisterRequest;

use App\Validators\ValidationException;

use Illuminate\Http\Request;
use Config;

class RegisterController extends Controller {
	

  	public function __construct(BE $BE)
  	{
      $this->BE = $BE;
  	}	
 
    public function getCode()
    {
      return view('register.code');
    }



  	public function getRegister()
  	{
   	  return view('register.index');
  	}

    public function postRegister(RegisterRequest $request)
    {
      $response = $this->BE->postRegister($request);

      if (!$response)
      {
         return redirect('/register?code='.$request->get('code'))->withInput()->withErrors('Something went wrong. Try again please');
      }
      
      return redirect('/');
   }
 
}