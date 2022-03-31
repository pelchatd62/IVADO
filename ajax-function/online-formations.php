<?php 
    function onlineFormationsCall_handler(){
        $postIds = json_decode( stripslashes( $_POST['postIds'] ), true );
        $cardPath =  $_POST['path'];
        $initialPostNumber = 3;
        $maxIndex = count($postIds) >= $initialPostNumber ? $initialPostNumber : count($postIds);
        for( $i = 0; $i < $maxIndex; $i++ ):
            global $post;
            $post = get_post( $postIds[$i]);
            setup_postdata( $post );
            if( !empty($post) && !$post == NULL ):
                $generated = true;
                include( locate_template( $cardPath, false, false ) );
            else:
                continue;
            endif;
        endfor;
        array_splice( $postIds, 0, $maxIndex );
        if( count($postIds) > 0 ):
            $encoded = json_encode( $postIds );
            echo "<div id='hiddenQuery' data-ids='" . $encoded . "' data-count='" . count($postIds) . "'></div>";
        endif;
        wp_reset_postdata();
        die;
    }

    add_action('wp_ajax_onlineFormationsCall', 'onlineFormationsCall_handler'); // wp_ajax_{action}
    add_action('wp_ajax_nopriv_onlineFormationsCall', 'onlineFormationsCall_handler'); // wp_ajax_nopriv_{action}
?>