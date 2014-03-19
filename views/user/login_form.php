<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h3>Sign In </h2>
<?php 
if( isset($login_form_error) ) {
?>
<div class="form_error"><?php echo $login_form_error; ?></div>
<?php
}
?>
<form name="login" method="post" id="frmLogin" action="<?php echo PathVars::$SITE_URL ?>?c=user&m=login">
   
   <lable for="email"> Email : </lable>
   <input type="email" name="email" id="fldEmail" value="<?php echo isset($email)?$email:''; ?>" required="required"></input>
   <br/>
   <lable for="pass"> Password : </lable>
   <input type="password" name="pass" id="fldPass" value=""  required="required"></input>
   <br/>
   <lable for="rememberme"> Remember Me : </lable>
   <input type="checkbox" name="rememberme" id="fldRememberMe" value="1"></input>
   <br/>
   <input type="submit" name="signin" value="Sign In"></input>
</form>

<script type="text/javascript" src="<?php echo PathVars::$JS ?>/login.js"></script>