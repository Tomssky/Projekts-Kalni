<div class="topnav">
    <a href="home">Home</a>
    <a href="/catalog">Catalog</a>
    <a href="/contact">Contact</a>
    <a href="/about">About</a>
    <? if($auth->auth()): ?>
        <a class="right" href="/logout">Logout</a>
    <? else: ?>
         <a class="right" href="/login">Login</a>
         <a class="right" href="/register">register</a>
    <? endif; ?>
</div>

<img src="/images/logoM2.png" width="240" height="240" align="left">