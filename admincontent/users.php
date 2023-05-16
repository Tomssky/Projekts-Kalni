<h1>Users</h1>

 <hr>
 <hr>
 </br></br>

 <?php 
    include_once "admin_nav.php";
    global $db, $auth;

        $query = 'SELECT * FROM users';

   
        $users = $db->getArray($query,true);
        echo "<br>";
        echo '<div class="products">';
        foreach($users AS $user){
            echo '
                <div class="product">
                <div class="title">'.$user['username'].'</div>
                <br>
                <div class="details">
                <div>Id: <br> ' . $user['id'] . '</div>
                <br>
                <div>Access level: <br> '.$user['access'].'</div>
                <br>
                <div>E-mail: <br> '.$user['email'].'</div>
                <br>
                <div>password: <br> '.$user['password'].'</div>
                <br>
                <a href="edit_user?id=' . $user['id'] . '">edit user</a>
                </div>';
     echo '</div>';
             }
 ?>



