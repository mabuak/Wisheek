<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model {

  protected $table  = "pins";
  protected $fillable = ['price','want_price','title','image','user_id','store','url','hash'];
  
  public function likes() {
        return $this->morphMany('App\Vote','votable')->where('type',0);
    }

      public function dislikes() {
        return $this->morphMany('App\Vote','votable')->where('type',1);
    }

    public function comments() {
        return $this->morphMany('App\Comment','commentable');
    }

  public function comments3() {
        return $this->morphMany('App\Comment','commentable')->limit(3)->orderBy('created_at','desc');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}