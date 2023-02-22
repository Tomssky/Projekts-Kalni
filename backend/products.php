<?php

class products {

    function getProducts($access = false){

    global $db, $auth;

    $query = 'SELECT p.*, i.image
    FROM products p 
    LEFT JOIN images AS i ON i.product_id = p.id';

    //TODO: acces change after login
    if($access){
        $query .= ' WHERE p.access <= '. $access;
    }else{
        $query .= ' WHERE p.access <= '. $auth->access();
    }

    $products = $db->getArray($query,true);

    echo '<div class="products">';

    foreach($products AS $product){
        echo '
            <div class="product">
            <div class="image"><img src="/images/'.$product['image'].'"></div>
            <div class="title">'.$product['name'].'</div>
            <div class="details">
            <div>Cena: ' . $product['price'] . '</div>
            <div>Pieejami: '.$product['count'].'</div>
            </div>
            <button>Pirkt</button>
            </div>';
        }

        echo '</div>';
    }

}



?>