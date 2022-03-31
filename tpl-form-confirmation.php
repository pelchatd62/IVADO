
<?php
/* Template Name: Form confirmation */
get_header();
?>
	<div id="primary">
		<main id="main" role="main">
			<div id="page__content">
                <div id="homepage-hero" class="homepage-hero"></div>
				<div id="contact-page-full" class="wrapp both">
                    <section class="contact-section"> 
                        <h1 class="contact-title"><?php echo get_field('title') ; ?></h1>
                    </section>
                    <section class="contact-forms-section">
                        <p><?php echo get_field('description') ; ?></p>
                        <a class="btn ivado" href="https://dev.treize.pro/ivadooo/contactez-nous/">
                            <div class="label">Retour page contact</div>
                        </a>
                    </section>
                </div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php wp_footer(); ?>