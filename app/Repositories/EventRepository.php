<?php

namespace App\Repository;

use App\Interfaces\EventInterface;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;

class EventRepository implements EventInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new Event();
    }

    public function all($request) {}

    public function getById($id) {}

    public function create($request) {}

    public function update($request,$id) {}

    public function delete($id) {}
}
