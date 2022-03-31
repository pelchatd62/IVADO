<?php
/* Template Name: Stages et emplois */
get_header();
$query_args = array(

    'post_type'         => 'post',
    'posts_per_page'    => -1,
    'tax_query'         => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => array( "carrieres", "carrieres-en" ),
            ),
    ),
    'orderby' => 'date',
    'order' => 'DESC'
);

$queryAll = new WP_Query($query_args);
?>
	<div id="primary">
		<main id="main" class="site-main" role="main">
			<?php include( locate_template( 'blocks/big-hero.php', false, false ) );?>
			<div id="page__content">
				<section class="content__section">
					<div class="wrapp both">
						<div class="container wisi">
                            <?php
                                if ($queryAll->have_posts()) {
                                    echo "<ul>";
                                    while ($queryAll->have_posts()) {
                                        $queryAll->the_post();
                                        echo "<li><a href='" . get_permalink() . "'><h4 class='emploi'>" . get_the_title() . "</h4></a></li>";
                                    }
                                    echo "</ul>";
                                } else {
                                    echo "<h3>" . __("No Jobs or Internships available right now.", "treize") . "</h3>";
                                }
                            ?>
                        </div>
					</div>
				</section>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();