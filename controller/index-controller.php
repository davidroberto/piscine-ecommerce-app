<?php

require_once('../model/Order.php');

$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (key_exists('customerName', $_POST)) {
        $order = new Order($_POST['customerName']);


        $message = 'Commande créée';
    }
}


require_once('../view/index-view.php');