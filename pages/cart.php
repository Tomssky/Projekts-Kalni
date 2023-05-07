<?php

include_once "backend/products.php";
$products = new products();
?>
<h1>cart</h1>

<hr>
<hr>
</br>

<h2>cart</h2>
<?php
    global $db, $auth;

    if (isset($_POST['delete'])) {
        $product_id = $_POST['delete'];
        $db->delete('cart', "product_id = $product_id", true);
        // Redirect to the same page to avoid resubmitting the form
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }

    $query = 'SELECT p.name, p.price, c.*, i.image
                FROM cart c 
                LEFT JOIN products AS p ON c.product_id = p.id
                LEFT JOIN images AS i ON c.product_id = i.product_id;';

    $products = $db->getArray($query, true);

    echo '<form method="post">';
    echo '<table style="width:100%">
            <thead>
              <tr>

                    <th>Image</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Unit price</th>
                    <th>Item total</th>
                    <th>Delete</th>

              </tr>
            </thead>
            <tbody>';
    foreach ($products as $product) {
        $item_total = $product['price'] * $product['product_amount'];
        echo '<tr>
                <td><img src="/images/' . $product['image'] . '" width="50" height="50"></td>
                <td>' .  $product['name']. '</td>
                <td>' .  $product['product_amount']. '</td>
                <td>' .  $product['price']. '$</td>
                <td>' . $item_total . '$</td>
                <td>  
                    <form method="post">
                        <input type="hidden" name="delete" value="' . $product['product_id'] . '">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>';
    }
    echo '</tbody>
        </table>';
    echo '</form>';
?>