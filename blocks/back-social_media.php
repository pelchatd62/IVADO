<?php
    if(is_singular('events') || is_singular('projects')):
        $share = __('Share','single-event-share');
    else:
        $share = __('Share', 'general-treize') ;    
    endif;    
?>
<section>
    <div class="wrapp both">
        <div class="back-social_media">
            <div class="back">
                <a class="link" href="
                <?php 
                    if (is_singular('projects'))
                    {
                        echo get_post_type_archive_link( 'projects' );
                    }
                    else if(is_singular('post'))
                    {
                        echo get_post_type_archive_link( 'post' );
                    }
                    else if(is_singular('events'))
                    {
                        if ( ! has_term( "mooc", 'event-type' ) ) {
                            echo get_post_type_archive_link( 'events' );
                        } else {
                            echo "https://dev.treize.pro/ivadooo/talent/";
                        }
                        
                    }
                    else if(is_singular('bourse'))
                    {
                        echo get_post_type_archive_link( 'bourse' );
                    }
                ?>">
                    <div class="btn cta-back">
                        <img src="<?php assets('svg/chevron-gauche.svg');?>" alt="<?php _e('Arrow pointing left','general-treize') ?>">
                    </div>
                    <?php   
                    if (is_singular('projects'))
                    {
                        echo __('Back to search projects','back-to-archive-treize' );
                    }
                    else if(is_singular('post'))
                    {
                        echo __('Back to articles', 'back-to-archive-treize') ; 
                    }
                    else if(is_singular('events'))
                    {
                         
                        if ( ! has_term( "mooc", 'event-type' ) ) {
                            echo __('Back to events', 'back-to-archive-treize') ;
                        } else {
                            echo __('Back to Talent page', 'back-to-archive-treize') ;
                        }
                    }
                    else if(is_singular('bourse'))
                    {
                        echo __('Back to programs', 'back-to-archive-treize') ; 
                    }
                    else{
                        echo __('Back', 'back-to-archive-treize') ; 
                    }

                    ?>
                </a>    
            </div>
            <div class="social-media">
                <p><?php echo $share ; ?></p>
                <div class="social">
                    <a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank" onclick="window.open(this.href, 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=800,height=600'); return false;"> <i class="fab fa-facebook-f" aria-hidden="true"></i> </a>
                    <a class="linkn" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>" target="_blank" onclick="window.open(this.href, 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=800,height=600'); return false;"> <i class="fab fa-linkedin-in" aria-hidden="true"></i> </a>
                    <a class="twit" href="https://twitter.com/intent/tweet?text=<?php the_title_attribute(); ?>&url=<?php the_permalink();?>" target="_blank"> <i class="fab fa-twitter"></i> </a>  
                </div>
            </div>
        </div>			
    </div>
</section>