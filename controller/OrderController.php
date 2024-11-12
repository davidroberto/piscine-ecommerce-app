<?php

require_once('../model/Order.php');


class OrderController {


    public function createOrder() {
        $message = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (key_exists('customerName', $_POST)) {

                try {

                    // je créer une instance de la classe Order
                    // avec ces propriétés par défaut (date de création, client, montant etc)
                    $order = new Order($_POST['customerName']);

                    // je stocke la commande créée (ici dans la session, mais pourrait être en BDD)
                    // en utilisant la classe OrderRepository
                    // pour ça je l'instancie et j'utilise la méthode persist
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

        // j'instancie l'OrderRepository
        // et j'appelle la méthode findOrder qui me
        // permet de récupérer la commande actuellement en session pour l'utilisateur
        $orderRepository = new OrderRepository();
        $order = $orderRepository->findOrder();

        try {
            // j'ajoute un produit à la commande
            $order->addProduct();
            // et je la sauvegarde en BDD
            $orderRepository->persistOrder($order);
            $message = "produit ajouté";

        } catch (Exception $exception) {
            $message = $exception->getMessage();
        }

        require_once('../view/add-product-view.php');

    }


}

