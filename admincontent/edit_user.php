<h1>Edit user</h1>


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
    if ($db->delete('users', $where)) {
        header("Location: users");
        exit;
    } else {
        echo "Failed to delete user.";
    }
}

$id = $_GET['id'];
$user = $db->getArrayFirst("SELECT * FROM users 
    WHERE id = $id");
echo '<div class="center">
<form method="post">
        <input type="hidden" name="id" value="' . $user['id'] . '">
        <div class="details">
        Id: 
        <br>
        ' . $user['id'] . '
        <br><br>
       Access:
           <select name="access">
              <option value="1" '.($user['access'] == '1' ? 'selected' : '').'>1</option>
              <option value="2" '.($user['access'] == '2' ? 'selected' : '').'>2</option>
              <option value="3" '.($user['access'] == '3' ? 'selected' : '').'>3</option>
            </select>
        <br><br>
        Name:
        <br>
            <input type="text" name="username" value="' . $user['username'] . '">
        <br><br>
        password:
        <br>
            <input type="text" name="password" value="' . $user['password'] . '">
        <br><br><br>
        </div>
            <input type="submit" name="update" value="Update">
            <input type="submit" name="delete" value="delete">
      </form>
   </div>';

    if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['username'];
    $password = $_POST['password'];
    $access = $_POST['access'];
    $pwdhash = md5($password);

    $dataArray = array(
        'username' => $name,
        'password' => $pwdhash,
        'access' => $access
    );
    $where = "id = $id";
    if ($db->update('users', $dataArray, $where)) {
        header("Location: users");
        exit;
    } else {
        echo "Failed to update user.";
    }
}

?>
