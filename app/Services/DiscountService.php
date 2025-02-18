<?php

namespace App\Services;

use App\Exceptions\InvalidException;

class DiscountService
{
    public function calculateDiscount(array $cart)
    {
        $this->validateCartItems($cart);
        $total = $this->calculateTotal($cart);
        $discount = $this->calculateDiscountAmount($total);
    
        return $total - $discount;
    }
    
    private function validateCartItems(array $cart)
    {
        foreach ($cart as $item) {
            if (!isset($item['price'], $item['quantity']) || !is_numeric($item['price']) ||  !is_numeric($item['quantity']) || $item['quantity'] < 0) {
                throw new InvalidException('Invalid cart item: ' . json_encode($item));
            }
        }
    }
    
    private function calculateTotal(array $cart): float
    {
        return array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }
    
    private function calculateDiscountAmount(float $total)
    {
        return $total > 100 ? $total * 0.1 : $total * 0.05;
    }
   
}
