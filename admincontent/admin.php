<h1>ADMIN PANEL</h1>

<hr>
<hr>
</br></br>
<?php 
    include_once "admin_nav.php";
    global $db, $auth;
    include_once "backend/products.php";
    $products = new products();
?>     
<h2> Information </h2>
</br></br></br></br>
<div>
<?php
$pendingOrderCount = 0;

// Retrieve the count of pending orders from the database
$query = 'SELECT COUNT(*) AS pending_count FROM orders WHERE status = "pending"';
$result = $db->getArray($query);
if (!empty($result)) {
    $pendingOrderCount = $result[0]['pending_count'];
}
?>

<div class="column">
   <h2>Expences:</h2>
   <br>
   <h3>Shop rent: 100,000$</h3>
   <h3>OTR: 6,000$</h3>
   <h3>storage: 32,000$</h3>
</div>
<div class="chop">
    <img src="/images/chop.png" width="50" height="440" align="left">
</div>
<div class="column">
  <?php
   echo "<h2>Pending Order count: <br>" . $pendingOrderCount . "</h2>";
   ?>  
</div>
<div class="chop">
    <img src="/images/chop.png" width="50" height="440" align="left">
</div>
<div class="column">
     <h2>Version number:</h2>
   <br>
   <h3>	2.0.0.5561</h3>
</div>
</div>