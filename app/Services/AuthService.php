<?php 

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\ExtProfileRepositoryContract;

use App\Services\Contracts\AuthServiceContract;
use App\Services\Contracts\RegisterServiceContract;

use App\Validators\ValidationException;

use App\Helpers\HashHelper;

use Session;
use Input;
use Image;
use Socialite;
use Hash;
use Illuminate\Contracts\Auth\Guard as Auth;

class AuthService implements AuthServiceContract {

  protected $userRepository;
  protected $validator;

  public function __construct (
    UserRepositoryContract $userRepository,
    RegisterServiceContract $registerService,
    Auth $auth
  )
  {
    $this->userRepository = $userRepository;
    $this->registerService = $registerService;
    $this->auth = $auth;
  }
 
  public function authenticate($input)
  {

    $credentials = [
      'email' => $input['email'],
      'password' => $input['password']
    ];

    $check = $this->auth->attempt($credentials,true);

    return $check;

  }



  public function redirectToProvider($provider){
    return Socialite::driver($provider)->redirect();
  }

  public function getSocialUser($provider){
    $user = Socialite::driver($provider)->user();

    $userData = [
      'username' => $user->nickname,
      'email' => $user->email,
      'avatar' => $user->avatar,
      'first_name' => explode(' ',$user->name)[0],
      'last_name' => explode(' ',$user->name)[1],
    ];

    if (!$user->nickname)
    {

      $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,č, ");
      $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,c,-");
      
      $name = explode(' ',$user->name)[0].explode(' ',$user->name)[1];

      $userData['username'] = strtolower(trim(str_replace($search, $replace, $name)));

    }

    $dbUser = $this->userRepository->getOneWhere('email',$user->email);

    if ($dbUser)
    {
      $this->auth->login($dbUser, true);
      $userData['existing']=1;
    }
    else
    {
      $userData['existing']=0;
    }

    return $userData;

  }



  public function logout()
  {
    return $this->auth->logout();
  }
 
}