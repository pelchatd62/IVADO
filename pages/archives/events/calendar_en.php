<?php
    $events = array(
        'posts_per_page' => -1,
        'post_type'     => 'events',
    );

    $eventsQuery = new WP_Query($events);
    
?>

<div class="calendar test" id="calendar" data-lang="<?php echo $clc; ?>">
    
    <div class="clear"></div>
    <div class="calendar-header">
        <button id="prev-month" class="prev">
            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/svg/chevron-gauche.svg' ?>" alt="<?php _e('Arrow left', 'carousel_left_arrow') ; ?>">
        </button>
        <div class="month-year">
                <span id="curMonth"></span>
                <span id="curYear"></span>
        </div>
        <button id="next-month" class="next">
            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/svg/chevron-droit.svg' ?>" alt="<?php _e('Arrow left', 'carousel_left_arrow') ; ?>">
        </button>
    </div>
    <div class="clear"></div>

    <div class="calendar-dates">
        <div class="days">
            <div class="day label"><?php _e('S', 'sunday-calendar-treize') ; ?></div>
            <div class="day label"><?php _e('M', 'monday-calendar-treize') ; ?></div>
            <div class="day label"><?php _e('T', 'thuesday-calendar-treize') ; ?></div>
            <div class="day label"><?php _e('W', 'wednesday-calendar-treize') ; ?></div>
            <div class="day label"><?php _e('T', 'thursday-calendar-treize') ; ?></div>
            <div class="day label"><?php _e('F', 'friday-calendar-treize') ; ?></div>
            <div class="day label"><?php _e('S', 'saturday-calendar-treize') ; ?></div>

            <div class="clear"></div>
        </div>
        <div id="months" class="months dropdown"></div>
        <div id="years" class="years dropdown"></div>
        <div id="calendarDays" class="days">
        </div>

    
    <?php
        if( $eventsQuery->have_posts() ):
            while( $eventsQuery->have_posts() ) : $eventsQuery->the_post(); ?>
                
                    
                <?php
                if( have_rows('informations')) {
                    //while(have_rows('informations')) {
                        the_row();
                        if( have_rows('date')) {
                            //while(have_rows('date')) {
                                the_row();
                                if(have_rows('plusieurs_dates')) { 
                                    while (have_rows('plusieurs_dates')) {
                                        the_row();
                                        echo "<div class='calendarEvents plusieurs'";  
                                        echo "data-event-id='" . get_the_ID() . "' ";
                                        echo "data-event-start='" . get_sub_field( "une_date") . " 00:00:00' ";
                                        echo "data-event-end='" . get_sub_field( "une_date") . " 00:00:00' ";  
                                        echo "data-event-tbd"; 
                                        echo "></div>"; 
                                    }
                                } else { ?>
                                    <div class="calendarEvents" 
                                    data-event-id="<?php echo get_the_ID() ?>"
                                    data-event-start="<?php echo get_field('informations')['date']['start_date']; ?>"
                                    data-event-end="<?php echo get_field('informations')['date']['enddate']; ?>"
                                    data-event-tbd="<?php echo get_field('informations')['date']['datetbd']; ?>"
                                    ></div>
                                <?php    
                                } 
                            //}
                        }        
                    //}
                }
                ?>
            <?php endwhile;
        endif;
        wp_reset_postdata();
    ?>
    
    
    </div>
</div>