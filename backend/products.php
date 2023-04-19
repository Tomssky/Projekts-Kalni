<?php

class products {

    function getProducts($access = false){

    global $db, $auth;

    $query = 'SELECT p.*, i.image
    FROM products p 
    LEFT JOIN images AS i ON i.product_id = p.id';

   //test
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

function editCatalog($access = false) {
    global $db, $auth;

    $query = 'SELECT p.*, i.image
        FROM products p 
        LEFT JOIN images AS i ON i.product_id = p.id';

    if ($access) {
        $query .= ' WHERE p.access <= ' . $access;
    } else {
        $query .= ' WHERE p.access <= ' . $auth->access();
    }

    $products = $db->getArray($query, true);

    echo '<form method="post">';
    echo '<table style="width:100%">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>image</th>
                    <th>image name</th>
                    <th>name</th>
                    <th>price</th>
                    <th>stock</th>
                    <th>access</th>
                    <th>edit</th>
              </tr>
            </thead>
            <tbody>';
    foreach ($products as $product) {
        echo '<tr>
                <td>' . $product['id'] . '</td>
                <td><img src="/images/' . $product['image'] . '"></td>
                <td>' .  $product['image'] . ' </td>
                <td>' .  $product['name']. '</td>
                <td>' .  $product['price']. '</td>
                <td>' .  $product['count']. '</td>
                <td>' .  $product['access']. '</td>
                <td>   
                    <a href="edit_product?id=' . $product['id'] . '">edit</a>
                </td>
              </tr>';
    }
    echo '</tbody>
        </table>';
    echo '</form>';

        }
    }
?>