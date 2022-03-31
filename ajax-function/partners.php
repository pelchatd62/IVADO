<?php
// Filtre article
function partnerCall_handler(){
    function getDataByTaxonomie(){
        add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
        $memberTerms = get_terms('members-type');
        $empty = 0;
        $pageMembers = $_POST['pageMembers'];  
        if(strpos($pageMembers, 'true') !== false):
            $args['tax_query'] = array(
                'relation' => 'AND',
            );
            $args['post_type'] = 'partners';
            $args['posts_per_page'] = -1;
            $args['order'] = 'ASC';
            $args['orderby'] = 'title';

            
            $args['tax_query'][] = array(
                'relation' => 'AND',
            );
            foreach( $_POST['selects'] as $key => $value ):
                if($value == 'all') {
                        $value = '';
                    }
                if( $value != null ){
                    $args['tax_query'][] = array(
                        'taxonomy' => (string)$key,
                        'field' => 'slug',
                        'terms' => (string)$value,
                    );
                } else {
                    continue;
                }
            endforeach;
            $args['tax_query'][] = array(
                array(
                    'taxonomy' => 'members-type',
                    'field'    => 'slug',
                    'terms'    => array('membres-industriels'),
                ),
            );
            $memberId = 45;
            $memberTerm = get_term($memberId, $taxonomy );
            $getTaxPosts = get_posts($args);
            $industrielPage = true;
            include( locate_template( 'pages/archives/partners/partner-loop.php', false, false ) );
            if($empty == 0):
                $message = __('No member was found within your research criterias', 'treize');
                include( locate_template( 'pages/archives/no-results.php', false, false ) ); 
            endif;
        else:  
            foreach($memberTerms as $memberTerm):
                $args['tax_query'] = array(
                    'relation' => 'AND',
                );
                $args['post_type'] = 'partners';
                $args['posts_per_page'] = -1;
                foreach( $_POST['selects'] as $key => $value ):
                    if($value == 'all') {
                        $value = '';
                    }
                    if( $value != null ){
                        $args['tax_query'][] = array(
                            'taxonomy' => (string)$key,
                            'field' => 'slug',
                            'terms' => (string)$value,
                        );
                    } else {
                        continue;
                    }
                endforeach;
                $args['tax_query'][] = array(
                    'taxonomy' => 'members-type',
                    'field' => 'slug',
                    'terms' => (string)$memberTerm->slug,
                );
                $args['tax_query'][] = array(
                    'taxonomy' => 'members-type',
                                        'field'    => 'slug',
                                        'terms'    => array('autres'),
                                        'operator'  => 'NOT IN'
                );
                $getTaxPosts = get_posts($args);
                include( locate_template( 'pages/archives/partners/partner-loop.php', false, false ) );   
            endforeach; 
            if($empty == 0){
                $message = __('No member was found within your research criterias', 'treize');
                include( locate_template( 'pages/archives/no-results.php', false, false ) ); 
            }  
        endif;     
         
            
    }
    
    function getAllMembers(){
        $memberTerms = get_terms('members-type');
        foreach($memberTerms as $memberTerm):
            add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
            $args = array(
                'post_type' => 'partners',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'orderby' => 'title',
            );
            $args['tax_query'][] = array(
                array(
                    'taxonomy' => 'members-type',
                    'field'    => 'slug',
                    'terms'    => array($memberTerm->slug),
                ),
            );
            $args['tax_query'][] = array(
                'taxonomy' => 'members-type',
                                    'field'    => 'slug',
                                    'terms'    => array('autres'),
                                    'operator'  => 'NOT IN'
            );
            $getTaxPosts = get_posts($args);
            include( locate_template( 'pages/archives/partners/partner-loop.php', false, false ) );  
        endforeach;
    } 

    function getAllMembersIndustriel(){
        add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
        $args = array(
            'post_type' => 'partners',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'title',
        );
        $args['tax_query'][] = array(
            array(
                'taxonomy' => 'members-type',
                'field'    => 'slug',
                'terms'    => array('membres-industriels'),
            ),
        );
        $getTaxPosts = get_posts($args);
        include( locate_template( 'pages/archives/partners/partner-loop.php', false, false ) );  
    } 
    
    function filterByName(){
        $empty = 0;
        $searchValue = $_POST['posts'] ;
		$args['post_type'] = 'partners';
        $args['posts_per_page'] = -1;
        $args['tax_query'][] = array(
            array(
                'taxonomy' => 'members-type',
                'field'    => 'slug',
                'terms'    => array('membres-industriels'),
            ),
        );
        $args['meta_query'] = array(
            'relation' => 'OR',
        );
        
        $args['meta_query'][] = array(
            array(
                'key'     => 'description', 
                'value'   => $searchValue,
                'compare' => 'LIKE'
            ),
        );
        $args['meta_query'][] = array(
            array(
                'key'     => 'title_search', 
                'value'   => $searchValue,
                'compare' => 'LIKE'
            ),
        );
        $getTaxPosts = get_posts($args);
        $memberTerm = get_term(37,'members-type');
        $industrielPage = true;
        include( locate_template( 'pages/archives/partners/partner-loop.php', false, false ) ); 
        if($empty == 0){
            $message = __('No member was found within your research criterias', 'treize');
        }   
        include( locate_template( 'pages/archives/no-results.php', false, false ) );
	}

	if( $_POST['run'] ){
		switch( $_POST['run'] ){
            case 'partnerFilter':
                getDataByTaxonomie();
            break;
            case 'resetCall':
				getAllMembers();
            break;
            case 'searchCall':
				filterByName();
			break;
            case 'resetCallIndustriel':
				getAllMembersIndustriel();
			break;
		}
	}
	die;
} 

add_action('wp_ajax_partnerCall', 'partnerCall_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_partnerCall', 'partnerCall_handler'); // wp_ajax_nopriv_{action}
?>
