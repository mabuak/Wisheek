<?php 

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryContract;

use App\Services\Contracts\RegisterServiceContract;
use App\Services\Contracts\MailServiceContract;

use Hash;
use Auth;

class RegisterService implements RegisterServiceContract{

  protected $userRepository;
  protected $albumRepository;
  protected $mailService;

  public function __construct (
    UserRepositoryContract $userRepository,
    MailServiceContract $mailService
  )
  {
    $this->userRepository = $userRepository;
    $this->mailService = $mailService;
  }

 
  /**
   * Create a new user entity
   *
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function create(array $data)
  {
      // store the data for the email body
      $emaildata = $data;
      
      // create the customer
      $user = $this->userRepository->create($data);

      $this->userRepository->update($user->id, ['password' => Hash::make($data['password'])]);


      // send the welcome mail
      $this->mailService->sendWelcome($emaildata);

      // login user right after registration
      Auth::login($user, true);
      return $user;

  }

  public function createExtProfile($data)
  {
    $extProfile = $this->extProfileRepository->create($data);
  }
 
}