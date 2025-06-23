<?php

namespace App\Services;

use Random\RandomException;

class OrderService
{
    public function calculateOrderTotal(array $order): float
    {
        if( empty($order['items']) ) {
            return 0.00;
        }

        $calculatedOrderTotal = array_reduce(
            $order['items'],
            function($carry, $singleItem) {
                return $carry + ($singleItem['quantity'] * $singleItem['price']);
            },
            0.00
        );

        return round($calculatedOrderTotal, 2, PHP_ROUND_HALF_UP);
    }

    /**
     * Simplifies the order items for the DB
     * @param array $order
     * @return array
     */
    public function simplifyNewOrderItems(array $order): array
    {
        if( empty($order['items']) ) {
            return [];
        }

        return array_map(function($currentItem) {
            //if id is negative, then it's a custom burger and we keep the whole array
            if( !empty($currentId) && ('-1' === $currentId || -1 === $currentItem) ) {
                return $currentItem;
            }

            //else, we just put the ID and quantity
            return [
                'id' => $currentItem['id'],
                'quantity' => $currentItem['quantity']
            ];

        }, $order['items']);
    }

    /**
     * @throws RandomException
     */
    public function generateOrderId(): string
    {
        return bin2hex(random_bytes(5));
    }
}