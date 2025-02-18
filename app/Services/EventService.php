<?php

namespace App\Services;

use App\Dto\EventDto;
use App\Exceptions\InsufficientTicketException;
use App\Http\Resources\EventResource;
use App\Interfaces\EventInterface;

class EventService
{

    public function __construct(private readonly EventInterface $eventInterface) {}


    public function all($request)
    {
        $events = $this->eventInterface->all($request);
        return EventResource::collection($events);
    }
    
    public function getById($id)
    {
        $event = $this->eventInterface->findEventOrFail($id);
        return new EventResource($event);
    }

    public function create($request)
    {
        $eventDto = EventDto::fromRequest($request);
        return $this->eventInterface->create($eventDto);
    }

    public function update($request, $id)
    {
        $eventDto = EventDto::fromRequest($request);
        return $this->eventInterface->update($eventDto, $id);
    }

    public function delete($id)
    {
        return $this->eventInterface->delete($id);
    }

    public function checkTicketCountAvailable($id,$count):bool
    {
        $event = $this->eventInterface->findEventOrFail($id);
        $event->lockForUpdate();
        if($event->ticket_count < $count)
        {
            throw new InsufficientTicketException("Insufficient tickets available.");
        }
        $event->ticket_count -= $count;
        $event->save();

        $event->refresh();
        return true;
    }
}
