<?php

namespace App\Dto;

use App\interfaces\DtoInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class UserDto
{

    private ?int  $id;

    private string $name;

    private string $email;

    private string $password;

    private ?Carbon $created_at;

    private ?Carbon $updated_at;

    public function getId()
    {
        return $this->id;
    }
    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt(?Carbon $created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?Carbon $updated_at)
    {
        $this->updated_at = $updated_at;
    }
    public static function fromRequest(FormRequest $request)
    {
        $userDto = new UserDto();
        $userDto->setName($request->input('name'));
        $userDto->setEmail($request->input('email'));
        $userDto->setPassword($request->input('password'));
        return $userDto;
    }

    public static function fromModel(User|Model $model)
    {
        $userDto = new UserDto();
        $userDto->setId($model->id);
        $userDto->setName($model->name);
        $userDto->setEmail($model->email);
        return $userDto;
    }
}
