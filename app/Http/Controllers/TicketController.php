<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseTicketRequest;
use App\Services\DiscountService;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(private readonly TicketService $ticketService, private readonly DiscountService $discountService) {}

    public function purchase(PurchaseTicketRequest $request)
    {
      
       $events = $this->ticketService->purchaseTicket($request);
       return $this->sendSuccess($events, 'Events retrieved successfully');
    }

    public function discount(Request $request)
    {
     
       $events = $this->discountService->calculateDiscount($request);

    }
}
