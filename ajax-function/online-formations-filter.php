<?php 
    function onlineFormationsFilterCall_handler(){
       $subCat = $_POST['subCat'];

        if (isset($subCat) && $subCat != '')
        {
            $tax_query[] =  array(
            array(
                'taxonomy' => 'event-type', 
                'field' => 'slug',
                'terms' => $subCat,
            ));
        } else {
            $tax_query = array(
                array(
                    'taxonomy' => 'event-type', 
                    'field' => 'slug',
                    'terms' => 'formations-en-ligne',
                ));
        }
        $events = array(
            'posts_per_page' => -1,
            'post_type'     => 'events',
            'orderby' => 'publish_date',
            'order' => 'DESC',
            'tax_query' => $tax_query,
        );
        $query = new WP_Query($events);
        $exclude = [];
        include( locate_template( 'ajax-function/online-formation-loadmore.php', false, false ) );

        die;
    }

    add_action('wp_ajax_onlineFormationsFilterCall', 'onlineFormationsFilterCall_handler'); // wp_ajax_{action}
    add_action('wp_ajax_nopriv_onlineFormationsFilterCall', 'onlineFormationsFilterCall_handler'); // wp_ajax_nopriv_{action}
?>