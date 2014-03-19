<?php ?>
<div class="controller_container">
    <div class="dashboard_main_frame">
        <?php echo $this->loadCustomView('layouts/sidebar'); ?>
        <div class="dashboard_main_body">
            <h2> Manage Your Account </h2>
            <?php
            if (isset($reg_form_error)) {
                ?>
                <div class="form_error"><?php echo $reg_form_error; ?></div>
                <?php
            }
            ?>
            <form name="ChangeEmail" method="post" id="frmChangeEmail" action="<?php echo PathVars::$SITE_URL ?>?c=user&m=manage">

                <lable for="email"> Email : </lable>
                <input type="email" name="email" id="fldEmail" value="<?php echo isset($email) ? $email : ''; ?>" required="required"></input>
                <br/>
                <input type="hidden" name="oldEmail" id="fldOldEmail" value="<?php echo $usEmail;?>"  required="required"></input>
                <input type="hidden" name="uid" id="fldUid" value="<?php echo $usId;?>"  required="required"></input>
                <input type="submit" name="changeEmail" value="Change your account email"></input>
            </form>

        </div>


    </div>

</div>
<script>
/* Form validation. */    
</script>