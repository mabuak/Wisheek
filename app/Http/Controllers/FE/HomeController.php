<?php namespace App\Http\Controllers\FE;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Services\Contracts\PinServiceContract;
use App\Http\Controllers\Controller;

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

    //dd($token = Auth::user()->createToken('Token Name')->accessToken);

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
