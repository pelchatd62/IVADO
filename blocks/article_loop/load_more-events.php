<?php
    $tax = $eventsQuery->tax_query;
    add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
    $array = array_diff($order, $exclude);

	$args = array(
		'tax_query' => $tax->queries,
		'post_type' => 'events',
        'posts_per_page' => -1,
        'post__in' => $array,
        'orderby' => 'post__in',
        //'post__not_in' => $exclude,
    );
	$newQuery = new WP_Query( $args );

    $serialized = json_encode( $newQuery->query_vars );
?>

<div class="load-more-container item-ajax" id="ajaxEventBtn" data-page='<?php echo $hasMorePages; ?>' data-query='<?php echo $serialized; ?>'>
    <div class="btn ivado" >
        <div class="label"><?php _e('Load More', 'load-more-treize') ; ?></div>
    </div>

</div>
 
<?php wp_reset_postdata(); ?>