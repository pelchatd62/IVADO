<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package TREIZE
 */
get_header();

?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main">
            <div id="page__header" class="small">
                <div class="blue-background burger-change"></div>
                <div class="wrapp both">
                    <div class="banner">
                        <div class="background" style="background-size: cover; background-color: #999999; background-repeat: no-repeat; background-image: url('https://ivado.ca/wp-content/uploads/2021/06/IVADO_LandingSEARCH_1570x650.jpg') ;"></div>
                        <h1 style="position: relative; top: 25px;">
                            <?php 
                                printf(
                                    esc_html__( 'Results for "%s"', 'ivadooo' ),
                                    '<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
                                );?> 
                        </h1>
                    </div>     
                </div> <!-- wrapp both -->
            </div> <!-- page__header -->

            <div class="wrapp both">
                <div class="wisi" style="margin-top: 75px">
                    <ul>
                        <?php
                            if ( ! have_posts() ) {
                                _e("No results", 'ivadooo' );
                            } else {
                                while ( have_posts() ) {
                                    the_post();
                                    echo "<li><a href='". get_the_permalink() . "'>";
                                    the_title();
                                    echo "</a></li>";
                                } // End the loop.
                            }
                        ?>
                    </ul>
                </div> <!-- wisi -->
            </div> <!-- wrapp both -->
		</main><!-- #main -->
	</section><!-- #primary -->
<?php
get_footer();
