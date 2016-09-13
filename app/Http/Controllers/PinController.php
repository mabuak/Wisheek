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

  public function show($hash) 
  {
    $data = $this->pinService->get($hash);
    return view('pins/view', $data);
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

  /**
   * Check the availability of url name 
   *
   * @return Response
   */
  public function checkUrlName($urlname) 
  {
    return $this->carService->checkUrlName($urlname);
  }

	
	// function for sorting and filtering cars in JSON
	public function grid(Request $request) 
	{

    $result = $this->search($request);

		$data = [
      'cars' => $result['results'],
      'filters' => $result['filters'],
      'sortBy' => $result['sortBy'],
      'sortOrder' => $result['sortOrder']
    ];

		return view('cars/grid', $data)->render();
	}

  // function for sorting and filtering cars in JSON
  public function search(Request $request) 
  {
    If ($request->has('sortBy')) {$sortBy=$request->get('sortBy');} else {$sortBy='name';}
    If ($request->has('sortOrder')) {$sortOrder=$request->get('sortOrder');} else {$sortOrder='asc';}
    $filters=json_decode($request->get('filters'),true);
    $paginate=$request->get('paginate');

    $data = [
      'results' => $this->carService->search($filters,$sortBy,$sortOrder,$paginate),
      'filters' => $filters,
      'sortBy' => $sortBy,
      'sortOrder' => $sortOrder
    ];

    return $data;

  }

  // function for displaying all cars
  public function getAlbums($carId) 
  {
    return $this->carService->getAlbums($carId);
  }


  // function for displaying all cars
  public function listing(Request $request) 
  {
    $result = $this->search($request);

    $data = [
      'cars' => $result['results'],
      'filters' => $result['filters'],
      'sortBy' => $result['sortBy'],
      'sortOrder' => $result['sortOrder']
    ];

    return view('cars/list',$data)->render();
  }

  public function getAssetBox(Request $request)
  {
    if ($request->has('carid'))
    {
      $data = [
        'asset' => $this->carService->get($request->get('carid')),
        'segment' => 'car'
      ];

      return view('assets.assetbox',$data);
    } 
    else 
    {
      $data = [
        'name' => $request->get('carname'),
        'editmode' => $request->get('editmode'),
        'filter_kennel_id' => $request->get('filter_kennel_id')
      ];

      return view('assets.emptybox',$data);
    }
  }

  public function getEmptyBox()
  {
    $data = [
      'editmode'=>1
    ];
    return view('assets.emptybox',$data);
  } 

  public function getParentBox(Request $request)
  {
    $data = [
      'asset' => $this->carService->get($request->get('carid'))
    ];

    return view('cars.parent',$data);
  } 


	// VIEW - editing car avatar
	public function editAvatar($id) 
  {
    $this->carService->checkOwner($id);

    $data = [
      'assetId' => $this->carService->getByUrlname($id)->id
    ];

		return view('assets/editavatar',$data);
	}

 

}