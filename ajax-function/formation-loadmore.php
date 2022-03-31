<?php 
$exclude = [];
$generated = false;
while( $query->have_posts() ) : $query->the_post(); 
    include( locate_template( 'pages/archives/events/event-card.php', false, false ) );
    $exclude[] = get_the_ID();
endwhile;
if( $query->max_num_pages > 1 ){
	include( locate_template('blocks/article_loop/load_more-formations.php', false, false ) );
}
?>
