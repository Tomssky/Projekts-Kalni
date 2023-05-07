<?php

include_once "backend/products.php";
$products = new products();
?>
<h1>Catalog</h1>

<hr>
<hr>
</br>

<h2>Produktu saraksts</h2>
<? echo $products->getProducts(); ?>


