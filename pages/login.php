<?php $auth->login(); ?>

<h1>Login</h1>

<hr>
<hr>
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
          <label for="email">E-mail:</label>
          </br>
          <input type="text"  name="email" require>
          </br>
          <label for="password">Password:</label>
           </br>
          <input type="password"  name="password" require>
          </br>
          <button type="submit" id="btn" name="submit">Login</button>
     </form>
</div>