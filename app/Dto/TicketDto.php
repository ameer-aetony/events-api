<?php

namespace App\Dto;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class TicketDto
{

    private ?int  $id;

    private int $count;

    private int $event_id;

    private int $user_id;


    public function getId()
    {
        return $this->id;
    }
    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getCount()
    {
        return $this->count;
    }
    public function setCount(int $count)
    {
        $this->count = $count;
    }

    public function getEventId()
    {
        return $this->event_id;
    }

    public function setEventId(int $event_id)
    {
        $this->event_id = $event_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
    }


    public static function fromRequest(FormRequest $request)
    {
        $ticketDto = new TicketDto();
        $ticketDto->setCount($request->input('count'));
        $ticketDto->setUserId($request->input('user_id'));
        $ticketDto->setEventId($request->input('event_id'));
        return $ticketDto;
    }

    public static function fromModel(User|Model $model)
    {
        $ticketDto = new TicketDto();
        $ticketDto->setCount($model->count);
        $ticketDto->setUserId($model->user_id);
        $ticketDto->setEventId($model->event_id);
        return $ticketDto;
    }
}
