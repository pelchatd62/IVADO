<section class="content__section <?php echo $option ; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>     
    <div class="wrapp both <?php echo $row['image_complete'] ? "complete" : "" ?>">
        <?php if( $row['title'] ) {
            echo "<h2>" . $row['title'] . "</h2>";
        } ?>
        <div class="container <?php echo $row['choice'] ? 'right' : '' ;  ?>">
            <div class="content paragraph wisi">
                <?php echo $row['text'] ; ?>
            </div>
            <div class="container-image">
                <img class="image image-abs-full lozad" data-src="<?php echo $row['image']['sizes']['archive-researcher'] ; ?>" alt="<?php echo $row['image']['alt'] ?  $row['image']['alt'] :  __('Ivado\'s image','treize') ; ?>" >
            </div>
        </div>
    </div>
</section>