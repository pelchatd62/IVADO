<div class="solo-logo item-ajax">
    <div class="image" 
        <?php if(get_field('reduction')){ $reduction = get_field('reduction');
        } else { $reduction = 100; }
        ?>
            style=" transform: scale(<?php echo $reduction/100 . ");" ?>"
    >
        <?php if(get_the_post_thumbnail_url( get_the_ID())) {
            if( $marquise = "marquise") { ?>
                <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'cloud-logo'); ?>" alt="<?php the_title(); ?>"> 
            <?php } else { ?>
                <img class="lozad" data-src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'cloud-logo'); ?>" alt="<?php the_title(); ?>"> 
            <?php }
            } ?>
    </div>
    <?php echo "<a class='title-to-show' "; 
        if( get_field('link')){ echo "target='_blank' href='" . get_field('link') . "'";
        }
        echo ">";
    ?>
        <div><h3><?php the_title(); ?></h3>
            <?php if(get_field('link')){ echo "<i class='fa fa-link' aria-hidden='true'></i>"; } ?>
        </div>
    <?php echo "</a>"; ?>
</div>