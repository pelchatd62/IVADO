<?php 
    function calendarEvents_handler(){
        if($_POST['run'] == 'search'){
            searchEvents();
        }
        else if($_POST['run'] == 'todayEvents'){
            loadTodayEvents();
        }
        else{
            if($_POST['page']){
                loadPagedEvents();
            }else{
                loadEvents();
            }
        }
        die;
    }
    function loadTodayEvents(){
        $format = 'l d F';

        $day = $_POST['day'];
        $year = $_POST['year'];
        $month = $_POST['month'] + 1;

        $d = $year.'-'.$month.'-'.$day;

        $date = date_i18n($format, strtotime($d));

        $eventIds = $_POST['eventIds'];
        if(empty($eventIds)){
            $eventIds = array(-1);
        }
        $events = array(
            'posts_per_page' => -1,
            'post_type'     => 'events',
            'post__in' => $eventIds,
        );
        $eventsQuery = new WP_Query( $events );
        include( locate_template( 'pages/archives/events/daily-event.php', false, false ) );
        wp_reset_postdata();
    }

    function loadPagedEvents(){
        add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
        $args = json_decode( stripslashes( $_POST['query'] ), true );
        $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
        $cat = $_POST['cat'];
        $order = $_POST['order'];
        if (isset($cat) && $cat != '')
        {
            $args['tax_query'][] =  array(
                'taxonomy' => 'event-type',
                'field' => 'slug',
                'terms' => $cat
            );
        }
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

        $args['meta_query'][] = $meta_query;
        $args['post__in'] = $order;
        $args['orderby']= 'post__in';
        $args['posts_per_page'] = 4;

        $eventsQuery = new WP_Query($args);
        $maximumPage = $eventsQuery->max_num_pages;
        $currentPage = $_POST['page'];
        $hasMorePages = $currentPage + 1 == $maximumPage;
        include( locate_template( 'ajax-function/events-loadmore.php', false, false ) );

    }
    function searchEvents(){
        add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
        $cat = $_POST['cat'];
        $order = $_POST['order'];
        $searchValue = $_POST['searchValue'];
        $tax_query[]  = array(
            'taxonomy' => 'event-type',
            'field'    => 'slug',
            'terms'    => array('mooc'),
            'operator'  => 'NOT IN',
        );
        $args1 = array(
            'posts_per_page' => -1,
            'fields' => 'ids',
            'post_type'     => 'events',
            's' => $searchValue,
            'tax_query' => $tax_query,
            'post__in' => $order,
            'orderby' => 'post__in'
        );
        if($searchValue != ""){
            $q1 = get_posts($args1);
        }else{
            $q1 = array();
        }
       
        $allPosts = $q1;
        $events = get_posts(array(
            'post_type' => 'events',
            'post__in' => $allPosts,
            'post_status' => 'publish',
            'posts_per_page' => -1
        ));
        if( !empty($allPosts) ) : 
            foreach( $events as $event ) :
                global $post;
                $post = $event;
                setup_postdata( $post );
                // the_title();
                include( locate_template( 'pages/archives/events/event-card.php', false, false ) );
                endforeach; 
                wp_reset_postdata();
            else:    
                $message = __('No event was found within your research criterias','treize') ;
                include( locate_template( 'pages/archives/no-results.php', false, false ) );
        endif;
    }

    function loadEvents(){
        add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
        $cat = $_POST['cat'];
        $order = $_POST['order'];
        $tax_query[]  = array(
                'taxonomy' => 'event-type',
                'field'    => 'slug',
                'terms'    => array('mooc'),
                'operator'  => 'NOT IN'
            );

        if (isset($cat) && $cat != '')
        {
            $tax_query[] =  array(
                    'taxonomy' => 'event-type',
                    'field' => 'slug',
                    'terms' => $cat
                );
        }

        $events = array(
            'posts_per_page' => 4,
            'post_type'     => 'events',
            'tax_query' => $tax_query,
            'meta_query' => array(
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
            ),
            'post__in' => $order,
            'orderby' => 'post__in'
        );
        $eventsQuery = new WP_Query($events);
        include( locate_template( 'ajax-function/events-loadmore.php', false, false ) );
        if( $eventsQuery->have_posts() ):
        else:
            $message = __('No event was found within your research criterias','treize') ;
            include( locate_template( 'pages/archives/no-results.php', false, false ) );
        endif;
        wp_reset_postdata();
    }

    add_action('wp_ajax_calendarEvents', 'calendarEvents_handler'); // wp_ajax_{action}
    add_action('wp_ajax_nopriv_calendarEvents', 'calendarEvents_handler'); // wp_ajax_nopriv_{action}
?>