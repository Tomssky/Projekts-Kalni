<?php

include_once "backend/products.php";

$products = new products();

?>



<h1>Edit catalog</h1>


<hr>
<hr>
</br>
</br>



 <?php 

include_once "admin_nav.php";
echo $products->editcatalog(); 

if (isset($_POST['update'])) {
    if (!isset($_POST['id'])) {
        echo '<p>Product ID is missing</p>';
        return;
    }
exit;
}
?>