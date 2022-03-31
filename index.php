<?php
get_header();
$object = get_queried_object();
$initialPostNumber = 9;
$query_args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC'
);
if(isset($_GET['categorie'])){
	$query_args['tax_query'][] = array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => array( $_GET['categorie'] ),
		),
	);
}
$queryAll = new WP_Query($query_args);
$thePosts = array();
?>
	<div id="primary">
		<main id="main" class="site-main" role="main">
			<?php include( locate_template( 'blocks/big-hero.php', false, false ) );?>
			<div id="page__content">
                <section class="content__section blog-section">
                    <div id="rapports" class="wrapp both">
                        <div class="text wisi">
                            <?php $flexible = get_field('archive_blog', 'option')['rapports_et_guides'];?>
                            <?php echo $flexible; ?>
                        </div>
                    </div>
				</section>
				<div class="filters-container">
					<div class="wrapp both">
						<form id="form-article" method='get' action="<?php echo get_post_type_archive_link('post'); ?>">
					<?php   $terms = get_terms('category', array( 'hide_empty' => true ) ); 
								if(isset($_GET['categorie'])){
									$catTous = '';
									$catValue = $_GET['categorie'];
								}else{
									$catTous = 'selected';
									$catValue = '';
								}
					?>
							<div class="select-container">
								<div class="solo-select <?php if(isset($_GET['categorie'])) echo 'active';?>">
									<label class="custom-label"><?php _e('Categories','filters-treize') ; ?></label>
									<select class="custom-select" name="categorie" id="categorie">
										<option value=""  <?php echo $catTous; ?>></option>
										<option value=""  ><?php _e('All','filters-treize') ; ?></option>
										<?php foreach( $terms as $term ): ?>
											<option value="<?php echo $term->slug; ?>" <?php echo $catValue == $term->slug ? 'selected' : '' ; ?>><?php echo $term->name; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</form>
					</div>							
				</div>
				<section class="content__section grey blog-section">
					<div id="actualites" class="wrapp both">
                        <h2><?php _e('News', 'treize' ); ?></h2>
						<div id="container-items-to-be-loaded-in" class="container single-article-cta blog">
                            <?php
                                if ($queryAll->have_posts()) :
                                    while ($queryAll->have_posts()) : $queryAll->the_post();
                                        $thePosts[] = get_the_ID();
                                    endwhile;
                                    $maxIndex = count($thePosts) >= $initialPostNumber ? $initialPostNumber : count($thePosts);
                                    $cardNamePath = 'blocks/box-event-article.php';
                                    include(locate_template('blocks/article_loop/loop.php', false, false));
                                endif;
                            ?>
                        </div>
                            <?php if (count($thePosts) > 0) :  ?>
                                <div class="load-more-container item-ajax" id="loadmore" data-query='<?php echo $serialized; ?>'>
                                    <div class="btn ivado" id="load-more-btn-news" data-path="<?php echo $cardNamePath; ?>">
                                        <div class="label"><?php _e('Load More', 'load-more-treize') ; ?></div>
                                    </div>

                                </div>
                            <?php endif; ?>
					</div>
				</section>
				<?php include( locate_template( 'blocks/main_flexible.php', false, false ) );?>
				<?php include( locate_template( 'blocks/news-letter.php', false, false ) ); ; ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
