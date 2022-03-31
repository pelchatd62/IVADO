<?php $repeaterConferencier = $row['conferencier'] ;
if ($repeaterConferencier): ?>
    <section class="content__section <?php echo $option; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>     
    <a id="<?php echo $row['section_id'] ?>"></a>
        <div class="wrapp both">
            <?php if( $row['title'] ) {
                echo "<h2>" . $row['title'] . "</h2>";
            } ?>
            <div class="container">
    <?php   foreach($repeaterConferencier as $repeater):
                $post_object = $repeater['conferencier'];
                if( $post_object ): 
                
                    // override $post
                    $post = $post_object;
                    setup_postdata( $post );
                    $team = false; 
                    $conf = true;
                    $prof =  false;
                    include( locate_template( 'blocks/persons/box-conferencier.php', false, false ) );
                    wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
                endif;
            endforeach; ?>
            </div>
        </div>
    </section>

<?php 
endif; 
?>