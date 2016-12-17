<?php 

namespace App\Http\Controllers\BE;

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

  		if ($result===true)
  		{
  			return 0;
  		}
  		elseif ($result===false)
  		{
  			return 401;
  		}
  		else
  		{
  			return $result;
  		}
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
        return $user;
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

		return 0;
	}

}

