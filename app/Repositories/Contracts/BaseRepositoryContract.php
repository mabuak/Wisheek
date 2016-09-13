<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryContract{

    public function getAll();

	  public function getLists($column);

    public function get($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function deleteWhere($column, $value);

    public function getOneWhere($column, $value, $with);

}