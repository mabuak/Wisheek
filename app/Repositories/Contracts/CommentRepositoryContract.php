<?php 

namespace App\Repositories\Contracts;

interface CommentRepositoryContract {

	public function getAllComments($type, $id);

	public function getLastComments($type, $id, $count);

}