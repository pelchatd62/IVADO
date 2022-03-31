<?php 
    function formationsCall_handler(){

        $run = $_POST['run'];

        if($run == 'init'){
            initData();
        }else{
            loadMore();
        }

        die;
    }

    function loadMore(){
        add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
       // $args = json_decode( stripslashes( $_POST['query'] ), true );
        

        $cat = $_POST['cat'];
        if (isset($cat) && $cat != '')
        {
            $tax_query[] =  array(
            array(
                'taxonomy' => 'event-type', 
                'field' => 'slug',
                'terms' => $cat,
            ));
        } else {
            $tax_query = array(
                array(
                    'taxonomy' => 'event-type', 
                    'field' => 'slug',
                    'terms' => 'formations',
                ));
        }

        $order = $_POST['order'];
        $meta_query = array(
            'relation' => 'OR',
            array(
                'key' => 'informations_date_enddate',
                'value' => date('Ymd'),
                'type' => 'DATE',
                'compare' => '>',
            ),
            array(
                'key' => 'informations_date_datetbd',
                'value' => '1',
                'compare' => '=',
            ),
        );




        $events = array(
            'posts_per_page' => 3,
            'post_type'     => 'events',
            'orderby' => 'publish_date',
            'order' => 'DESC',
            'tax_query' => $tax_query,
        );

        $events['meta_query'][] = $meta_query;
        $events['post__in'] = $order;
        $events['orderby']= 'post__in';
        $events['posts_per_page'] = 3;
        $events['paged'] = $_POST['page'] + 1; // we need next page to be loaded

        $query = new WP_Query($events);

        $maximumPage = $query->max_num_pages;
        $currentPage = $_POST['page'];
        $hasMorePages = $currentPage + 1 == $maximumPage;
        if( $query->have_posts() ):

            include( locate_template( 'ajax-function/formation-loadmore.php', false, false ) );
                //include( locate_template( 'pages/archives/events/event-card.php', false, false ) );

		else:
			$message = __('No event was found within your research criterias','treize') ;
			include( locate_template( 'pages/archives/no-results.php', false, false ) );
		endif;

        wp_reset_postdata();
    }

    function initData(){
        add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
        $order = $_POST['order'];
        $meta_query = array(
            'relation' => 'OR',
            array(
                'key' => 'informations_date_date_limite',
                'value' => date('Ymd'),
                'type' => 'DATE',
                'compare' => '>',
            ),
            array(
                'key' => 'informations_date_datetbd',
                'value' => '1',
                'compare' => '=',
            ),
        );
        $events = array(
            'posts_per_page' => 3,
            'post_type'     => 'events',
            'post__in' =>  $order,
            'orderby' => 'post__in',
            'post_status' => array('publish'),
            'tax_query' => array(
            array(
                'taxonomy' => 'event-type', 
                'field' => 'slug',
                'terms' => 'formations',
            )),
        );

       $events['meta_query'][] = $meta_query;

        $query = new WP_Query($events);
        $exclude = [];
        include( locate_template( 'ajax-function/formation-loadmore.php', false, false ) );
        wp_reset_postdata();
    }

    add_action('wp_ajax_formationsCall', 'formationsCall_handler'); // wp_ajax_{action}
    add_action('wp_ajax_nopriv_formationsCall', 'formationsCall_handler'); // wp_ajax_nopriv_{action}
?>