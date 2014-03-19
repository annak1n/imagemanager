<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="controller_container">
    <div class="dashboard_main_frame">
        <?php echo $this->loadCustomView('layouts/sidebar'); ?>
        <div class="dashboard_main_body">
            <h2> All Images </h2>
            <?php
            if (isset($li_error)) {
                ?>
                <div class="form_error"><?php echo $li_error; ?></div>
                <?php
            }
            ?>
            <div class="image_grid">
                <div class="floated_img">
                    <img src="img.jpg" alt="Some image">
                    <p>Description of above image</p>
                </div>
                <div class="floated_img">
                    <img src="img2.jpg" alt="Another image">
                    <p>Description of above image</p>
                </div>
            </div>

        </div>


    </div>

</div>
