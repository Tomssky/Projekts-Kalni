<?php $auth->login(); ?>

<h1>Login</h1>

<hr>
<hr>
<div class="chop">
     <img src="/images/chop.png" width="50" height="440" align="left">
     <img src="/images/chop.png" width="50" height="440" align="left">
</div>
<div class="chop">
     <img src="/images/chop.png" width="50" height="440" align="right">
     <img src="/images/chop.png" width="50" height="440" align="right">
</div>
<div class="center">
     <form name="frmUser" action="" method="POST">
          
     <? if(count($auth->messages) > 0): ?>
          <div class="message">
               <ul>
               <? foreach($auth->messages AS $message): ?>
                    <li><?=$message?></li>
               <? endforeach; ?>
               </ul>
          </div>
          <? endif; ?>

          <input type="text" placeholder="e-pasts" name="email" require>
          </br>
          <input type="password" placeholder="Parole" name="password" require>
          </br>
          <button type="submit" id="btn" name="submit">Login</button>
     </form>
</div>