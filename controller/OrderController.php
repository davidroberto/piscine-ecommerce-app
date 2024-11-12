<?php

require_once('../model/Order.php');
require_once('../model/OrderRepository.php');


class OrderController {

    public function createOrder() {
        $message = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (key_exists('customerName', $_POST)) {

                try {
                    $order = new Order($_POST['customerName']);

                    $orderRepository = new OrderRepository();
                    $orderRepository->persistOrder($order);

                    $message = 'Commande créée';
                } catch (Exception $exception) {
                    $message = $exception->getMessage();
                }

            }
        }

        require_once('../view/create-order-view.php');
    }

    public function addProduct() {

        $message = null;

        $orderRepository = new OrderRepository();
        $order = $orderRepository->findOrder();


        try {
            $order->addProduct();

            $orderRepository->persistOrder($order);
            $message = "produit ajouté";

        } catch (Exception $exception) {
            $message = $exception->getMessage();
        }


        require_once('../view/add-product-view.php');

    }


}

