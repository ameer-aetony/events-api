<?php

namespace App\Services;

use App\Dto\EventDto;
use App\Dto\UserDto;
use App\Exceptions\IncorrectCredential;
use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\Auth;

class UserService
{

    public function __construct(private readonly UserInterface $userInterface) {}


    public function register($request)
    {
        $eventDto = UserDto::fromRequest($request);
        return $this->userInterface->create($eventDto);
    } 
    
    public function login($request)
    {
        $credentials = $request->validated();
        if (!Auth::attempt($credentials)) {
            throw new IncorrectCredential("The provided credentials are incorrect.");
        }
        
        $user = $request->user();
        $token = $user->createToken('auth-token')->plainTextToken;
        return ['user'=>$user,'token'=>$token];
    }


}
