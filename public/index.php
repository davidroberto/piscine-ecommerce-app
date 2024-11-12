<?php

require_once('../controller/OrderController.php');

// récupère l'url actuelle
$requestUri = $_SERVER['REQUEST_URI'];

// découpe l'url actuelle pour ne récupérer que la fin
// si l'url demandée est "http://localhost:8888/piscine-ecommerce-app/public/test"
// $enduri contient "test"
$uri = parse_url($requestUri, PHP_URL_PATH);
$endUri = str_replace('/piscine-ecommerce-app/public/', '', $uri);
$endUri = trim($endUri, '/');


$orderController = new OrderController();

// en fonction de la valeur de $endUri on charge le bon contrôleur
if ($endUri === "create-order") {
    $orderController->createOrder();
} else if ($endUri === "add-product") {
    $orderController->addProduct();
} else {
    echo "<p>404</p>";
}
