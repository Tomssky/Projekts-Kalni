<?php

include_once "backend/products.php";
$products = new products();
?>
<h1>Catalog</h1>

<hr>
<hr>
</br>

<h2>Produktu saraksts</h2>

<?php
	if (!isset($_SESSION['auth'])) {
		 echo $products->getProductsguest(); 
	} else {
		 echo $products->getProducts(); 
	}
?>
