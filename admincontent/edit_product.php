
<h1>Edit product</h1>


<hr>
<hr>
</br>
</br>

 <?php 
    include_once "admin_nav.php";
 ?>
<?php 
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $where = "id = $id";
    if ($db->delete('products', $where)) {
        header("Location: edit_catalog");
        exit;
    } else {
        echo "Failed to delete product.";
    }
}

$id = $_GET['id'];
$product = $db->getArrayFirst("SELECT p.*, i.image
    FROM products p 
    LEFT JOIN images AS i ON i.product_id = p.id
    WHERE p.id = $id");
echo '<div class="center">
<form method="post">
        <input type="hidden" name="id" value="' . $product['id'] . '">
         <div class="image"><img src="/images/' . $product['image'] . '"></div>
        <br>
        <div class="details">
        Name:
            <input type="text" name="name" value="' . $product['name'] . '">
        <br>
        Price:
            <input type="number" name="price" value="' . $product['price'] . '">
        <br>
        Stock:
            <input type="number" name="count" value="' . $product['count'] . '">
        <br>
        Access:
           <select name="access">
              <option value="1" '.($product['access'] == '1' ? 'selected' : '').'>1</option>
              <option value="2" '.($product['access'] == '2' ? 'selected' : '').'>2</option>
              <option value="3" '.($product['access'] == '3' ? 'selected' : '').'>3</option>
            </select>
        <br>
        </div>
            <input type="submit" name="update" value="Update">
            <input type="submit" name="delete" value="delete">
      </form>
   </div>';

    if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $count = $_POST['count'];
    $access = $_POST['access'];

    $dataArray = array(
        'name' => $name,
        'price' => $price,
        'count' => $count,
        'access' => $access
    );
    $where = "id = $id";
    if ($db->update('products', $dataArray, $where)) {
        header("Location: edit_catalog");
        exit;
    } else {
        echo "Failed to update product.";
    }
}


?>
