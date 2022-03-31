<div  class="solo-project item-ajax">
    <a href="<?php the_permalink(); ?>" class="project-link" style=" background-image: url(<?php echo get_field('archive_image') ? get_field('archive_image')['url'] : get_the_post_thumbnail_url( get_the_ID(),'archive-researcher'); ?>" alt="<?php the_title(); ?>)" >
        <div class="content">
            <?php   if(get_field('name')){
                echo "<h3><span class='name'>".get_field('name')."</span><br>" .get_the_title()."</h3>";
            } else {
                echo "<h3>".get_the_title()."</h3>" ;
            }
            ?>
        </div>
        <p class="know-more"><?php _e('Show more', 'archive-projects-treize'); ?></p>

    </a>  
</div>
