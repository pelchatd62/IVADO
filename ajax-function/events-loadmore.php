<?php 
$exclude = [];
$generated = false;
add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
while( $eventsQuery->have_posts() ) : $eventsQuery->the_post();
        include( locate_template( 'pages/archives/events/event-card.php', false, false ) );
        $exclude[] = get_the_ID();

endwhile;
if( $eventsQuery->max_num_pages > 1 ){
	include( locate_template('blocks/article_loop/load_more-events.php', false, false ) );
}
?>
