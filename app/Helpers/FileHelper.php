<?php 

namespace App\Helpers;

Class FileHelper {

	public static function getThumb($path) {
		
		$array=explode('.',$path);
		$left=$array[0];
		$right=$array[1];
		$thumb = $left.'thumb.'.$right;

		return $thumb;

	}

}