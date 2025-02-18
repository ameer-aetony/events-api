<?php

namespace App\Dto;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class EventDto
{
    private ?int $id;
    private string $name;
    private string $description;
    private int $ticket_count ;
    private  Carbon $start_date;
    private  Carbon $end_date;

 
    public function setId(?int $id)
    {
        $this->id = $id;
    }

  
    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
         $this->name = $name;
         
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription(string $description)
    {
         $this->description = $description;
         
    }

    public function getDescription()
    {
        return $this->description;
    }

    
    public function setTicketCount(string $ticket_count)
    {
         $this->ticket_count = $ticket_count;
         
    }

    public function getTicketCount()
    {
        return $this->ticket_count;
    }

    public function setStartDate(string $start_date)
    {
         $this->start_date = Carbon::parse($start_date);
         
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function setEndDate(string $end_date)
    {
         $this->end_date = Carbon::parse($end_date);
    }

    public function getEndDate()
    {
        return $this->end_date;
    }

    public static function fromRequest(FormRequest $request)
    {
        $eventDto = new EventDto();
        $eventDto->setName($request->input('name'));
        $eventDto->setDescription($request->input('description'));
        $eventDto->setTicketCount($request->input('ticket_count'));
        $eventDto->setStartDate($request->input('start_date'));
        $eventDto->setEndDate($request->input('end_date'));
        return $eventDto;
    }

    public static function fromModel(Event|Model $model)
    {
        $eventDto = new EventDto();
        $eventDto->setId($model->id);
        $eventDto->setName($model->name);
        $eventDto->setDescription($model->description);
        $eventDto->setTicketCount($model->ticket_count);
        $eventDto->setStartDate($model->start_date);
        $eventDto->setEndDate($model->end_date);
        return $eventDto;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'ticket_count' => $this->ticket_count,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
