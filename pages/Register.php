<?php $auth->register(); ?>

<h1>Register</h1>

<hr>
<hr>
<div class="center">
     <form name="frmreg" action="" method="POST">
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
          <input type="text" name="email" require>
          </br>
           <label for="username">Username:</label>
           </br>
           <input type="text" name="username" require>
           </br>
           <label for="pwd">Password:</label>
           </br>
          <input type="password" name="pwd" require>
          </br>
          <label for="pwdrepeat">Repeat password:</label>
           </br>
          <input type="password" name="pwdrepeat" require>
          </br>
          <button type="submit" name="regsubmit">Sign up</button>
     </form>
</div>