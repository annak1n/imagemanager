<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h3>Sign In </h2>
<?php 
if( isset($reg_form_error) ) {
?>
<div class="form_error"><?php echo $reg_form_error; ?></div>
<?php
}
?>
<form name="login" method="post" id="frmLogin" action="<?php echo PathVars::$SITE_URL ?>?c=user&m=login">
   
   <lable for="username"> Username : </lable>
   <input type="text" name="username" id="fldUsername" value="" required="required"></input>
   <br/>
   <lable for="pass"> Password : </lable>
   <input type="password" name="pass" id="fldPass" value="<?php echo isset($username)?$username:''; ?>"  required="required"></input>
   <br/>
   <lable for="rememberme"> Remember Me : </lable>
   <input type="checkbox" name="rememberme" id="fldRememberMe" value="1"></input>
   <br/>
   <input type="submit" name="signin" value="Sign In"></input>
</form>

<script type="text/javascript" src="<?php echo PathVars::$JS ?>/login.js"></script>