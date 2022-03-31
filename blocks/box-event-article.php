<?php 
if($clc=="fr"){
	$date = get_the_time('j F Y');
}
 else{
    // $date = get_the_time('F j, Y');
    $date = get_the_time('F j, Y');
} 
$cats = get_the_terms(get_the_ID(),'category');
if (get_field('image_complete')) { 
    $background = get_the_post_thumbnail_url(get_queried_object_id(), 'large-size');
}
?>

<div class="solo-event-article item-ajax  <?php echo $generated ? ' generated' : ''; ?> <?php if(is_home() || is_tax('category') || $blog ) { echo "blog" ;} ?>">
    <a href="<?php the_permalink(); ?>">
        <div class="image <?php if (get_field('image_complete')) { echo "complete "; echo get_field('couleur_fond'); } ?>">
        <?php if (get_field('image_complete')) { ?>    
            <div class="background lozad not-hidden">
            <div style="background-image:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'archive-researcher') ?>)"></div>
            </div>
            <?php if( has_category() ) { ?>
                <a href="<?php echo get_term_link($cats[0]->term_id) ; ?>"><div class="category"><?php echo $cats[0]->name;?></div></a>
            <?php } ?>
        <?php } else { ?>
            <div class="background lozad not-hidden" data-background-image="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'archive-researcher') ?>"></div>
            <?php if( has_category() ) { ?>
                <a href="<?php echo get_term_link($cats[0]->term_id) ; ?>"><div class="category"><?php echo $cats[0]->name;?></div></a>
            <?php } ?>
        <?php } ?>     
        </div>
    </a>
    <a href="<?php the_permalink(); ?>">
    <div class="content">
        <div class="date"><?php echo $date; ?></div>
        <h3><?php the_title() ; ?></h3>
    </div>
    </a>
</div>