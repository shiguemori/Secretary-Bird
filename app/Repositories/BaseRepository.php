<?php
        
namespace App\Repositories;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
abstract class BaseRepository
{
    /**
     * @var
     */
	protected $model;

    /**
     * @param $id
     * @return mixed
     */
	public function find($id)
	{
		return $this->model->find($id);
	}

    /**
     * @param $data
     * @return mixed
     */
	public function create($data)
	{		
		return $this->model->create($data);
	}

    /**
     * @param $data
     * @return mixed
     */
	public function delete($data)
	{
		return $this->model->delete($data);
	}

    /**
     * @return mixed
     */
	public function all()
	{
		return $this->model->all();
	}

    /**
     * @return mixed
     */
	public function model()
	{
		return $this->model;
	}
}