<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryContract;

use App\Helpers\HashHelper;

abstract Class BaseRepository implements BaseRepositoryContract {

	protected $model;

	public function getAll() {
		return $this->model->all();
	}

	public function getLists($column) {
		return $this->model->lists($column);
	}

	public function getListsWhere($list, $column, $value) {
		return $this->model->where($column, 'like', $value)->lists($list);
	}

	public function allOrder($orderBy,$orderType) {
		return $this->model->orderBy($orderBy,$orderType)->get();
	}

	public function get($id) {
		return $this->model->find($id);
	}

	public function getOneWhere($column, $value, $with=[])
	{
		return $this->model->with($with)->where($column, $value)->first();
	}

	public function getManyWhere($column, $value)
	{
		return $this->model->whereIn($column, (array)$value)->get();
	}

	public function getOneWhereRaw($sql)
	{
		return $this->model->whereRaw($sql)->first();
	}

	public function getManyWhereRaw($sql)
	{
		return $this->model->whereRaw($sql)->get();
	}

	public function countWhere($column, $value)
	{
		return $this->model->where($column,'=', $value)->count();
	}

	public function create(array $data) 
	{
		return $this->model->create($data);
	}

	public function createHash() 
	{
		$hash = HashHelper::getToken(5);

    while ($this->model->where('hash','=', $hash)->count() > 0) 
    {
    	$hash=HashHelper::getToken(5);
    };
    
    return $hash;
	}

	public function update($id, array $data) 
	{
		return $this->model->whereIn('id', (array)$id)->update($data);
	}

	public function delete($id) {
		return $this->model->find($id)->delete();
	}

	public function deleteWhere($column, $value) {

	}

}