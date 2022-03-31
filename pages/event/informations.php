<section class="content__section">
    <div class="wrapp both">
        <div class="container single-event-title-social">
            <h1><?php the_title() ; ?></h1>
            <p><?php _e("Share the event",'treize') ; ?></p>
            <div class="social">
                <a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank" onclick="window.open(this.href, 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=800,height=600'); return false;"> <i class="fab fa-facebook-f" aria-hidden="true"></i> </a>
                <a class="linkn" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>" target="_blank" onclick="window.open(this.href, 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=800,height=600'); return false;"> <i class="fab fa-linkedin-in" aria-hidden="true"></i> </a>
                <a class="twit" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink();?>" target="_blank"> <i class="fab fa-twitter"></i> </a> 
            </div>
        </div>
    </div>
</section>