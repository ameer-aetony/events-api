<?php

namespace App\Interfaces;

use App\Dto\TicketDto;
use App\Models\Ticket;


interface TicketInterface {

 public function purchaseTicket(TicketDto $ticketDto):Ticket;

 
}