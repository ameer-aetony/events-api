<?php

namespace App\Services;

use App\Interfaces\EventInterface;

class EventService {

    public function __construct(private readonly EventInterface $eventInterface){}

    public function all($request)
    {

    }
}