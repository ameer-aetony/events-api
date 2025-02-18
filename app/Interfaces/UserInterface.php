<?php

namespace App\Interfaces;

use App\Dto\UserDto;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
interface UserInterface {

 public function all(FormRequest $request): \Illuminate\Pagination\LengthAwarePaginator;

 public function findUserOrFail(int $id):User;

 public function create(UserDto $userDto):User;

 public function update(UserDto $userDto,int $id):bool;

 public function delete(int $id):bool;
}