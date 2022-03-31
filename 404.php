
<?php
get_header();
?>
	<div id="primary">
		<main id="main" role="main">
			<div id="page__content">
                <div id="homepage-hero" class="homepage-hero"></div>
				<div class="wrapp both">
					<div class="error-container">
						<h1 class="contact-title"><?php echo get_field('page_error','option')['title'] ; ?></h1>
						<p><?php echo get_field('page_error','option')['description'] ; ?></p>
						<a class="btn ivado" href="<?php echo esc_url( home_url() ); ?>">
							<div class="label"><?php  _e('Back home','treize'); ?></div>
						</a>
					</div>
                </div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php wp_footer(); ?>

