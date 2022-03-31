<?php 
function loadmoreArticle(){
    $postIds = json_decode(stripslashes($_POST['postIds']), true);
    $cardPath =  $_POST['path'];
    global $clc;
    $initialPostNumber = 9;
    $maxIndex = count($postIds) >= $initialPostNumber ? $initialPostNumber : count($postIds);
    for ($i = 0; $i < $maxIndex; $i++) :
        global $post;
        $post = get_post($postIds[$i]);
        setup_postdata($post);
        if (!empty($post) && !$post == NULL) :
            $generated = true;
            $blog = true;
            include(locate_template($cardPath, false, false));
            else :
                continue;
            endif;
        endfor;
        array_splice($postIds, 0, $maxIndex);
        if (count($postIds) > 0) :
            $encoded = json_encode($postIds);
            echo "<div id='hiddenQuery' data-ids='" . $encoded . "' data-count='" . count($postIds) . "'></div>";
        endif;
        wp_reset_postdata();
    }
    function filterArticle(){
        $category = $_POST["category"];
        $typeItems = $_POST["typeItems"];
        if (isset($category) && $category != '') {
            $tax_query[] =  array(
                array(
                    'taxonomy' => "category",
                    'field' => 'slug',
                    'terms' => $category,
                )
            );
        }

        $query_args = array(
            'post_type' => "post",
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
            'tax_query' => $tax_query
        );

        $initialPostNumber = 6;
        $queryAll = new WP_Query($query_args);
        $thePosts = array();

        if ($queryAll->have_posts()) :
            while ($queryAll->have_posts()) : $queryAll->the_post();
                $thePosts[] = get_the_ID();
            endwhile;
            $maxIndex = count($thePosts) >= $initialPostNumber ? $initialPostNumber : count($thePosts);
            $btnLoadMoreLabel = 'Load more projects';
            $cardNamePath = 'blocks/box-event-article.php';
            $blog = true;
            include(locate_template('blocks/article_loop/loop.php', false, false));
        endif;
    }
    // Filtre article

function articleChoiceCategroy_handler(){

	if( $_POST['run'] ){
		
		switch( $_POST['run'] ){
            case 'loadmore':
                loadmoreArticle();
				// $cat = $_POST['cat'] ;
				// add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
				// //$args = json_decode( stripslashes( $_POST['posts'] ), true );
				// $args = json_decode( stripslashes( $_POST['query'] ), true );
				// $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
				// if($cat != NULL){
				// 	$args['tax_query'][] = array(
				// 		'taxonomy' => 'category',
				// 		'field' => 'slug',
				// 		'terms' => (string)$cat,
				// 	);
				// }
				// $query = new WP_Query( $args );

				// if( $query->have_posts() ):
				// 	while( $query->have_posts() ): $query->the_post();
				// 		$generated = true;
				// 		$blog = true;
				// 		include( locate_template( 'blocks/box-event-article.php', false, false ) );
				// 	endwhile;
				// endif;

				// wp_reset_postdata();

				// if( $query->max_num_pages > 1 ){
				// 	include( locate_template('blocks/article_loop/load_more.php', false, false ) );
				// }
			break;

            case 'articleFilter':
                filterArticle();
				// $cat = $_POST['posts'] ;
				// $args['post_type'] = 'post';
				// $args['posts_per_page'] = 6;
				// if($cat != NULL){
				// 	$args['tax_query'][] = array(
				// 		'taxonomy' => 'category',
				// 		'field' => 'slug',
				// 		'terms' => (string)$cat,
				// 	);
				// }
				
				// $query = new WP_Query( $args );
				// if( $query->have_posts() ):
				// 	$blog = true;
				// 	include( locate_template( 'blocks/article_loop/loop.php', false, false ) );
				// endif;
				// wp_reset_postdata();
			break;
		}
	}
	die;
} 
add_action('wp_ajax_articleChoiceCategroy', 'articleChoiceCategroy_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_articleChoiceCategroy', 'articleChoiceCategroy_handler'); // wp_ajax_nopriv_{action}
?>
