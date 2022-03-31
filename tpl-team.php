<?php
/* Template Name: Team */
get_header();
$childs = get_terms( array( 'taxonomy' => 'person-type', 'parent' => 6 ) );
?>
<div id="primary">
	<main id="main" role="main">
    <?php include( locate_template( 'blocks/small-hero.php', false, false ) );?>
        <div id="page__content">
            <?php include( locate_template( 'blocks/main_flexible.php', false, false ) );?>
            <section class="content__section team" data-layout="conferencier">
                <div class="wrapp both">
<?php
                foreach($childs as $child): 
                    $postArgs = array(
                        'posts_per_page' => -1,
                        'post_type'     => 'persons',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'person-type', 
                                'field' => 'slug', 
                                'terms' => array($child->slug),
                            )
                        )
                    );
?>
                    <h2><?php echo $child->name; ?></h2>
                    <div class="container">
                        <?php 
                            $getTeams = get_posts($postArgs);
                            foreach($getTeams as $team):
                                global $post;
                                $post = $team;
                                setup_postdata( $post );
                                $team = true; 
                                include( locate_template( 'blocks/persons/box-conferencier.php', false, false ) );
                            endforeach;
                            wp_reset_postdata(); 
                        ?>
                    </div>
<?php           endforeach; ?>
            
             </div>
            </section>
        </div>
	</main>
</div>
<?php get_footer(); ?>