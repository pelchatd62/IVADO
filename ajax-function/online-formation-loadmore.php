<div class="wrapp both online-formation-section">				
    <div id="container-items-to-be-loaded-in">
    <?php               	
        for( $i = 0; $i < $maxIndex; $i++ ):
            global $post;
            $post = $postObjects[$i];
            setup_postdata( $post );
            include( locate_template( 	$cardNamePath, false, false ) );
        endfor;
            wp_reset_postdata(); 
            array_splice( $postObjects, 0, $maxIndex );
            if( count($postObjects) > 0 ):
                $encoded = json_encode( $postObjects );
                echo "<div id='hiddenQuery' data-ids='" . $encoded . "' data-count='" . count($postObjects) . "'></div>"; 
            endif; 
    ?>
    </div>
    <?php  
        if( count($postObjects) > 0 ):
    ?>
        <div id="loadmore">
            <div id="load-more-btn" class="btn ivado" data-path="<?php echo $cardNamePath ; ?>">
                    <div class="label"><?php echo $btnLoadMoreLabel ; ?></div>
            </div>
        </div>
    <?php endif; ?>
</div>