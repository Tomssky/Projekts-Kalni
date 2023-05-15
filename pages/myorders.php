<?php
include_once "backend/products.php";
$products = new products();

$user_id = $auth->getLoggedInUserId();

global $db, $auth;

?>
<h1>My orders</h1>
<br>
<br>
<br>
<br>


<?php

$query = 'SELECT p.name as itemname, p.price, o.*, i.image, c.product_id, c.product_amount
            FROM orders o
            LEFT JOIN cart AS c ON c.order_id = o.id
            LEFT JOIN products AS p ON c.product_id = p.id
            LEFT JOIN images AS i ON c.product_id = i.product_id
            WHERE o.user_id =  '. $user_id .' AND o.status = "pending";' ;

if (isset($_POST['delete_order'])) {
    $status = 'cancelled';
    $order_id = $_POST['delete_order'];

    $dataArray = array(
        'status' => $status
    );
    $where = "id = " . $order_id;
    if ($db->update('orders', $dataArray, $where)) {
        header("Location: myorders");
        exit;
    } else {
        echo "Failed to update product.";
    }
}

$products = $db->getArray($query, true);
//unique order ids
$order_ids = array_unique(array_column($products, 'id'));

if (empty($order_ids)) {
    echo '<div class="contain">
   <h2> No orders found. </h2>
    </div>';
} else {
    foreach ($order_ids as $order_id):
        // Find the first product with the current order id
        $order_product = current(array_filter($products, function($product) use ($order_id) {
            return $product['id'] == $order_id;
        }));
?>
<div class="myorders">
    <div class="myorder">
        <div class="lefta">
            <div class="label">Order: <br> <?php echo $order_product['order_number']; ?></div>
            <br>
            <div class="label">
                Total price: <br>
                <?php echo number_format($order_product['total_sum'], 2); ?>$
            </div>
            <br>
            <div class="label">
                order date: <br>
                <?php echo $order_product['date']; ?>
            </div>
            <br>
             <div class="label">
                status: <br>
                <?php echo $order_product['status']; ?>
            </div>
            <form method="POST" style="margin-top: 20px;">
                <input type="hidden" name="delete_order" value="<?php echo $order_id; ?>">
                <button type="submit" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel Order</button>
            </form>
        </div>
        <div class="righta">
            <div>Ordered Items:</div>
            <table style="display:inline-block;">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Product Name</th>
                        <th>price for one</th>
                        <th>price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <?php
                            $item_total = $product['price'] * $product['product_amount'];
                            if ($product['id'] == $order_id): ?>
                            <tr>
                                <td><img src="/images/<?php echo $product['image']; ?>" width="50" height="50"></td>
                                <td><?php echo $product['product_amount']; ?></td>
                                <td><?php echo $product['itemname']; ?></td>
                                <td><?php echo $product['price']; ?>$</td>
                                <td><?php echo $item_total ?>$</td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endforeach; 
}?>