<?php
/* Template Name: Formations */

get_header();
$formationCategoryId = 14;
$onlineFormationCategoryId = 60;

$initialPostNumber = 3;
$query_args = array(
	'post_type' => 'events',
	'posts_per_page' => -1 ,
	'orderby' => 'date',
    'order' => 'DESC',
    'tax_query' => array(
        array(
            'taxonomy' => 'event-type', 
            'field' => 'slug',
            'terms' => 'mooc',
        )
    )
);

$queryAll = new WP_Query( $query_args );
$postObjects = array();
?>

<div id="primary">
	<main id="main" role="main">
    <?php include( locate_template( 'blocks/big-hero.php', false, false ) );?>
        <div id="page__content" class="formations-id">
            
                <section class="content__section">     
                    <div class="wrapp both medium">
                        <h2><?php echo get_field('text_image')['title'] ; ?></h2>
                        <?php echo get_field('text_image')['text'] ; ?>
                    </div>
                </section>

                <section class="content__section">     
                    <div class="wrapp both">
                        <img class="full-width-image" src="<?php echo get_field('image_first_section')['sizes']['large-size'] ; ?>" alt="<?php echo $row['image']['alt'] ? $row['image']['alt']  : __('Header image', 'treize') ; ?>">
                    </div>
                </section>

                <h2 id="formations-a-venir" class="title-formation"> <?php echo get_field('title_formation') ?> </h2>
                <div class="filters-container">
                    <div class="wrapp both">
                        <form id="form-event-id" method='get' action="<?php echo get_post_type_archive_link('post'); ?>">
                            <?php   
                                $terms = get_terms( array( 'taxonomy' => 'event-type', 'parent' => $formationCategoryId ) );
                                if(isset($_GET['event-category'])){
                                    $catTous = '';
                                    $catValue = $_GET['event-category'];
                                }else{
                                    $catTous = 'selected';
                                    $catValue = '';
                                }
                            ?>
                            <div class="select-container">
                                <div class="solo-select">
                                    <select class="custom-select" name="event-category" id="categorie">
                                        <option value=""><?php _e('All Categories','filters-treize') ; ?></option>
                                        <?php foreach( $terms as $term ): ?>
                                            <option value="<?php echo $term->slug; ?>" <?php echo $catValue == $term->slug ? 'selected' : '' ; ?>><?php echo $term->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>	
                </div>
                <!--//formations -->
                <div class="wrapp both formation-section"></div>
                <?php
                        $events = array(
                            'posts_per_page' => -1,
                            'post_type'     => 'events',
                            'orderby' => 'publish_date',
                            'order' => 'ASC',
                            'tax_query' => array(
                            array(
                                'taxonomy' => 'event-type', 
                                'field' => 'slug',
                                'terms' => 'formations',
                            ))
                        );
                        $query = new WP_Query($events);

                        if( $query->have_posts() ):
                            while( $query->have_posts() ) : $query->the_post(); ?>
                                <div class="formation-section-data"
                                    data-event-id="<?php echo get_the_ID() ?>"
                                    data-event-start="<?php echo get_field('informations')['date']['start_date']; ?>"
                                    data-event-end="<?php echo get_field('informations')['date']['date_limite']; ?>"
                                    data-event-tbd="<?php echo get_field('informations')['date']['datetbd']; ?>"
                                >
                                </div>
                            <?php endwhile;
                        endif;
                        wp_reset_postdata();
                    ?>
                <h2 class="title-formation" id="MOOC"> <?php echo get_field('title_online_formation') ?> </h2>
                    <?php 
                        if( $queryAll->have_posts() ):
                            
                            while( $queryAll->have_posts() ) : $queryAll->the_post(); 
                                $postObjects[] = get_the_ID();
                            endwhile;
                            $maxIndex = count($postObjects) >= $initialPostNumber ? $initialPostNumber : count($postObjects);
                            $btnLoadMoreLabel = __('Load more' , 'treize-online-formation');
                            $cardNamePath = 'pages/archives/events/event-card.php' ;
                            include( locate_template( 'ajax-function/online-formation-loadmore.php', false, false ) ); 
                        endif;
					?>
                <?php
                //flexible
                include( locate_template( 'blocks/main_flexible.php', false, false ) );?>
        </div>
	</main>
</div>

<?php get_footer(); ?>