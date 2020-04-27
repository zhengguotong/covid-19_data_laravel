<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\ModelNotDefinedException;
use App\Repositories\Contracts\IBase;
use App\Repositories\Criteria\ICriteria;
use Illuminate\Support\Arr;

abstract class BaseRepository implements IBase, ICriteria
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModelClass();
    }

    public function all()
    {
        return $this->model->get();
    }

    public function first()
    {
        return $this->model->first();
    }

    public function find($id)
    {
        $result = $this->model->findOrFail($id);
        return $result;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id,array $data)
    {   
        $record = $this->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        $record = $this->find($id);
        return $record->delete($id);
    }

    public function updateOrCreate(array $condition, array $data)
    {
        $this->model->updateOrCreate($condition,$data);
    }

    public function withCriteria(...$criteria)
    {
        $criteria = Arr::flatten($criteria);
        foreach($criteria as $criterion){
            $this->model = $criterion->apply($this->model);
        }
        return $this;
    }
    
    protected function getModelClass()
    {
        if(!method_exists($this, 'model')){
            throw new ModelNotDefinedException("Not Model Defined");
        }
        return app()->make($this->model());
    }
}