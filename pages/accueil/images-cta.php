<div class="title">
    <h2> <?php echo $images_cta['title']; ?> </h2>
</div>
<div class="images-cta-container">
    <?php $images = $images_cta['cta'];
    if( $images ):
        foreach( $images as $image ):
    ?>
        <div class="single-image-cta">
            <a class="image-cta-container" href="<?php echo $image['link'];?>">
                <img src="<?php echo $image['image']['sizes']['cloud-logo'] ; ?>"
                        <?php echo $image['image']['alt'] 
                        ? ' alt="' . $image['image']['alt'] . '"' 
                        : ' alt="' .__( 'Image call to action', 'treize_image_cta' ).'"'; ?>
                    >
                <div class="title-container">
                        <?php echo $image['title'] ?>
                        <span><?php echo $image['description'] ?></span>
                </div>
                <span class="fake-cta"><?php _e('Know more','treize') ; ?></span>
            </a>
        </div>
    <?php 
        endforeach;
    endif; 
    ?>
</div>