<?php
include_once "backend/products.php";
$products = new products();

$user_id = $auth->getLoggedInUserId();

global $db, $auth;

$total_price = 0;

if (isset($_POST['delete'])) {
    $product_id = $_POST['delete'];
    $db->delete('cart', "product_id = $product_id AND user_id = $user_id AND order_id IS NULL ", true);
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}
if (isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $product_amount = $_POST['product_amount'];
    $db->update('cart', array('product_amount' => $product_amount), "product_id = $product_id AND user_id = $user_id", true);
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}

$query = 'SELECT p.name, p.price, c.*, i.image
          FROM cart c 
          LEFT JOIN products AS p ON c.product_id = p.id
          LEFT JOIN images AS i ON c.product_id = i.product_id
          WHERE user_id = '. $user_id .' AND c.order_id IS NULL;';

$products = $db->getArray($query, true);
?>
<h1>cart</h1>
<div class="containers">
		<div class="left">
			<?php
            echo '<form method="post">';
echo '<table style="width:100%">
        <thead>
           
        </thead>
        <tbody>';   
        if (empty($products)) {
    echo "<td><p>Your cart is empty.</p></td>";
} else {
    echo '<table style="width:100%">
        <thead>
           
        </thead>
        <tbody>';
}
foreach ($products as $product) {
    $item_total = $product['price'] * $product['product_amount'];
    $total_price = $total_price + $item_total;

    echo '<tr>
            <td><img src="/images/' . $product['image'] . '" width="50" height="50"></td>
            <td>' .  $product['name']. '</td>
            <td>
                <form method="post">
                    <input type="hidden" name="product_id" value="' . $product['product_id'] . '">
                    <input type="number" name="product_amount" value="' . $product['product_amount'] . '">
                    <button type="submit" name="update">Update</button>
                </form>
            </td>
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
		</div>
		<div class="right">
        <br>
      <label>   Total price: </label>
            <?php
            echo number_format($total_price, 2);
            ?>
            $
            <br>
            <br> 
		      <form method="post">
                  <label for="name">Name:</label>
                  <br>
                  <input type="text" id="name" name="name" required minlength="3">
                  <br>

                  <label for="phone">Phone:</label>
                  <br>
                  <input type="text" id="phone" name="phone" required minlength="10">
                  <br>

                  <button type="submit" name="confirm">Confirm</button>
              </form>
		</div>
	</div>

    <?php
   
  if (isset($_POST['confirm'])) {
    $insert_query = "INSERT INTO orders
                    (total_sum, order_number, date, user_id, name, Phone_number, status)
                    VALUES 
                    ('$total_price', UUID(), NOW(), '$user_id', '{$_POST['name']}', '{$_POST['phone']}', 'Pending')";
    $auth = $db->result($insert_query);

    // Get the last inserted ID
   $last_id = mysqli_insert_id($db->conn);

    $query1 = "UPDATE cart SET order_id = '$last_id' WHERE user_id = '$user_id' AND order_id IS NULL;";
    $result = $db->result($query1);

    header('Location: myorders');
    exit;
}
?>