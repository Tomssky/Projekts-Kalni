<?php
include_once "backend/products.php";
$products = new products();

$user_id = $auth->getLoggedInUserId();

global $db, $auth;

?>
<h1>My orders</h1>
