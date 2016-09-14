<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ReminderServiceContract;
use App\Http\Requests\CodeRequest;
use App\Http\Requests\ReminderRequest;
use App\Http\Requests\ResetRequest;

use NotFoundHttpException;

use App\Validators\ValidationException;

use Illuminate\Http\Request;
use App\Token;

class ReminderController extends Controller {

	public function __construct(
    ReminderServiceContract $reminderService
  )
	{	
		$this->reminderService = $reminderService;
	}

  
  /**
   * Display the form to request a password reset link.
   *
   * @return Response
   */
	public function getEmail()
	{ 
   	return view("reminder.remind");
	}

  /**
   * Send a reset link to the given user.
   *
   * @param  Request  $request
   * @return Response
   */
	public function postEmail(ReminderRequest $request)
	{  
   	$response = $this->reminderService->remind($request->only('email'));

    switch ($response)
    {
      case 0:
        return redirect()->back()->with('status', trans($response));

      case 1:
        return redirect()->back()->withErrors(['email' => trans($response)]);
    }
	}


  /**
   * Display the password reset view for the given token.
   *
   * @param  string  $token
   * @return Response
   */
  public function getReset($token, Request $request)
  {
    if (is_null($token) || Token::where('token','=', $token)->count()==0)
    {
      return view('reminder.reset')->withErrors('Invalid Token')->with('token', $token);;
    }

    return view('reminder.reset')->with('token', $token);
  }


   /**
   * Reset the given user's password.
   *
   * @param  Request  $request
   * @return Response
   */
  public function postReset(ResetRequest $request)
  {
    $credentials = $request->only(
      'email', 'password', 'password_confirmation', 'token'
    );

    $email = Token::where('token','=', $request->get('token'))->first();
    
    if($email) {
      $email = $email->email;
    }

    $credentials['email'] = $email;

    $response = $this->reminderService->reset($credentials);

    switch ($response)
    {
      case PasswordBroker::PASSWORD_RESET:
        return view('reminder/success');

      default:
        return redirect()->back()->withErrors(['email' => trans($response)]);
    }
  }


}