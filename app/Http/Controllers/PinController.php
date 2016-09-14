<?php
 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\Contracts\PinServiceContract;
use App\Http\Requests\PinRequest;

use Illuminate\Http\Request;

use Session;

class PinController extends Controller {

	public function __construct(PinServiceContract $pinService)
	{
    $this->pinService = $pinService;
  }

  /**
   * Display a listing of the resource.
   *
   * @return View
   */
	public function index() 
	{
		return view('pins/all');
	}


  public function create() 
  {
    return view('pins/add');
  }

  public function show($hash, Request $request) 
  {
    $isEdit = $request->segment(3)=='edit';

    $data = $this->pinService->get($hash);
    $data['editmode'] = $isEdit;

    if ($isEdit){
    $data['bodyname'] = 'editpin';
    }

    return view('pins/view', $data);
  }

  public function edit($hash, Request $request)
  { 


   $this->pinService->checkOwner($hash);
    return $this->show($hash, $request);
  }


	/**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
	public function store(PinRequest $request) 
	{
			$response = $this->pinService->create($request->all());
		  
      return 1;
	}
	
  public function update($id, Request $request) 
  {
      
      return $response = $this->pinService->update($id, $request->except('_token'));
  }
  

	

  /**
   * Delete the resource
   *
   * @param  string  $id
   * @return Response
   */
  public function destroy($id)
  {
    $this->pinService->checkOwner($id);

    try 
    {
      $data = $this->pinService->delete($id);
    } 
    catch (Exception $e) 
    {
      return Response::json('error', 400);
    };
    
    return 1;
  }


 

}