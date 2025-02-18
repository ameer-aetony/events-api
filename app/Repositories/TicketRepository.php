<?php

namespace App\Repositories;

use App\Dto\TicketDto;
use App\Dto\UserDto;
use App\Exceptions\RecordNotFound;
use App\Interfaces\TicketInterface;
use App\Models\Ticket;
use App\Models\User;

class TicketRepository implements TicketInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new Ticket();
    }
    
    /**
     * purchaseTicket
     *
     * @param  Request $request
     * @return Ticket
     */
    public function purchaseTicket(TicketDto $ticketDto):Ticket
    {
       return $this->model->create(
        [
            'count'=>$ticketDto->getCount(),
            'event_id'=>$ticketDto->getEventId(),
            'user_id'=>$ticketDto->getUserId(),
        ]
       );
    }
    

}
