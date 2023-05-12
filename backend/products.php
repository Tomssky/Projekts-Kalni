<?php

class products {

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
                </div>';

            echo '
                <form method="post">
                  <input type="hidden" name="user_id" value="'.$_SESSION['auth']['id'].'">
                  <input type="hidden" name="product_id" value="'.$product['id'].'">
                  <input type="number" name="product_amount" value="1" min="1">
                  <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>';
     echo '</div>';
             }
    }
}
if(isset($_POST['add_to_cart'])){
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $product_amount = $_POST['product_amount'];

    // Check if the item already exists in the cart
    $query = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id AND order_id IS NULL;";
    $existing_item = $db->getRow($query);
    if($existing_item){
        // Item already exists, update the quantity
        $new_quantity = $existing_item['product_amount'] + $product_amount;
        $update_query = "UPDATE cart SET product_amount = $new_quantity WHERE id = {$existing_item['id']}";
        $db->result($update_query);
        header("Location: catalog");

        // Item updated successfully, display message
        echo "<script>alert('Item quantity updated in cart');</script>";

    }else{
        // Item doesn't exist, insert a new item into the cart
        $insert_query = "INSERT INTO cart (user_id, product_id, product_amount) VALUES ($user_id, $product_id, $product_amount)";
        $auth = $db->result($insert_query);
        header("Location: catalog");

        if($auth){
            // Item added successfully, display message
            echo "<script>alert('Item added to cart');</script>";
        } else {
            // Error adding item, display message
            echo "<script>alert('Error adding item to cart');</script>";
        }
    }

    exit;
}

?>