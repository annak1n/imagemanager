<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        
?>
<h3>Register Form</h2>

<?php 
if( isset($reg_form_error) ) {
?>
<div class="form_error"><?php echo $reg_form_error; ?></div>
<?php
}
?>
<form name="register" method="post" id="frmRegister" action="<?php echo PathVars::$SITE_URL ?>?c=user&m=register">
   
   <lable for="username"> Username : </lable>
   <input type="text" name="username" id="fldUsername" value="" required="required"></input>
   <br/>
   <lable for="pass"> Password : </lable>
   <input type="password" name="pass" id="fldPass" value="<?php echo isset($username)?$username:''; ?>"  required="required"></input>
   <br/>
   <lable for="pass"> Confirm Password : </lable>
   <input type="password" name="confirmPass" id="fldConfirmPass" value=""  required="required"></input>
   <br/>
   <lable for="email"> Email : </lable>
   <input type="email" name="email" id="fldEmail" value="<?php echo isset($email)?$email:''; ?>"  required="required"></input>
   <br/>
   <input type="submit" name="signup" value="Sign Up"></input>
</form>

<script type="text/javascript" src="<?php echo PathVars::$JS ?>/register.js"></script>