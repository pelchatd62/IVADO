<?php
// Filtre article
function resultCall_handler(){
	function getDataByTaxonomie(){
		$args['tax_query'] = array(
			'relation' => 'AND',
		);
		$args['post_type'] = 'resultat';
		$args['posts_per_page'] = -1;
		$getProgram = false;
		$getYear = false;
        $years = get_terms('annee');
        $programmes = get_terms('programme');
		foreach( $_POST['selects'] as $key => $value ):
			if( $value != null ){
				if($key == 'programme'){
					$getProgram = true;
					$getTermProg = $value;
				}
				if($key == 'annee'){
					$getYear = true;
				}
				$args['tax_query'][] = array(
					'taxonomy' => (string)$key,
					'field' => 'slug',
					'terms' => (string)$value,
				);
			} else {
				continue;
			}
		endforeach;
		// echo "year=".$getYear." programme=".$getProgram."<br>";
		$results = array();
		foreach($years as $year):
            $results[$year->slug] = array();
            foreach($programmes as $programme):
                $results[$year->slug][$programme->slug] = array();
            endforeach;    
        endforeach;	
		$postslist = get_posts( $args );
		if($postslist){
			foreach($postslist as $result):
				global $post;
				$post = $result;
				setup_postdata( $post );
				$curYear = get_the_terms( get_the_ID(), 'annee');
				$curProgs = get_the_terms( get_the_ID(), 'programme');
				if($getProgram){
					if ( !isset( $results[ $curYear[0]->slug ][$getTermProg] ) ) $results[ $curYear[0]->slug ][$getTermProg] = array();
					$results[ $curYear[0]->slug ][$getTermProg][] = get_post( get_the_ID() );
				}else{
					foreach($curProgs as $prog):
						if ( !isset( $results[ $curYear[0]->slug ][$prog->slug] ) ) $results[ $curYear[0]->slug ][$prog->slug] = array();
						$results[ $curYear[0]->slug ][$prog->slug][] = get_post( get_the_ID() );
					endforeach;	
				}
			endforeach;
            wp_reset_postdata();
			include( locate_template( 'pages/archives/resultat-loop.php', false, false ) );
		}else{
			$message = __('No results was found within your research criterias', 'treize');
			include( locate_template( 'pages/archives/no-results.php', false, false ) ); 
		}
	}
	function getAllData (){
		$args['post_type'] = 'resultat';
		$args['posts_per_page'] = -1;
		$postslist = get_posts( $args );
        $years = get_terms('annee');
        $programmes = get_terms('programme');
		$results = array();
		foreach($years as $year):
            $results[$year->slug] = array();
            foreach($programmes as $programme):
                $results[$year->slug][$programme->slug] = array();
            endforeach;    
        endforeach;	
		if($postslist){
			foreach($postslist as $result):
				global $post;
				$post = $result;
				setup_postdata( $post );
				$curYear = get_the_terms( get_the_ID(), 'annee');
				$curProgs = get_the_terms( get_the_ID(), 'programme');
				foreach($curProgs as $prog):
					if ( !isset( $results[ $curYear[0]->slug ][$prog->slug] ) ) $results[ $curYear[0]->slug ][$prog->slug] = array();
					$results[ $curYear[0]->slug ][$prog->slug][] = get_post( get_the_ID() );
				endforeach;	
			endforeach;
			wp_reset_postdata();
			include( locate_template( 'pages/archives/resultat-loop.php', false, false ) );
		}
	}

	function dataByText(){
		$val = $_POST['posts'];
		$args['post_type'] = 'resultat';
		$args['posts_per_page'] = -1;
		$args['meta_query'] = array(
			'relation' => 'OR',
		);
		$args['meta_query'][] = array(
            array(
                'value'   => $val,
                'compare' => 'LIKE'
            ),
		);
		$postslist = get_posts( $args );
        $years = get_terms('annee');
        $programmes = get_terms('programme');
		$results = array();
		foreach($years as $year):
            $results[$year->slug] = array();
            foreach($programmes as $programme):
                $results[$year->slug][$programme->slug] = array();
            endforeach;    
        endforeach;	
		if($postslist){
			foreach($postslist as $result):
				global $post;
				$post = $result;
				setup_postdata( $post );
				$curYear = get_the_terms( get_the_ID(), 'annee');
				$curProgs = get_the_terms( get_the_ID(), 'programme');
				foreach($curProgs as $prog):
					if ( !isset( $results[ $curYear[0]->slug ][$prog->slug] ) ) $results[ $curYear[0]->slug ][$prog->slug] = array();
					$results[ $curYear[0]->slug ][$prog->slug][] = get_post( get_the_ID() );
				endforeach;	
			endforeach;
			wp_reset_postdata();
            include( locate_template( 'pages/archives/resultat-loop.php', false, false ) );
		}else{
            $message = __('No results was found within your research criterias', 'treize');
			include( locate_template( 'pages/archives/no-results.php', false, false ) ); 
		}
	}
	
	if( $_POST['run'] ){
		switch( $_POST['run'] ){
            case 'resultsFilter':
                getDataByTaxonomie();
            break;
            case 'resetCall':
                getAllData();
            break;
            case 'searchCall':
                dataByText();
            break;
		}
	}
	die;
} 

add_action('wp_ajax_resultCall', 'resultCall_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_resultCall', 'resultCall_handler'); // wp_ajax_nopriv_{action}
