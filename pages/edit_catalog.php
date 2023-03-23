<?php

include_once "backend/products.php";

$products = new products();

?>



<h1>Edit catalog</h1>


<hr>
<hr>
</br>
</br>


<? echo $products->editcatalog(); ?>