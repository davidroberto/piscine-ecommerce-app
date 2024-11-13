<?php

declare(strict_types=1);

require_once('Order.php');

class OrderRepository
{

    public function persistOrder(Order $order): void {
        session_start();
        $_SESSION['order'] = $order;
    }

    public function findOrder(): Order {
        session_start();
        return $_SESSION['order'];
    }

}