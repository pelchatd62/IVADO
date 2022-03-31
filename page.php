<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TREIZE
 */

get_header();
$object = get_queried_object();
?>

	<div id="primary">
		<main id="main" role="main">

			<?php 
			if(is_page('ivado') || is_page('transfert') || is_page('transfer')){
				include( locate_template( 'blocks/big-hero.php', false, false ) );
			}else{
				include( locate_template( 'blocks/small-hero.php', false, false ) );
			}
			?>

		<div id="page__content">
			<?php include( locate_template( 'blocks/main_flexible.php', false, false ) );?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

	
<?php get_footer(); ?>