<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(private readonly EventService $eventService) {}

    public function index ($request){
       
    }
}
