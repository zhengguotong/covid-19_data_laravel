<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IBase
{
    public function all();
    public function paginate(int $per_page);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function updateOrCreate(array $condition, array $data);
}
