<?php
/* Template Name: Gouvernance */
get_header();

$gouvTerms = get_terms( array( 'taxonomy' => 'gouvernance', 'parent' => 0 ) );
?>
<div id="primary">
	<main id="main" role="main">
    <?php include( locate_template( 'blocks/small-hero.php', false, false ) );?>
        <div id="page__content">

            <?php include( locate_template( 'blocks/main_flexible.php', false, false ) );?>
            
            <section class="content__section" data-layout="gouvernance">
                <div class="wrapp both">
            <?php   
             foreach($gouvTerms as $gouvTerm): 
                
                $noTaxArgs = array(
                    'posts_per_page' => -1,
                    'post_type'     => 'persons',
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'gouvernance', 
                            'field' => 'slug', 
                            'terms' => array($gouvTerm->slug),
                        ),
                        array(
                            'taxonomy' => 'gouvernance', 
                            'terms'    => get_terms( array( 'taxonomy' => 'gouvernance', 'parent' => $gouvTerm->term_id, 'fields' => 'ids' ) ),
                            'operator' => 'NOT IN'
                        )
                    )
                );
?>
                <div class="global-container">
                    <h2><?php echo $gouvTerm->name; ?></h2>
                <?php
                    $getNoTaxPosts = get_posts($noTaxArgs); 
                    if($getNoTaxPosts):  ?>
                    <div class="container">
                        <?php 
                            foreach($getNoTaxPosts as $noTaxPost):
                                global $post;
                                $post = $noTaxPost;
                                setup_postdata( $post );
                                $noTaxPost = true; 
                                include( locate_template( 'blocks/persons/box-gouvernance.php', false, false ) );
                            endforeach;
                            wp_reset_postdata(); 
                        ?>
                    </div>
<?php               endif;
                    $gouvTaxonomys = get_terms( array( 'taxonomy' => 'gouvernance', 'parent' => $gouvTerm->term_id ) );
                    foreach($gouvTaxonomys as $gouvTaxonomy):
                        $taxArgs = array(
                            'posts_per_page' => -1,
                            'post_type'     => 'persons',
                            'tax_query' => array(
                                'relation' => 'AND',
                                array(
                                    'taxonomy' => 'gouvernance', 
                                    'field' => 'slug', 
                                    'terms' => array($gouvTerm->slug),
                                ),
                                array(
                                    'taxonomy' => 'gouvernance', 
                                    'terms'    => array($gouvTaxonomy->term_id) ,
                                    'operator' => 'IN'
                                )
                            )
                        );
                        $getTaxPosts = get_posts($taxArgs);
                        if($getTaxPosts): ?>
                            <h3><?php echo $gouvTaxonomy->name ; ?></h3>
                            <div class="container">
                                <?php 
                                    foreach($getTaxPosts as $taxpost):
                                        global $post;
                                        $post = $taxpost;
                                        setup_postdata( $post );
                                        include( locate_template( 'blocks/persons/box-gouvernance.php', false, false ) );
                                    endforeach;
                                    wp_reset_postdata(); 
                                ?>
                            </div>
<?php                   endif;    
                    endforeach;                       
?>    
                </div>    
<?php           endforeach; ?>
                    
                </div>
            </section>
        </div>
	</main>
</div>
<?php get_footer(); ?>