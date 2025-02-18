<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseTicketRequest;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(private readonly TicketService $ticketService) {}

    public function purchase(PurchaseTicketRequest $request)
    {
      
       $events = $this->ticketService->purchaseTicket($request);
       return $this->sendSuccess($events, 'Events retrieved successfully');
    }
}
