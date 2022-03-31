<section class="content__section <?php echo $option; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>
<?php
    if($row['choice']): ?>
    <div class="wrapp left <?php echo $row['image_complete'] ? "complete" : "" ?>">
        <div class="container two">
            <div class="media-container">
                <div class="media">
                <?php if( $row['back_image']) { ?>
                    <img class="lozad image-ratio" data-src="<?php echo $row['back_image']['sizes']['article-media'] ; ?>" alt="<?php echo $header['back_image']['alt'] ? $header['back_image']['alt'] : __('Ivado\'s image','treize'); ?>" >
                    <?php } else { ?>
                        <div class="blue-background"></div>
                    <?php } ?>
            </div>
                <div class="media">
                    <img class="lozad image-ratio" data-src="<?php echo $row['front_image']['sizes']['article-media'] ; ?>" alt="<?php echo $row['front_image']['alt'] ? $row['front_image']['alt'] : __('Ivado\'s image','treize'); ?>">
                </div>
            </div>
            <div class="content paragraph two wisi white burger-change">
                <?php echo $row['text']; ?>
            </div>
        </div>
    </div>
<?php   
    else: ?>  
    <div class="wrapp left responsive-both <?php echo $row['image_complete'] ? "complete" : "" ?>">
        <div class="container one">
            <div class="media one">
                <img class="lozad image-ratio" data-src="<?php echo $row['front_image']['sizes']['article-media'] ; ?>" alt="<?php echo $row['front_image']['alt'] ? $row['front_image']['alt'] : __('Ivado\'s image','treize'); ?>">
            </div>
            <div class="content paragraph one wisi white">
                <?php echo $row['text']; ?>
            </div>
        </div>
    </div>
<?php endif; ?>         

     
</section>