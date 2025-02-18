<?php

namespace App\Services;

use App\Dto\EventDto;
use App\Dto\TicketDto;
use App\Dto\UserDto;
use App\Exceptions\IncorrectCredential;
use App\Interfaces\EventInterface;
use App\Interfaces\TicketInterface;
use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\Auth;

class TicketService
{

    public function __construct(private readonly TicketInterface $ticketInterface,private readonly EventService $eventService) {}


    public function purchaseTicket($request)
    {

        $this->eventService->checkTicketCountAvailable($request->event_id,$request->count);
        $request->merge(['user_id' => Auth::id()]);
        $ticketDto = TicketDto::fromRequest($request);
        return $this->ticketInterface->purchaseTicket($ticketDto);
    } 
    
   

}
