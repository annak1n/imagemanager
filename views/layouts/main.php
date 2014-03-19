<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

extract($this->viewData);
?>
<!DOCTYPE html>
<html>
    <head> 
    <!-- Load JQuery JS file - can be localize later on. -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
    <!-- Load local js from <?php echo PathVars::$JS ?> -->
    <!-- Load local css -->
    <link rel="stylesheet" media="screen" href="<?php echo PathVars::$CSS ?>/common.css" type="text/css"/>
    </head>
    <body>
        
        <div class="main_container">
            <?php if(isset($usEmail) && $usEmail != '') :?>
            <div class="head">
            <h3>Dashboard - Welcome <i><?php echo $usEmail; ?> 
                    <?php if($usIsAdmin) { ?>
                    (<span style="color: red;">Admin</span>)
                    <?php } ?>
                </i></h3>
            </div>
            <?php endif; ?>
            <?php echo $content; ?>
        </div>
    </body>
</html>