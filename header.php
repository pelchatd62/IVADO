<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Treize
 */

if( is_singular(array('projects','bourse','persons')) || is_page() && !is_page_template() && !is_page('ivado') && !is_page('transfert') && !is_front_page() || is_page_template(array('tpl-professor.php','tpl-equipe.php','tpl-gouvernance.php','tpl-membres-industriels.php')) || is_post_type_archive(array('resultat', 'bourse'))  || is_page(198) || is_search() ){
	$srcLogo = "/assets/svg/siteLogoWhite.svg" ;
} else{
	$srcLogo = "/assets/svg/siteLogo.svg" ;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

    <?php
        if ( (! is_archive()) && "events" == get_post_type() && get_field('informations')['lien_externe'] ) {
            echo "<script>";
            echo "var lien = '" . get_field('informations')['lien_externe'] . "'";
            echo "</script>";
        }
        else {
            if (isset($_GET['redirection'])) {
                if ( $_GET["redirection"] == "oui" && get_field('informations')['button_reserve_ticket']['link'] ) {
                    echo "<script>";
                    echo "var lien = '" . get_field('informations')['button_reserve_ticket']['link'] . "';";
                    echo "</script>";
                }
            }
        }
    ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-69945407-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-69945407-1', {
            'send_page_view': false
        });
        gtag('event', 'page_view', {
            'event_callback': function() {
                if ( typeof lien !== "undefined" ) {
                    window.location = lien;
                } 
            }
        });
    </script>

    <?php  
        if ( (! is_archive()) && "events" == get_post_type() && get_field('informations')['lien_externe'] ) {
            $message =  "<title>" . get_the_title() . " | IVADO</title><meta name='robots' content='noindex'></head><body><br><h1 style='font-family:arial; font-size:40px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Redirection/Redirecting...</h1></body></html>"; 
            exit($message);
        } 
        if (isset($_GET['redirection'])) {
            if ( $_GET["redirection"] == "oui" && get_field('informations')['button_reserve_ticket']['link'] ) {
                $message =  "<title>" . get_the_title() . " | IVADO</title></head><body><br><h1 style='font-family:arial; font-size:40px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Redirection/Redirecting...</h1></body></html>"; 
                exit($message);
            }
        }
    ?>

	<!-- Fav -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri() . '/assets/favi/apple-touch-icon.png'; ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri() . '/assets/favi/favicon-32x32.png'; ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri() . '/assets/favi/favicon-16x16.png'; ?>">
	<link rel="manifest" href="<?php echo get_stylesheet_directory_uri() . '/assets/favi/site.webmanifest'; ?>">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<!-- Fav -->

	<?php wp_head(); ?>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '518851442441464');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=518851442441464&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
</head>
<body <?php body_class(); ?>>

<div id="person-info-box" class="wisi"></div>
<header id="masthead" class="site__header <?php echo is_singular(array('projects','bourse','persons')) || is_page() && !is_page_template() && !is_page('ivado') && !is_page('transfert') && !is_front_page() || is_page_template(array('tpl-professor.php','tpl-equipe.php','tpl-gouvernance.php','tpl-membres-industriels.php')) ||  is_post_type_archive(array('resultat', 'bourse'))  || is_page(198) ? 'reverse' : '' ; ?>">
	<div class="wrapp both">
		<div class="nav-header">
				<a href="<?php echo esc_url( home_url() ); ?>"><img class="header-logo" src="<?php echo get_stylesheet_directory_uri() . $srcLogo ;?>" alt="<?php _e('Logo\'s site', 'header-treize') ; ?>"></a>
				<div class="burger-container">
					<div class="burger">
						<div class="bar"></div>
						<div class="bar"></div>
						<div class="bar"></div>
					</div>
				</div>
		</div>
	</div>
	<div  class="responsive-nav">
        
		<div id="header-animation" class="homepage-hero in-header"></div>
		<div class="wrapp both">
			<div class="logo-wrapper">
				<a href="<?php echo esc_url( home_url() ); ?>"><img class="header-logo" src="<?php echo get_stylesheet_directory_uri() . '/assets/svg/siteLogo.svg' ?>" alt="<?php _e('Logo\'s site', 'header-treize') ; ?>"></a>
                <div class="language-switcher">
                    <?php custom_language_switcher(); ?>
                </div> 
                
            </div>
			<div class="responsive-content-wrapper">
                <?php   wp_nav_menu( array( 'theme_location' => 'menu-1' ) );  ; ?>
                <div class="networks">
                    <a target="_blank" href="<?php echo get_field('general','option')['reseaux_sociaux']['facebook']; ?>"><i class="fab fa-facebook-f"></i></a>
                    <a target="_blank" href="<?php echo get_field('general','option')['reseaux_sociaux']['twitter']; ?>"><i class="fab fa-twitter"></i></a>
                    <a target="_blank" href="<?php echo get_field('general','option')['reseaux_sociaux']['linkedin']; ?>"><i class="fab fa-linkedin-in"></i></a>
                    <a target="_blank" href="<?php echo get_field('general','option')['reseaux_sociaux']['youtube']; ?>"><i class="fab fa-youtube"></i></a>
                    <a id="search-form" href=""><i class="fas fa-search"></i></a>
                    <?php get_search_form(  ); ?>
                </div>
                <a target="_blank" class="head-newsletter" href="<?php echo get_field('general','option')['news_letter']; ?>"><?php _e('Subscribe to newsletter','treize') ; ?></a>
            </div>
        </div>		
	</div>
	
</header><!-- #masthead -->

<div id="page" class="site__content">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'treize' ); ?></a>
	<div id="content" class="site-content">
