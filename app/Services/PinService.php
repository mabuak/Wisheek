<?php 

namespace App\Services;

use App\Repositories\Contracts\PinRepositoryContract;
use App\Services\Contracts\PinServiceContract;

use Hash;
use Session;
use Auth;
use Cookie;
use Str;

class PinService implements PinServiceContract {

  public function __construct (
    PinRepositoryContract $pinRepository
  )
  {
    $this->pin = $pinRepository;
  }

  public function get($hash){
    $data['pin'] = $this->pin->getOneWhere('hash',$hash);
    return $data;
  }

  public function checkOwner($selector)
    { 
    if (!is_numeric($selector))
    {
      $pin = $this->repo->getOneWhere('url_name',$selector);
      $pinid = $pin->id;
    }
    else
    {
      $pinid = $selector;
    }

    $check = $this->pin->checkPinEditable($pinid, Auth::user()->id);

    if (!$check)
    {
      throw new PinNotEditableException;
    }
  }

  public function create($data) 
  {
    $data['user_id']=Auth::user()->id;
    $new = $this->pin->create($data);

    return $new;
  }

 public function stream() 
  {
    $stream = $this->pin->getStream();
    
    return $stream;
  }

  public function delete($id)
  {
    $this->pin->delete($id);
  }

 
}