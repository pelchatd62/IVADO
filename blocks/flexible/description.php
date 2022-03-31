<section class="content__section <?php echo $option; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>     
<a id="<?php echo $row['section_id'] ?>"></a>
    <div class="wrapp both">
        <div class="description-container">
            <?php if( $row['title'] ) {
                echo "<h2>" . $row['title'] . "</h2>";
            } ?>
            <div class="paragraph wisi"><?php echo $row['text'] ?></div>
<?php       if($row['label']) :?> 
                <a target="_blank" href="<?php echo $row['link_choice'] ? $row['internal_link'] : $row['external_link'] ?>" class="btn description-btn ivado">
                    <div class="label"> <?php echo $row['label']?> </div> 
                </a>
<?php       endif ; ?>

        </div>
    </div>
</section>