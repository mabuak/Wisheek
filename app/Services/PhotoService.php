<?php 

namespace App\Services;

use App\Repositories\Contracts\PhotoRepositoryContract;
use App\Repositories\Contracts\PostRepositoryContract;

use App\Services\Contracts\PhotoServiceContract;

use Session;
use File;
use FileHelper;
use Image; 
use Auth; 

class PhotoService implements PhotoServiceContract{

	protected $photoRepository;
	protected $albumRepository;

	public function __construct(
    PhotoRepositoryContract $photoRepository
  )
	{
	  $this->photoRepo = $photoRepository;

	}

	public function get($id)
	{
		return $this->photoRepo->get($id);
	}

	public function likes($id)
	{
		$photo = $this->photoRepo->get($id);
		return $photo->likes->count();
	}

  public function albumPhotos($albumid)
  {
    $photos = $this->albumRepo->getAlbumPhotos($albumid);
    return $photos;
  }

  public function deleteTemp()
  {
    File::deleteDirectory('temp/photos');
    return 1;
  }

  public function preview($file)
  {
  	$albumHash = md5(Auth::user()->id);
		Session::put('album', $albumHash);

		$originalPath = 'temp/'.$albumHash.'/original';
		$thumbPath = 'temp/'.$albumHash.'/thumb';
		
		$extension = $file->getClientOriginalExtension(); 
		
		$original = md5(uniqid(rand(), true));
		
		$thumb_name = $original.'thumb'.'.'.$extension;
		$original_name = $original.'.'.$extension;
		
		$preview_success = $file->move($originalPath, $original_name);

		if ($preview_success) 
		{
			if (!File::isDirectory($thumbPath)) {File::makeDirectory($thumbPath);};
		  Image::make($originalPath.'/'.$original_name)->widen(400)->save($thumbPath.'/'.$thumb_name);
		  return $thumbPath.'/'.$thumb_name;
		} 
		else 
		{
			throw new Exception("Error Processing Request", 1);
		}
  }

  public function confirm($input)
  {
  	$sessionalbum=Session::pull('album');

  	$segment = $input['segment'];
  	$albumId = $input['album'];

  	$destinationPath = 'uploads/'.$segment.'s/photos/'.date('m').'_'.date('Y');
  	$photoIDs =[];

  	$originalPath = 'temp/'.$sessionalbum.'/original';
	$thumbPath = 'temp/'.$sessionalbum.'/thumb';

  	$files = File::files($originalPath);

  	foreach ($files as $key => $item) 
  	{	
    	$filename=explode('/',$item);
    	$filename=end($filename);
		$fullpath = $destinationPath.'/'.$filename;

		if (!(File::isDirectory($destinationPath))) {File::makeDirectory($destinationPath);}
		File::move($item, $fullpath);

		// generate the hash for the photo
		$hash = $this->photoRepo->createHash();

		$album = $this->albumRepo->get($albumId);

		$input['hash'] = $hash;
		$input['path'] = $fullpath;

		$photo = $this->photoRepo->create($input);
		
		$this->albumRepo->attachPhotoToAlbum($albumId,$photo->id);

		// set the cover of the album to the first photo
		if ($key==0){
			$coverInput['cover'] = $fullpath;
			$this->albumRepo->update($albumId, $coverInput);
		}

		array_push($photoIDs, $photo->id);

	}

  	$files = File::files($thumbPath);

	foreach ($files as $item) 
	{
		$filename=explode('/',$item);
		$filename=end($filename);
		$fullpath = $destinationPath.'/'.$filename;

		File::move($item, $fullpath);
	}

	return $photoIDs;	

  }

  public function delete($id)
  {
  	$photo = $this->photoRepo->get($id);

  	//delete the post if this is the only photo
    $post = $photo->posts->first();

    if ($post) 
    {
    	$postPhotos = $post->photos;
    	if ($postPhotos->count()==1)
    	{
			$this->postRepo->delete($post->id);
    }	
    }



    $this->photoRepo->delete($id);
    File::delete($photo->path);
    File::delete(FileHelper::getThumb($photo->path));


  }

  
}