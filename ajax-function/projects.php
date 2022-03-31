<?php 
// Filtre article
function projectCall_handler(){

	function filterByTaxonomie(){
		$term = $_POST['posts'] ;
		$args['post_type'] = 'projects';
		$args['posts_per_page'] = 6;
		if($term != NULL){
			$args['tax_query'][] = array(
				'taxonomy' => 'project-type',
				'field' => 'slug',
				'terms' => (string)$term,
			);
		}
		$query = new WP_Query( $args );
		if( $query->have_posts() ):
			include( locate_template( 'pages/archives/project-loop.php', false, false ) );
		endif;
		wp_reset_postdata();
	}

	function filterByName(){
		$searchValue = $_POST['posts'] ;
		$args['post_type'] = 'projects';
		$args['posts_per_page'] = -1;
		$args['s'] = esc_attr($searchValue);
		$query = new WP_Query( $args );
		if( $query->have_posts() ):
			include( locate_template( 'pages/archives/project-loop.php', false, false ) );
		else:
			$message = __('No project was found within your research criterias', 'treize');
			include( locate_template( 'pages/archives/no-results.php', false, false ) );
		endif;
		wp_reset_postdata();
	}

	function getAllProjects(){
		$args['post_type'] = 'projects';
		$args['posts_per_page'] = 6;
		$query = new WP_Query( $args );
		if( $query->have_posts() ):
			include( locate_template( 'pages/archives/project-loop.php', false, false ) );
		endif;
		wp_reset_postdata();
	} 
	function loadMoreProjects(){
		$term = $_POST['cat'] ;
        $args = json_decode( stripslashes( $_POST['query'] ), true );
        $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
		if($term != NULL){
			$args['tax_query'][] = array(
				'taxonomy' => 'project-type',
				'field' => 'slug',
				'terms' => (string)$term,
			);
		}
        $query = new WP_Query($args);
        $maximumPage = $query->max_num_pages;
        $currentPage = $_POST['page'];
        $hasMorePages = $currentPage + 1 == $maximumPage;
       	include( locate_template( 'pages/archives/project-loop.php', false, false ) );

	}
	if( $_POST['run'] ){
		
		switch( $_POST['run'] ){
            case 'termclick':
				filterByTaxonomie();
			break;
            case 'searchCall':
				filterByName();
			break;
            case 'resetCall':
				getAllProjects();
			break;
			case 'loadMore':
				loadMoreProjects();
			break;
		}
	}
	die;
} 

add_action('wp_ajax_projectCall', 'projectCall_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_projectCall', 'projectCall_handler'); // wp_ajax_nopriv_{action}
