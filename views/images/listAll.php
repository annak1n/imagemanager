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
            <h2> My Images </h2>
            <?php
            if (isset($li_error)) {
                ?>
                <div class="form_error"><?php echo $li_error; ?></div>
                <?php
            }
            ?>
            <div class="image_grid">
                <?php
                if(isset($images_list) && !empty($images_list)) {
                    foreach($images_list as $value) {
                ?>
                    <div class="floated_img">
                        <img src="<?php echo PathVars::$IMAGE_UPLOAD_URL.'/'.$value['i_id'].'_'.$value['i_name']?>" title="<?php echo $value['i_title']; ?>" alt="<?php echo $value['i_title']; ?>">
                        <p><?php echo $value['i_title']; ?>
                            &nbsp;&nbsp;
                            -
                            &nbsp;&nbsp;
                        <a href="/index.php?c=images&m=delete&id=<?php echo $value['i_id']; ?>&name=<?php echo $value['i_name']; ?>'">Delete</a></p>
                    </div>
                <?php
                    }
                } else {
                ?>
                    <div class="floated_img">
                        No Images uploaded.
                    </div>
                <?php
                }
                ?>
                
                
            </div>

        </div>


    </div>

</div>
