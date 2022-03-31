<section class="content__section <?php echo $option; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>     
    <div class="wrapp both">
        <div class="title-description-container">
            <?php if( $row['title'] ) {
                echo "<h2 class='title-left-text'>" . $row['title'] . "</h2>";
            } ?>
            <div class="title-left-text paragraph wisi"><?php echo $row['text'] ?></div>
        </div>
    </div>
</section>