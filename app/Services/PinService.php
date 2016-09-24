<?php 

namespace App\Services;

use App\Repositories\Contracts\PinRepositoryContract;
use App\Services\Contracts\PinServiceContract;

use App\Exceptions\PinNotEditableException;

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

  public function checkOwner($hash)
  { 
    $pin = $this->pin->getOneWhere('hash',$hash);

    $check = $this->pin->getOneWhere('hash',$hash)->user->id == Auth::user()->id;

    if (!$check)
    {
      throw new PinNotEditableException;
    }
  }

  public function get($hash){
    $data['pin'] = $this->pin->getOneWhere('hash',$hash);
    return $data;
  }


  public function create($data) 
  {
    $data['user_id']=Auth::user()->id;
    $new = $this->pin->create($data);

    return $new;
  }

 public function stream() 
  {
    if (Auth::user()->admin){
      $stream = $this->pin->getALlPins();
    } 
    $stream = $this->pin->getStream(Auth::user()->id);
    
    return $stream;
  }

  public function update($id, $data)
  {
    $pin = $this->pin->update($id, $data);
  }

  public function delete($id)
  {
    $this->pin->delete($id);
  }

 
}