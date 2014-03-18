<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="controller_container">
    <h2>Welcome to Image Manager!</h2>
    <div class="left_container">
        <!-- User - Login Form -->
        <?php echo $this->loadCustomView("user/login_form"); ?>
    </div>
    <div  class="right_container">
        <!-- User - Register Form -->
        <?php echo $this->loadCustomView("user/register_form"); ?>
    </div>
<div>