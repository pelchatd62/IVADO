<?php
	$tax = $query->tax_query;

	$args = array(
		'tax_query' => $tax->queries,
		'post_type' => 'projects',
		'posts_per_page' => -1,
		'post_status' => array('publish'),
        'post__not_in' => $exclude,
    );

	$newQuery = new WP_Query( $args );

	$serialized = json_encode( $newQuery->query_vars );
?>
<div class="load-more-container item-ajax" id="ajaxProjectsBtn" data-page='<?php echo $hasMorePages; ?>' data-query='<?php echo $serialized; ?>'>
    <div class="btn ivado" >
        <div class="label"><?php _e('Load More', 'load-more-treize') ; ?></div>
    </div>

</div>
 
<?php wp_reset_postdata(); ?>