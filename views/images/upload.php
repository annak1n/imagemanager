<?php ?>
<div class="controller_container">
    <div class="dashboard_main_frame">
        <?php echo $this->loadCustomView('layouts/sidebar'); ?>
        <div class="dashboard_main_body">
            <h2> Upload new image </h2>
            <?php
            if (isset($iu_form_error)) {
            ?>
                <div class="form_error"><?php echo $iu_form_error; ?></div>
            <?php
            }
            ?>
            <form name="frmImageUpload" action="<?php echo PathVars::$SITE_URL; ?>?c=images&m=upload" method="post" enctype="multipart/form-data">
                <label for="imageFile">Please select image file : </label>
                <input type="file" name="imageFile" id="fldImageFile" required>
                <br/>
                <label for="imageTitle">Image Title : </label>
                <input type="text" name="imageTitle" id="fldImageTitle" maxlength="30" required>
                <br/>
                <input type="submit" name="imageUpload" value="Upload">
            </form>
        </div>
    </div>
</div>
