<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\ModelNotDefinedException;
use App\Repositories\Contracts\IBase;
use Exception;

abstract class BaseRepository implements IBase
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModelClass();
    }

    public function all()
    {
        return $this->model::all();
    }

    public function find($id)
    {
        $result = $this->model->findOrFail($id);
        return $result;
    }

    public function create(array $data)
    {

    }

    public function update($id,array $data)
    {

    }

    public function delete($id)
    {

    }
    
    protected function getModelClass()
    {
        if(!method_exists($this, 'model')){
            throw new ModelNotDefinedException("Not Model Defined");
        }
        return app()->make($this->model());
    }
}