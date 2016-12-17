<?php
 
namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;

use App\Http\Controllers\BE\PinController as BE;
use App\Http\Requests\PinRequest;

use Illuminate\Http\Request;

use Session;

class PinController extends Controller {

	public function __construct(BE $BE)
	{
    $this->BE = $BE;
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
    if ($isEdit)
    {
      $data['bodyname'] = 'editpin';
    }


    $data = $this->BE->show($hash);
    $data['editmode'] = $isEdit;



    return view('pins/view', $data);
  }

  public function edit($hash, Request $request)
  { 

   $pin = $this->BE->get($hash)['pin'];
   $this->BE->checkOwner($pin->id);

    return $this->show($hash, $request);
  }


	/**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
	public function store(PinRequest $request) 
	{
			$response = $this->BE->create($request->all());

      return 1;
	}
	
  public function update($id, Request $request) 
  {
    return $response = $this->BE->update($id, $request->except('_token'));
  }
  

	

  /**
   * Delete the resource
   *
   * @param  string  $id
   * @return Response
   */
  public function destroy($id)
  {
    $this->BE->checkOwner($id);

    try 
    {
      $data = $this->BE->delete($id);

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
      'results' => $this->BE->search($filters,$sortBy,$sortOrder,$paginate),

      'filters' => $filters,
      'sortBy' => $sortBy,
      'sortOrder' => $sortOrder
    ];

    return $data;

  }

 

}