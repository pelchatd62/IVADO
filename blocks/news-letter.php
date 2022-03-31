<section class="content__section news-letter">
    <div class="wrapp both">
        <h2><?php // echo get_field('archive_blog','option')['news_letter']['title'] ; ?></h2>
        <div class="container">
        
                        <p><?php _e('Newsletter','footer-treize') ?></p>
                        
                        <h3><?php  _e("Our latest opportunities in your inbox, once a month!", "newsletter") ?></h3>
                        <?php if( ICL_LANGUAGE_CODE == "fr") {
                        echo "<a class='btn ivado' id='submit-news-letter-btn' href='https://ivado.ca/abonnement-a-notre-infolettre/'><span class='label'>";
                    } else {
                        echo "<a class='btn ivado' id='submit-news-letter-btn' href='https://ivado.ca/en/subscribe-to-our-newsletter/'><span class='label'>";
                    }?>
                        <?php  _e("Subscribe", "newsletter") ?>
                </span></a>
                        <div class="background lozad not-hidden" data-background-image="<?php echo get_field('footer','option')['news_letter_back']['sizes']['article-media'] ;?>" ></div>
                    
            <!-- <p><?php // echo get_field('archive_blog','option')['news_letter']['subtitle'] ; ?></p>
            <?php //gravity_form(8, false, false, false, '', true ); ?>
                <form action="https://ivado.us12.list-manage.com/subscribe/post?u=359651550d6f665acc7ca634a&amp;id=8da5f047d2" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <div class="news-form">
                        <input type="email" placeholder="<?php // _e('Email','treize'); ?>" name="EMAIL" class="required email" id="mce-EMAIL">
                    </div>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_359651550d6f665acc7ca634a_8da5f047d2" tabindex="-1" value=""></div>
                </form> -->
            <!-- <div class="btn ivado" id="submit-news-letter-btn">
                <div class="label"><?php // _e('Subscribe', 'news-letter-treize') ; ?>
                </div>
            </div> -->
        </div>
        
    </div>
</section>