<?php 

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryContract;

use App\Services\Contracts\RegisterServiceContract;
use App\Services\Contracts\MailServiceContract;

use Illuminate\Notifications\Notifiable;
use App\Notifications\WelcomeNotification;

use Hash;
use Auth;
use Notification;

class RegisterService implements RegisterServiceContract{

  use Notifiable;

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
      $this->sendWelcomeEmail();

      // login user right after registration
      Auth::login($user, true);
      return $user;

  }

  public function createExtProfile($data)
  {
    $extProfile = $this->extProfileRepository->create($data);
  }
 
  public function sendWelcomeEmail()
    {
      $user = $this->userRepository->getOneWhere('email','gtorch@gmail.com');
      Notification::send($user, new WelcomeNotification($user));
    }
 
}