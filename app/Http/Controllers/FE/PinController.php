<?php
 
<<<<<<< HEAD
namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;

use App\Http\Controllers\BE\PinController as BE;
=======
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\Contracts\PinServiceContract;
>>>>>>> origin/master
use App\Http\Requests\PinRequest;

use Illuminate\Http\Request;

use Session;

class PinController extends Controller {

<<<<<<< HEAD
	public function __construct(BE $BE)
	{
    $this->BE = $BE;
=======
	public function __construct(PinServiceContract $pinService)
	{
    $this->pinService = $pinService;
>>>>>>> origin/master
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

<<<<<<< HEAD
    if ($isEdit)
    {
      $data['bodyname'] = 'editpin';
    }


    $data = $this->BE->show($hash);
    $data['editmode'] = $isEdit;

=======
    $data = $this->pinService->get($hash);
    $data['editmode'] = $isEdit;

    if ($isEdit){
    $data['bodyname'] = 'editpin';
    }
>>>>>>> origin/master

    return view('pins/view', $data);
  }

  public function edit($hash, Request $request)
  { 

<<<<<<< HEAD
   $pin = $this->BE->get($hash)['pin'];
   $this->BE->checkOwner($pin->id);
=======
   $pin = $this->pinService->get($hash)['pin'];
   $this->pinService->checkOwner($pin->id);
>>>>>>> origin/master
    return $this->show($hash, $request);
  }


	/**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
	public function store(PinRequest $request) 
	{
<<<<<<< HEAD
			$response = $this->BE->create($request->all());
=======
			$response = $this->pinService->create($request->all());
>>>>>>> origin/master
		  
      return 1;
	}
	
  public function update($id, Request $request) 
  {
      
<<<<<<< HEAD
      return $response = $this->BE->update($id, $request->except('_token'));
=======
      return $response = $this->pinService->update($id, $request->except('_token'));
>>>>>>> origin/master
  }
  

	

  /**
   * Delete the resource
   *
   * @param  string  $id
   * @return Response
   */
  public function destroy($id)
  {
<<<<<<< HEAD
    $this->BE->checkOwner($id);

    try 
    {
      $data = $this->BE->delete($id);
=======
    $this->pinService->checkOwner($id);

    try 
    {
      $data = $this->pinService->delete($id);
>>>>>>> origin/master
    } 
    catch (Exception $e) 
    {
      return Response::json('error', 400);
    };
    
    return 1;
  }


  // function for sorting and filtering dogs in JSON
  public function grid(Request $request) 
  {

    $result = $this->search($request);

    $data = [
      'stream' => $result['results'],
      'filters' => $result['filters'],
      'sortBy' => $result['sortBy'],
      'sortOrder' => $result['sortOrder']
    ];

    return view('pins/grid', $data)->render();
  }



  // function for sorting and filtering dogs in JSON
  public function search(Request $request) 
  {
    If ($request->has('sortBy')) {$sortBy=$request->get('sortBy');} else {$sortBy='created_at';}
    If ($request->has('sortOrder')) {$sortOrder=$request->get('sortOrder');} else {$sortOrder='desc';}
    $filters=json_decode($request->get('filters'),true);
    $paginate=$request->get('paginate');

    $data = [
<<<<<<< HEAD
      'results' => $this->BE->search($filters,$sortBy,$sortOrder,$paginate),
=======
      'results' => $this->pinService->search($filters,$sortBy,$sortOrder,$paginate),
>>>>>>> origin/master
      'filters' => $filters,
      'sortBy' => $sortBy,
      'sortOrder' => $sortOrder
    ];

    return $data;

  }

 

}