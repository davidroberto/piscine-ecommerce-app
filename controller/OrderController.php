<?php

declare(strict_types=1);

require_once('../model/Order.php');
require_once('../model/OrderRepository.php');


class OrderController {

    public function createOrder(): void {
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

    public function addProduct(): void {

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

    public function setShippingAddress(): void {

        // je créé une instance d'orderRepository
        // pour pouvoir utiliser ses méthodes
        $orderRepository = new OrderRepository();

        // j'utilise la méthode findOrder du repository
        // pour récupérer une commande existante
        $order = $orderRepository->findOrder();

        $message = null;

        // je vérifie et récupère les données de la requête POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (key_exists('shippingAddress', $_POST)) {

                // j'essaie de modifier ma commande avec l'adresse de livraison
                try {
                    $order->setShippingAddress($_POST['shippingAddress']);

                    $orderRepository->persistOrder($order);

                    $message = "Adresse ajoutée";

                    // si la modification echoue (parce que j'ai une exception
                    // qui apparait (commande non modifiable etc)
                } catch (Exception $exception) {
                    $message = $exception->getMessage();
                }

            }
        }

        require_once('../view/set-shipping-address-view.php');
    }


    public function pay(): void {

        $orderRepository = new OrderRepository();
        $order = $orderRepository->findOrder();

        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            try {
                $order->pay();

                $orderRepository->persistOrder($order);
                $message = "paiement effectué. On vous livrera un jour. y'a moy";

            } catch (Exception $exception) {
                $message = $exception->getMessage();
            }

        }

        require_once('../view/pay-view.php');
    }


}

