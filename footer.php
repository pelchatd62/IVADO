<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Treize
 */
$logos = get_field('footer', 'option')['logo'];
?>

	</div><!-- #content -->

<?php 
if(is_front_page()){
	echo '<section id="front-page-footer" class="footer-front-page" data-pos="5">';
}
?>
	<footer id="page__footer">
        <?php 
            if(is_front_page()){
                if ( get_field('marquise_membres_partenaires', 'option') ) {
                    $row = get_field('marquise_membres_partenaires', 'option'); 
                    $layout='cloud_logo';
                    $is_footer = true;
                    include( locate_template( 'blocks/flexible/cloud_logo.php', false, false ) );            
                }
            }                
        ?>
		<div class="wrapp both top-section">
            <div class="footer-burger-change"></div>
			<div class="blue-background"></div>
			<div class="cta-newsletter">
				<?php include( locate_template('pages/footer/cta.php', false, false) ); ?>
				<div class="newsletter">
                    <?php if( ICL_LANGUAGE_CODE == "fr") {
                        echo "<a href='https://ivado.ca/abonnement-a-notre-infolettre/'>";
                    } else {
                        echo "<a href='https://ivado.ca/en/subscribe-to-our-newsletter/'>";
                    }?>
                        <p><?php _e('Newsletter','footer-treize') ?></p>
                        
                        <h3><?php  _e("Our latest opportunities in your inbox, once a month!", "newsletter") ?></h3>
                        <h3><?php  _e("Subscribe", "newsletter") ?></h3>
                            
                        <div class="background lozad not-hidden" data-background-image="<?php echo get_field('footer','option')['news_letter_back']['sizes']['article-media'] ;?>" ></div>
                    </a>
				</div>
			</div>
		</div>
		
		<div class="wrapp both bottom-section">
			<div class="mid-section">
				<div class="left">
                    <div class="logo-and-nav">
                        <div class="logo-container">
                            <a class="site-logo" href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/svg/siteLogoWhite.svg' ?>" alt="<?php _e('Logo\'s site', 'header-treize') ; ?>"></a>
                        </div>
                        
                        <div class="nav_footer-networks">
                            <div class="nav_footer">
                                <?php wp_nav_menu( array( 'theme_location' => 'menu-2' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="lang-network">
                        <div class="language-switcher">
                            <?php custom_language_switcher();?>
                        </div> 
                        <div class="networks">
                            <a target="_blank" href="<?php echo get_field('general','option')['reseaux_sociaux']['facebook']; ?>"><i class="fab fa-facebook-f"></i></a>
                            <a target="_blank" href="<?php echo get_field('general','option')['reseaux_sociaux']['twitter']; ?>"><i class="fab fa-twitter"></i></a>
                            <a target="_blank" href="<?php echo get_field('general','option')['reseaux_sociaux']['linkedin']; ?>"><i class="fab fa-linkedin-in"></i></a>
                            <a target="_blank" href="<?php echo get_field('general','option')['reseaux_sociaux']['youtube']; ?>"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
				</div>
				<div class="right">
					<div class="logo">
						<?php  
							if($logos):
								foreach ($logos as $logo): ?>
									<div>
									<a href="<?php echo $logo['link'] ?>">
										<img class="lozad" data-src="<?php echo $logo['image']['sizes']['cloud-logo'] ?>" alt="<?php echo $logo['image']['alt'] ? $logo['image']['alt'] : 'Logo' ; ?>">
									</a>
									</div>
							<?php	endforeach;	
							endif;
						?>
					</div>
				</div>
			</div>
            <p>
                <?php 
                    if( ICL_LANGUAGE_CODE == "fr" ) {
                        echo "Politique de confidentialité : nous suivons les <strong><a href='https://secretariatgeneral.umontreal.ca/protection-et-acces-a-linformation/protection-des-renseignements-personnels/'>lignes directrices de l'Université de Montréal</a></strong>.";
                    } else {
                        echo "Privacy policy: we follow the <strong><a href='https://secretariatgeneral.umontreal.ca/protection-et-acces-a-linformation/protection-des-renseignements-personnels/'>guidelines of the Université de Montréal</a></strong>."; 
                    }
                ?>
            </p>
			<div class="copyright">
				<p>© <?php echo date("Y"); ?> IVADO</p>
				<a class="normal" target="_blank" href="https://treize.pro"><?php _e('Web Design by', 'footer-treize');?> <span>TREIZE</span></a>
			</div>
		</div>
	</footer><!-- #colophon -->
	<?php 
 if(is_front_page()){
	 echo '</section>';
 }
?>

</div><!-- #page -->

<?php wp_footer(); ?>
<script type="text/javascript">
    _linkedin_partner_id = "3210289";
    window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
    window._linkedin_data_partner_ids.push(_linkedin_partner_id);
    </script><script type="text/javascript">
    (function(){var s = document.getElementsByTagName("script")[0];
    var b = document.createElement("script");
    b.type = "text/javascript";b.async = true;
    b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
    s.parentNode.insertBefore(b, s);})();
</script>
<noscript>
    <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3210289&fmt=gif" />
</noscript>
</body>
</html>
