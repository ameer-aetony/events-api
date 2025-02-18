<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
   public function __construct(private readonly EventService $eventService) {}

   public function index(Request $request)
   {
     
      $events = $this->eventService->all($request);
      return $this->sendSuccess($events, 'Events retrieved successfully');
   }

   public function show($id)
   {
      $event = $this->eventService->getById($id);
      return $this->sendSuccess($event, 'Event retrieved successfully');
   }

   public function store(EventRequest $request)
   {
      $event = $this->eventService->create($request);
      return $this->sendSuccess($event, 'Events created successfully');
   }

   public function update(EventRequest $request,$id)
   {
      $event = $this->eventService->update($request,$id);
      return $this->sendSuccess($event, 'Events updated successfully');
   }

   public function destroy($id)
   {
      $event = $this->eventService->delete($id);
      return $this->sendSuccess($event, 'Events updated successfully');
   }
}
