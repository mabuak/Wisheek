<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

use App\Services\Contracts\AuthServiceContract;
use App\Http\Requests\AuthRequest;

use App\User;

class AuthController extends Controller {

	public function __construct(AuthServiceContract $authService, Guard $auth)
	{
		$this->authService = $authService;
		$this->auth = $auth;
		$this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
		return view('auth.login');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(AuthRequest $request)
	{
		
  		$result = $this->authService->authenticate($request->all());

  		if (!$result)
  		{    
    		return redirect()->back()->withErrors('Incorrect password');
    	}

    	return redirect('/');
	}

	/**
     * Redirect the user to the social provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return $this->authService->redirectToProvider($provider);
    }
 
    /**
     * Obtain the user information from social provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = $this->authService->getSocialUser($provider);
        if ($user['existing']==0) { 
        	return redirect('/register')->withInput($user);
   	 	}
    	else{
        	return redirect('/');

    	}
    }

	public function loggedIn($user)
	{
		return redirect('/');
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		$this->auth->logout();

		return redirect('/');
	}

}

