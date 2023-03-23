<div class="topnav">
<?php
$access = $auth->access();
?>
    <a href="/home">Home</a>
    <a href="/catalog">Catalog</a>
    <a href="/contact">Contact</a>
    <a href="/about">About</a>
     <? if($access == 1): ?>
         <a class="right" href="/login">Login</a>
         <a class="right" href="/register">register</a>
     <? elseif($access == 2): ?>
         <a class="right" href="/logout">Logout</a>
     <? elseif($access == 3): ?>
         <a class="right" href="/logout">logout</a>
         <a class="right" href="/admin">admin</a>

     <? endif; ?>
</div>
