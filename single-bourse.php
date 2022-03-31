<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Treize
 */
get_header();
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 2 ,
	'orderby' => 'date',
	'order' => 'DESC',
	'post__not_in' => array(get_the_ID())
	);
$query = new WP_Query($args ); ?>

	<div id="primary">
		<main id="main" class="site-main" role="main">
			<?php include( locate_template( 'blocks/small-hero.php', false, false ) );?>
			<div id="page__content">
				<?php include( locate_template( 'blocks/main_flexible.php', false, false ) );?>
				<?php include( locate_template( 'blocks/back-social_media.php', false, false ) ) ; ?>
			</div>	
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
