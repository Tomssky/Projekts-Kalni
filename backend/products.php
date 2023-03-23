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

   function editcatalog($access = false){

    global $db, $auth;

    $query = 'SELECT p.*, i.image
    FROM products p 
    LEFT JOIN images AS i ON i.product_id = p.id';

    if($access){
        $query .= ' WHERE p.access <= '. $access;
    }else{
        $query .= ' WHERE p.access <= '. $auth->access();
    }

    $products = $db->getArray($query,true);

  
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
                    <th>save</th>
              </tr>
            </thead>
            <tbody>';
    foreach($products AS $product){
        echo '<tr>
                <td>' . $product['id'] . '</td>
                <td><img src="/images/'.$product['image'].'"></td>
                <td><input type="text" name="image" placeholder="' . $product['image'] . '"></td>
                <td><input type="text" name="name" placeholder="' . $product['name'] . '"></td>
                <td><input type="text" name="price" placeholder="' . $product['price'] . '"></td>
                <td><input type="text" name="count" placeholder="' . $product['count'] . '"></td>
                <td><input type="text" name="access" placeholder="' . $product['access'] . '"></td>
                <td><input type="submit" name="update" value="Save"></td>
              </tr>';
}
        echo '</tbody>
            </table>';
        if(isset($_POST['update']) && $_POST['update'] == "Save" && $_POST['id'] == $product['id']){

            $dataArray = array(
                'image' => $_POST['image'],
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'count' => $_POST['count'],
                'access' => $_POST['access']
            );
            $where = $product['id'];
            $db->update('products', $dataArray, $where, true);
            
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }
    }

}

?>