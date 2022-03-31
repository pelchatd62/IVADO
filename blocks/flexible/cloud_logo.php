<?php $repeaterLogo = $row['cloud_logo'] ;

if ($repeaterLogo): ?>
    <?php 
    $marquise = ($row['marquise']) ? "marquise" : "";
    $go = ($row['marquise']) ? "go" : "";
    $section = ($is_footer) ? "div" : "section";
    ?>
    
    <<?php echo $section; ?> class="<?php echo $marquise; ?> content__section <?php echo $option; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>     
        <div class="wrapp both">
            <?php if( $row['title'] ) {
                echo "<h2>" . $row['title'] . "</h2>";
            } ?>
            <div class="container <?php echo $go; ?>" style="animation-duration:<?php echo $row['animation']?>s">
        <?php   foreach($repeaterLogo as $repeater):
                    $post_object = $repeater['cloud_logo'];
                    if( $post_object ): 
                        // override $post
                        $post = $post_object;
                        setup_postdata( $post );
                        $team = false; 
                        include( locate_template( 'blocks/box-logo.php', false, false ) );
                        wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
                    endif;
                endforeach; 
                foreach($repeaterLogo as $repeater):
                    $post_object = $repeater['cloud_logo'];
                    if( $post_object ): 
                        // override $post
                        $post = $post_object;
                        setup_postdata( $post );
                        $team = false; 
                        include( locate_template( 'blocks/box-logo.php', false, false ) );
                        wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
                    endif;
                endforeach; 
        ?>
            </div>
        </div>
    </<?php echo $section; ?>>

<?php 
endif; 
?>