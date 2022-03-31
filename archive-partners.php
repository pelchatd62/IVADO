<?php
get_header();
$memberTerms = get_terms('members-type');
?>
	<div id="primary">
		<main id="main" class="site-main ajax-partner" role="main">
            <?php include( locate_template( 'blocks/big-hero.php', false, false ) );?>
            <div id="page__content">
                <?php include( locate_template( 'blocks/main_flexible.php', false, false ) );?>
                <div class="filters-container anchor-partner">
                    <div class="wrapp both">
                        <div class="button-container">
                            <?php   foreach( $memberTerms as $memberTerm): 
                                        if($memberTerm->slug != "autres" && $memberTerm->slug != "others"  ){ ?>
                                            <div class="filter-button" data-term="<?php echo $memberTerm->slug; ?>"><?php echo $memberTerm->name; ?></div>
                            <?php       }  
                                    endforeach; ?>
                        </div>
                    </div>							
                </div>                                
                <section class="content__section partner" data-layout="cloud_logo">
                    <div class="wrapp both" id="partner-ajax">
                <?php   foreach($memberTerms as $memberTerm) : ?>
                <?php           
                add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
                                $args = array(
                                    'post_type' => 'partners',
                                    'posts_per_page' => -1,
                                    'order' => 'ASC',
                                    'orderby' => 'title',
                                );
                                $args['tax_query'][] = array(
                                    array(
                                        'taxonomy' => 'members-type',
                                        'field'    => 'slug',
                                        'terms'    => array($memberTerm->slug),
                                    ),
                                );
                                $args['tax_query'][] = array(
                                    array(
                                        'taxonomy' => 'members-type',
                                        'field'    => 'slug',
                                        'terms'    => array('autres','others'),
                                        'operator'  => 'NOT IN'
                                    ),
                                );
                                $args['tax_query'][] = array(
                                    'relation' => 'AND',
                                );
                                if(isset($_GET['domains'])){
                                    $args['tax_query'][] = array(
                                        array(
                                            'taxonomy' => 'domain',
                                            'field'    => 'slug',
                                            'terms'    => array( $_GET['domains'] ),
                                        ),
                                    );
                                }
                                if(isset($_GET['structures'])){
                                    $args['tax_query'][] = array(
                                        array(
                                            'taxonomy' => 'structure',
                                            'field'    => 'slug',
                                            'terms'    => array( $_GET['structures'] ),
                                        ),
                                    );
                                }
                                if(isset($_GET['service-types'])){
                                    $args['tax_query'][] = array(
                                        array(
                                            'taxonomy' => 'service-type',
                                            'field'    => 'slug',
                                            'terms'    => array( $_GET['service-types'] ),
                                        ),
                                    );
                                }
                                if(isset($_GET['categories'])){
                                    $args['tax_query'][] = array(
                                        array(
                                            'taxonomy' => 'categorie',
                                            'field'    => 'slug',
                                            'terms'    => array( $_GET['categories'] ),
                                        ),
                                    );
                                }
                                $getTaxPosts = get_posts($args);
                                include( locate_template( 'pages/archives/partners/partner-loop.php', false, false ) );       
                                ?>
                            <!-- </div> -->
                <?php   endforeach; ?>
                        
                    </div>                             
                </section>             
                
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
