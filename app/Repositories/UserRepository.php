<?php

namespace App\Repositories;


use App\Dto\UserDto;
use App\Exceptions\RecordNotFound;
use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }
    
    /**
     * all
     *
     * @param  Request $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function all($request): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->model::when($request->input('search'), function ($query) use ($request) {
            $searchTerm = '%' . $request->input('search') . '%';
            $query->where('name', 'like', $searchTerm);
        })->orderBy($request->sortBy[0]['key'] ?? 'id', $request->sortBy[1]['order'] ?? 'desc')->paginate($request->itemsPerPage ?? 10);
    }
    
    /**
     * findUserOrFail
     *
     * @param  int $id
     * @return User
     */
    public function findUserOrFail(int $id):User
    {
        $user = $this->model::find($id);
        if (!$user) {
            throw new RecordNotFound("User does not exist for this ID: ", $id);
        }
        return $user;
    }
    
    /**
     * create
     *
     * @param  UserDto $userDto
     * @return User
     */
    public function create(UserDto $userDto):User
    {
        return $this->model::create([
            'name' => $userDto->getName(),
            'email' => $userDto->getEmail(),
            'password' => $userDto->getPassword(),
        ]);
    }
    
    /**
     * update
     *
     * @param  UserDto $userDto
     * @param  int $id
     * @return bool
     */
    public function update(UserDto $userDto,int $id): bool
    {
        $user = $this->findUserOrFail($id);
        return  $user->update([
            'name' => $userDto->getName(),
            'email' => $userDto->getEmail(),
            'password' => $userDto->getPassword(),
        ]);
    }
    
    /**
     * delete
     *
     * @param  int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $user = $this->findUserOrFail($id);
        return $user->delete();
    }
}
