<?php

namespace App\Repositories;

use App\Dto\EventDto;
use App\Exceptions\RecordNotFound;
use App\Interfaces\EventInterface;
use App\Models\Event;


class EventRepository implements EventInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new Event();
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
     * findEventOrFail
     *
     * @param  int $id
     * @return Event
     */
    public function findEventOrFail(int $id):Event
    {
        $event = $this->model::find($id);
        if (!$event) {
            throw new RecordNotFound("Event does not exist for this ID: ", $id);
        }
        return $event;
    }
    
    /**
     * create
     *
     * @param  EventDto $eventDto
     * @return Event
     */
    public function create(EventDto $eventDto):Event
    {
        return $this->model::create([
            'name' => $eventDto->getName(),
            'description' => $eventDto->getDescription(),
            'start_date' => $eventDto->getStartDate(),
            'end_date' => $eventDto->getEndDate(),
            'ticket_count' => $eventDto->getTicketCount(),
        ]);
    }
    
    /**
     * update
     *
     * @param  EventDto $eventDto
     * @param  int $id
     * @return bool
     */
    public function update(EventDto $eventDto,int $id): bool
    {
        $event = $this->findEventOrFail($id);
        return  $event->update([
            'name' => $eventDto->getName(),
            'description' => $eventDto->getDescription(),
            'start_date' => $eventDto->getStartDate(),
            'end_date' => $eventDto->getEndDate(),
            'ticket_count' => $eventDto->getTicketCount(),
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
        $event = $this->findEventOrFail($id);
        return $event->delete();
    }
}
