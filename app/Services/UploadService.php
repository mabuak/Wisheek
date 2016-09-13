<?php

namespace App\Services;

use App\Services\Contracts\UploadServiceContract;

use Session;
use Image;
use File;
use Request;
use Hash;

class UploadService implements UploadServiceContract{

// Process avatar crop
    public function uploadImage($file,$type) 
    {	
			$destinationPath = 'temp';
			$extension = $file->getClientOriginalExtension(); 
			$filename = md5($file->getClientOriginalName().rand(0,1000)).'.'.$extension;
			$fullpath = $destinationPath.'/'.$filename;
			
			//if we are changing the avatar for asset (not creating new) the dog url name is filled
			if (Request::has('asset_url_name'))
			{
				Session::flash(Request::get('asset_url_name'),$filename);
			}

			// store the filename into session
			Session::put($type, $filename);

			$preview_success = $file->move($destinationPath, $filename);

			if ($type=='avatar')
			{
				$w = 400;
			}
			else
			{
				$w = 1920;
			};

			if ($preview_success) 
			{
			  $image = Image::make($destinationPath.'/'.$filename)
			  	   ->widen($w)
				   ->save($destinationPath.'/'.$filename);

			  return url($destinationPath.'/'.$filename);
			} 
			else 
			{
				throw new Exception("Error cropping image", 1);
			}
    }

    public function cropImage($coords,$type)
    {
    	Session::reflash();
    	$filename = Session::get($type);
			$destinationPath = 'temp';
			$fullpath = $destinationPath.'/'.$filename;

			$w = round($coords['upload_w']);
			$h = round($coords['upload_h']);
			$x = round($coords['upload_x']);
			$y = round($coords['upload_y']);

			Image::make($destinationPath.'/'.$filename)
					 ->crop($w, $h, $x, $y)
					 ->save($destinationPath.'/'.$filename);

    }


}