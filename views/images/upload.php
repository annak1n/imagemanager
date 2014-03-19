<?php

?>
<div class="controller_container">
    <div class="dashboard_main_frame">
        <?php echo $this->loadCustomView('layouts/sidebar'); ?>
        <div class="dashboard_main_body">
            <form name="frmImageUpload" action="<?php echo PathVars::$SITE_URL;?>?c=images&m=upload" method="post" enctype="multipart/form-data">
<label for="file">Select Image:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Upload">
</form>

        </div>
        
    
    </div>
    
</div>
