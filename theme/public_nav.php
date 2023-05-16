<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<div class="topnav">
<?php
$access = $auth->access();
?>
    <a href="/home"><i class="fas fa-home"></i></a>
    <a href="/catalog">Catalog</a>
    <a href="/contact">Contact</a>
    <a href="/about">About</a>
     <? if($access == 1): ?>
         <a class="right" href="/login"><i class="fas fa-sign-in-alt"></i></a>
         <a class="right" href="/register"><i class="fas fa-user-plus"></i></a>
     <? elseif($access == 2): ?>
         <a class="right" href="/logout"><i class="fas fa-sign-out-alt"></i></a>
         <a class="right" href="/cart"><i class="fas fa-shopping-cart"></i></a>
         <a class="right" href="/myorders"><i class="fas fa-file-invoice"></i></a>
     <? elseif($access == 3): ?>
         <a class="right" href="/logout"><i class="fas fa-sign-out-alt"></i></a>
         <a class="right" href="/admin"><i class="fas fa-book"></i></a>
         <a class="right" href="/cart"><i class="fas fa-shopping-cart"></i></a>
         <a class="right" href="/myorders"><i class="fas fa-file-invoice"></i> </a>
     <? endif; ?>
</div>
