<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selector extends Model {

  protected $table  = "selectors";
  protected $fillable = ['url','selector'];
  

}