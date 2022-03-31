<?php $repeaterResearchers = $row['chercheur'] ;
if ($repeaterResearchers): ?>
<section class="content__section <?php echo $option; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>     
    <div class="wrapp both">
        <?php if( $row['title'] ) {
            echo "<h2>" . $row['title'] . "</h2>";
        } ?>
        <?php 
            if($row['sous_titre']) { ?>
                    <p class="sous-titre wisi"><?php echo $row['sous_titre'] ; ?></p>
            <?php } ?>
        <div class="container">
        <?php   foreach($repeaterResearchers as $repeater):
                $post_object = $repeater['chercheur'];
                if( $post_object ): 
                
                    // override $post
                    $post = $post_object;
                    setup_postdata( $post ); 
                    include( locate_template( 'blocks/persons/box-researcher.php', false, false ) );
                    wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
                endif;
            endforeach; ?>
        </div>
    </div>
</section>
 
<?php endif; ?>
