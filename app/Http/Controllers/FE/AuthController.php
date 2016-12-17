<?php 

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BE\AuthController as BE;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

use App\Http\Requests\AuthRequest;

use App\User;

class AuthController extends Controller {

	public function __construct(BE $BE)
	{
      $this->BE = $BE;
	}


	public function getLogin()
	{
		return view('auth.login');
	}


	public function postLogin(AuthRequest $request)
	{
		
  		$result = $this->BE->postLogin($request);

  		if ($result!==0)
  		{    
    		return redirect()->back()->withErrors('Incorrect password');
    	}

    	return redirect('/');
	}
	
	public function getLogout()
	{
		$this->BE->getLogout();

		return redirect('/');
	}

	public function redirectToProvider($provider)
    {
        return $this->BE->redirectToProvider($provider);
    }


    public function handleProviderCallback($provider)
    {
        $user = $this->BE->handleProviderCallback($provider);
        if ($user['existing']==0) { 
        	return redirect('/register')->withInput($user);
   	 	}
    	else{
        	return redirect('/');

    	}
    }

}

