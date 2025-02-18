<?php

namespace App\Interfaces;

use App\Dto\EventDto;
use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;
interface EventInterface {

 public function all(FormRequest $request): \Illuminate\Pagination\LengthAwarePaginator;

 public function findEventOrFail(int $id):Event;

 public function create(EventDto $eventDto):Event;

 public function update(EventDto $eventDto,int $id):bool;

 public function delete(int $id):bool;
}