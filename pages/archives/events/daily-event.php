
<div class="small-event-border">
    <div class="selected-date"><?php echo ucfirst($date);?></div>
    <div class="small-event-container">
        <div class="small-card-container">
            <?php 
                    if( $eventsQuery->have_posts() ):
                        while( $eventsQuery->have_posts() ) : $eventsQuery->the_post(); 
                            include( locate_template( 'pages/archives/events/event-card-small.php', false, false ) );
                        endwhile;
                    else: ?>
                        <h2><?php _e('No event on that date.','reset-treize') ; ?></h2>
                        <?php
                    endif;
                    wp_reset_postdata();

            ?>
        </div>
    </div>
</div>