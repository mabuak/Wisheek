<?php 

namespace App\Services;

use App\Services\Contracts\ReminderServiceContract;

use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Contracts\Auth\Guard;

use Password;
use Hash;

class ReminderService implements ReminderServiceContract {

  protected $validator;

  public function __construct(Guard $auth, PasswordBroker $passwords)
  {
    $this->auth = $auth;
    $this->passwords = $passwords;
  }

  public function remind($email)
  {
    $response = $this->passwords->sendResetLink($email, function($m)
    {
      $m->from("reminder@woofyard.com");
      $m->subject($this->getEmailSubject());
    });

    return $response;

  }


  /**
   * Get the e-mail subject line to be used for the reset link email.
   *
   * @return string
   */
  protected function getEmailSubject()
  {
    return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
  }



  public function reset($credentials)
  {
    $response = $this->passwords->reset($credentials, function($user, $password)
    {
      $user->password = bcrypt($password);

      $user->save();

      $this->auth->login($user,true);
    });

    return $response;
  }
 
}