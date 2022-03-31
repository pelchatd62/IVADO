<?php 
    if($getTaxPosts):
        echo "<h2 id='".$memberTerm->slug."' class='item-ajax'>".$memberTerm->name."</h2>";
        if(get_field('description-type', $memberTerm) && !is_page_template( 'tpl-membres-industriels.php') && !$industrielPage){
            ?>
            <div class="description-container wisi item-ajax">
                <?php echo get_field('description-type', $memberTerm); ?>
            </div>   
        
        <?php
        }
        echo "<div class='container item-ajax'>" ;   
            foreach($getTaxPosts as $taxpost):
                global $post;
                $post = $taxpost;
                setup_postdata( $post );
                include( locate_template( 'blocks/box-logo.php', false, false ) );
            endforeach;
            wp_reset_postdata();
        echo "</div>";
        $empty ++;
    endif;    
    
?>