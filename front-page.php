<?php
get_header();
?>
	<div id="primary">
		<main id="main">
			<div id="page__content">
                <div id="homepage-hero" class="homepage-hero"></div>
				<div id="front-page-full" class="wrapp both">
                    <div id="gram-container" style="display:none;">
                    </div>
					<section id="punchline-cta" class="front-page punchline-cta front-index" data-pos="0">
                        <?php include( locate_template( 'pages/accueil/punchline-cta.php', false, false ) );?>
                    </section>
                    <section id="images-cta"class="front-page images-cta" data-pos="1">
                        <?php 
                            $images_cta = get_field('images_cta_services');
                            include( locate_template( 'pages/accueil/images-cta.php', false, false ) );
                         ?>
                    </section>
                    <section id="carousel-event" class="front-page carousel-event" data-pos="2">
                        <?php
                            $carousel = get_field('carousel_events');
                            $postArgs = array(
                                'posts_per_page' => 5,
                                'post_type'     => 'events',
                                'post_status' => 'publish',
                                'orderby' => 'publish_date',
                                'order'   => 'DESC',
                                );
                            if(get_posts($postArgs)){
                                $getEvents = get_posts($postArgs);
                            }else{
                                $postArgs = array(
                                    'posts_per_page' => 5,
                                    'post_type'     => 'events',
                                    'post_status' => 'publish',
                                    'orderby' => 'publish_date',
                                    'order'   => 'DESC',
                                );
                                $getEvents = get_posts($postArgs);
                            } 
                            $taxonomyName = 'event-type';
                            $article = false;
                            $event = true ;   
                            include( locate_template( 'pages/accueil/carousel-event.php', false, false ) );?>
                    </section>
                    <section id="carousel-actuality" class="front-page carousel-actuality" data-pos="3">
                        <?php 
                            $carousel = get_field('carousel_actuality');
                            $postArgs = array(
                                'posts_per_page' => 5,
                                'post_type'     => 'post',
                            );
                            if(get_posts($postArgs)){
                                $getEvents = get_posts($postArgs);
                            }else{
                                $postArgs = array(
                                    'posts_per_page' => 5,
                                    'post_type'     => 'post',
                                );
                                $getEvents = get_posts($postArgs);
                            }
                            $taxonomyName = 'category';
                            $event = false ;   
                            $article = true;
                            include( locate_template( 'pages/accueil/carousel-event.php', false, false ) );?>
                    </section>
                    <div id="front-page-stats" class="front-page" data-pos="4"> 
                        <?php 
                            $row = get_field('statistics'); 
                            //echo var_dump($row);
                            $layout='statistique';
                            include( locate_template( 'blocks/flexible/statistique.php', false, false ) );
                        ?>
                    </div>


                </div>	
                <div class="scroll-bar-fp">
                    <div>
                        <div class="point-container active" data-id="punchline-cta" data-pos="0">
                            <div class="point"></div>
                        </div>
                        <div class="point-container" data-id="images-cta" data-pos="1">
                            <div class="point"></div>
                        </div>
                        <div class="point-container" data-id="carousel-event" data-pos="2">
                            <div class="point"></div>
                        </div>
                        <div class="point-container" data-id="carousel-actuality" data-pos="3">
                            <div class="point"></div>
                        </div>
                        <div class="point-container" data-id="front-page-stats" data-pos="4">
                            <div class="point"></div>
                        </div>
                        <div class="point-container" data-id="front-page-footer" data-pos="5">
                            <div class="point"></div>
                        </div>       
                    </div>
                </div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php get_footer(); ?>
