<?
include_once "include/system.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8' , name="viewport" content="width=device-width, initial-scale=1">
    </head>
<body>
<link rel='stylesheet' href='/css/style.css'>
<link rel='stylesheet' href='/css/responsive.css'>
<script src='/js/script.js'></script>
<div class="bg">
    <div class="container">
        <? include_once "theme/public_nav.php"; ?>
        <div>
        <a href="/">
         <img src="/images/logoM2.png" width="240" height="240" align="left">
        </a>
        </div>
        <div>
            <? echo $controller->page() ?>
        </div>

    </div>

</div>
</body>

</html>