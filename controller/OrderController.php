<?php

require_once('../model/Order.php');


class OrderController {


    public function createOrder() {
        $message = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (key_exists('customerName', $_POST)) {

                try {
                    $order = new Order($_POST['customerName']);
                    // stocke la commande en BDD
                    $message = 'Commande créée';
                } catch (Exception $exception) {
                    $message = $exception->getMessage();
                }

            }
        }

        require_once('../view/create-order-view.php');
    }

    public function addProduct() {

        // récupère la commande en BDD

        $message = null;

        try {
            $order->addProduct();
            $message = "produit ajouté";

        } catch (Exception $exception) {
            $message = $exception->getMessage();
        }

        require_once('../view/add-product-view.php');

    }


}

