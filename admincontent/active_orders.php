<h1>Active Orders</h1>

<hr>
<hr>
</br></br>

<?php 
include_once "admin_nav.php";
global $db, $auth;
include_once "backend/products.php";
$products = new products();
?>

<?php
// Filter options
$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';
$userIDFilter = isset($_GET['user_id']) ? $_GET['user_id'] : '';

$query = 'SELECT p.name as itemname, p.price, o.*, i.image, c.product_id, c.product_amount
            FROM orders o
            LEFT JOIN cart AS c ON c.order_id = o.id
            LEFT JOIN products AS p ON c.product_id = p.id
            LEFT JOIN images AS i ON c.product_id = i.product_id';

if (isset($_POST['cancel_order'])) {
    $order_id = $_POST['cancel'];
    $status = 'cancelled';

    $dataArray = array(
        'status' => $status
    );
    $where = "id = " . $order_id;
    if ($db->update('orders', $dataArray, $where)) {
        header("Location: active_orders");
        exit;
    } else {
        echo "Failed to cancel the order.";
    }
}

if (isset($_POST['delete_order'])) {
    $order_id = $_POST['delete'];
    
    // Delete the order and related cart items
    $where = "id = " . $order_id;
    if ($db->delete('orders', $where)) {
        $where = "order_id = " . $order_id;
        $db->delete('cart', $where);
        header("Location: active_orders");
        exit;
    } else {
        echo "Failed to delete the order.";
    }
}

if (isset($_POST['update_order'])) {
    $order_id = $_POST['update'];
    $status = $_POST['status'];

    $dataArray = array(
        'status' => $status
    );
    $where = "id = " . $order_id;
    if ($db->update('orders', $dataArray, $where)) {
        header("Location: active_orders");
        exit;
    } else {
        echo "Failed to update the order status.";
    }
}

// Add filters
if (!empty($statusFilter)) {
    $query .= ' WHERE o.status = "'.$statusFilter.'"';
    if (!empty($userIDFilter)) {
        $query .= ' AND o.user_id = "'.$userIDFilter.'"';
    }
} else if (!empty($userIDFilter)) {
    $query .= ' WHERE o.user_id = "'.$userIDFilter.'"';
}

$query .= ' ORDER BY o.id DESC';

$products = $db->getArray($query, true);
//unique order ids
$order_ids = array_unique(array_column($products, 'id'));

    ?>
    <form method="GET" style="margin-top: 20px;">
    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="">All</option>
        <option value="pending" <?php if ($statusFilter == 'pending') echo 'selected'; ?>>Pending</option>
        <option value="on-hold" <?php if ($statusFilter == 'on-hold') echo 'selected'; ?>>On hold</option>
        <option value="finished" <?php if ($statusFilter == 'finished') echo 'selected'; ?>>Finished</option>
        <option value="Cancelled" <?php if ($statusFilter == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
    </select>

    <label for="user_id">User ID:</label>
    <input type="number" name="user_id" id="user_id" value="<?php echo $userIDFilter; ?>">
    <button type="submit">Apply Filters</button>
</form>
<?php
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
                Order date: <br>
                <?php echo $order_product['date']; ?>
            </div>
            <br>
             <div class="label">
                Status: <br>
                <?php echo $order_product['status']; ?>   
                <form method="POST" style="margin-top: 20px;">
                    <input type="hidden" name="update" value="<?php echo $order_id; ?>">
                    <select name="status" id="status">
                        <option value="pending" <?php if ($order_product['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                        <option value="on-hold" <?php if ($order_product['status'] == 'on-hold') echo 'selected'; ?>>On hold</option>
                        <option value="finished" <?php if ($order_product['status'] == 'finished') echo 'selected'; ?>>Finished</option>
                        <option value="cancelled" <?php if ($order_product['status'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                    </select>
                    <button type="submit" name="update_order">Update</button>
                </form>
            </div>
            <form method="POST" style="margin-top: 20px;">
                <input type="hidden" name="cancel" value="<?php echo $order_id; ?>">
                <button type="submit" name="cancel_order" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel Order</button>

                <input type="hidden" name="delete" value="<?php echo $order_id; ?>">
                <button type="submit" name="delete_order" onclick="return confirm('Are you sure you want to delete this order?')">Delete Order</button>
            </form>
        </div>
        <div class="righta">

            <table style="display:inline-block;">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Product Name</th>
                        <th>Price for One</th>
                        <th>Price</th>
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
            <div style>
            <div class="label">
                Name: <br>
                <?php echo $order_product['name']; ?>
            </div>
            <br>
            <div class="label">
                id: <br>
                <?php echo $order_product['user_id']; ?>
            </div>
            <br>
             <div class="label">
                number: <br>
                <?php echo $order_product['phone_number']; ?>
            </div>
            </div>
        </div>
    </div>
    <?php endforeach; 
 ?>