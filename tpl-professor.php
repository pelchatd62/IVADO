<?php
/* Template Name: Professor */
get_header();
$postArgs = array(
    'posts_per_page' => -1,
    'post_type'     => 'persons',
    'order' => 'ASC',
    'orderby' => 'title',
    'tax_query' => array(
        array(
            'taxonomy' => 'person-type', 
            'field' => 'slug', 
            'terms' => array('professor'),
        )
    )
);
?>
<div id="primary">
	<main id="main" role="main">
    <?php include( locate_template( 'blocks/small-hero.php', false, false ) );?>
        <div id="page__content">
            <?php $row = get_field('titre_description'); 
            $layout='title_description';
            include( locate_template( 'blocks/flexible/title_description.php', false, false ) ); ?>

            <section class="content__section" data-layout="conferencier">
                <div class="wrapp both">
                    <div class="container">
                    <?php $getProfessors = get_posts($postArgs);
                        foreach($getProfessors as $professor):
                            global $post;
                            $post = $professor;
                            setup_postdata( $post );
                            $team = false; 
                            $prof = true;
                            $conf = false;
                            include( locate_template( 'blocks/persons/box-conferencier.php', false, false ) );
                        endforeach;
                        wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
            <?php include( locate_template( 'blocks/main_flexible.php', false, false ) );?>                

        </div>
	</main>
</div>
<?php get_footer(); ?>