
<?php
/* Template Name: Membres Industriels */
get_header();
$memberTerm = get_term(37,'members-type');

?>
	<div id="primary">
		<main id="main" class="site-main ajax-partner" role="main">
            <?php include( locate_template( 'blocks/small-hero.php', false, false ) );?>
                <div id="page__content">
                    <div class="filters-container">
                        <div class="wrapp both">
                            <form id="search-form" action="" class="custom-search-bar membre-industriel">
                                <div class="custom-submit"><i class="far fa-search"></i></div>
                                <input name="partner-name" class="partner-name" type="text" placeholder="<?php _e('Search', 'filters-treize') ; ?>">
                            </form>
                            <form id="partner-form" method='get' action="<?php echo get_post_type_archive_link('partners'); ?>">
                    <?php   
                            if(isset($_GET['domains'])){
								$domTous = '';
								$domValue = $_GET['domains'];
							}else{
								$domTous = 'selected';
								$domValue = '';
							}

							if(isset($_GET['structures'])){
								$strucTous = '';
								$strucValue = $_GET['structures'];
							}else{
								$strucTous = 'selected';
								$strucValue = '';
                            }
                            if(isset($_GET['categories'])){
								$catTous = '';
								$catValue = $_GET['categories'];
							}else{
								$catTous = 'selected';
								$catValue = '';
							} ?>
                        
                            <div class="select-container">
                                <?php $terms = get_terms('domain', array( 'hide_empty' => true ) ); ?>
                                <div class="solo-select">
                                    <label class="custom-label"><?php _e('Domain','filters-treize') ; ?></label>
                                    <select class="custom-select" name="domains" id="domain">
                                        <option value="" <?php echo $domTous; ?>></option>
                                        <option value="all"><?php _e('All','filters-treize') ; ?></option>
                                        <?php foreach( $terms as $term ): ?>
                                            <option value="<?php echo $term->slug; ?>" <?php echo $domValue == $term->slug ? 'selected' : '' ; ?>><?php echo $term->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <?php $terms = get_terms('structure', array( 'hide_empty' => true ) ); ?>
                                <div class="solo-select">
                                    <label class="custom-label"><?php _e('Number of employees','filters-treize') ; ?></label>
                                    <select class="custom-select" name="structures" id="structure">
                                        <option value="" <?php echo $strucTous; ?>></option>
                                        <option value="all"><?php _e('All','filters-treize') ; ?></option>
                                        <?php foreach( $terms as $term ): ?>
                                            <option value="<?php echo $term->slug; ?>" <?php echo $strucValue == $term->slug ? 'selected' : '' ; ?>><?php echo $term->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <?php $terms = get_terms('categorie', array( 'hide_empty' => true ) ); ?>
                                <div class="solo-select cat">
                                
                                    
                                    <label class="custom-label"><?php _e('Categories','filters-treize') ; ?></label><i class="fas fa-question-circle"></i>
                                    <select class="custom-select" name="categories" id="categories">
                                        <option value="" <?php echo $catTous; ?>></option>
                                        <option value="all" ><?php _e('All','filters-treize') ; ?></option>
                                        <?php foreach( $terms as $term ): ?>
                                            <option value="<?php echo $term->slug; ?>" <?php echo $catValue == $term->slug ? 'selected' : '' ; ?>><?php echo $term->name; ?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                    <div class="film">
                                    </div>
                                    <div class="liste-description">
                                        <?php foreach( $terms as $term ) {
                                            echo "<strong>" . $term->name . "</strong>" . term_description($term->term_id) . "<br><br>";
                                        } ?>
                                    </div>  
                                    
                                </div>
                            </div>
                        </form>
                        </div>							
                    </div>
                    <section class="content__section partner partner-form" data-layout="cloud_logo">
                        <div class="wrapp both" id="partner-ajax">
                            <?php                       
                            add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
                            $memberId = 45;
                            $memberTerm = get_term($memberId, $taxonomy );
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
                                    'terms'    => array('membres-industriels'),
                                ),
                            );
                            $args['tax_query'][] = array(
                                'relation' => 'AND',
                            );

                            if(isset($_GET['partner-name'])){
                                $args['meta_query'] = array(
                                    'relation' => 'OR',
                                );
                                
                                $args['meta_query'][] = array(
                                    array(
                                        'key'     => 'description', 
                                        'value'   => $_GET['partner-name'],
                                        'compare' => 'LIKE'
                                    ),
                                );
                                $args['meta_query'][] = array(
                                    array(
                                        'key'     => 'title_search', 
                                        'value'   => $_GET['partner-name'],
                                        'compare' => 'LIKE'
                                    ),
                                );
                            }

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
                            include( locate_template( 'pages/archives/partners/partner-loop.php', false, false ) ); ?>      
                        </div>                             
                    </section>
                </div>    
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
