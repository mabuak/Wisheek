<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Services\Contracts\PinServiceContract;

use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  public function __construct(PinServiceContract $pinService)
  {
    $this->pinService = $pinService;
  }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
    // logged on user
    if (Auth::check())
    {

      $data = [
        'stream' => $this->pinService->stream()
      ];

      return view('users/home',$data);

   
    } 
    // guest user
    else 
    {

      $data = [
      ];

      return view('users/landing',$data);

    }
  }

}
