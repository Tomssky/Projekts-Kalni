<div class="topnav">
    <a href="/private">Home</a>
    <a href="/catalog">Private catalog</a>
    <a href="/contact">Contact</a>
    <a href="/about">About</a>
    <? if($auth->auth()): ?>
        <a class="right" href="/logout">Logout</a>
    <? else: ?>
        <a class="right" href="/login">Login</a>
    <? endif; ?>
</div>

<img src="/images/logoM2.png" width="240" height="240" align="left">