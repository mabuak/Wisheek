<?php 

namespace App\Services;

use App\Services\Contracts\MailServiceContract;

use Mail;

class MailService implements MailServiceContract{

	public function __construct()
	{
	 	
	}

	public function sendWelcome($data)
	{
	    Mail::queue('emails.welcome', $data, function($message) use ($data) {
	      $message->to($data['email'])
	              ->subject('Welcome to Woofyard!')
	              ->from('welcome@woofyard.com','Woofyard');
	    });

	    return 1;
	}

}