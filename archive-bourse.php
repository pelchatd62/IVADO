<?php
get_header();
$first_section = get_field('archive_bourses','option')['first_Section'];
$choice = $first_section['grey_choice'];

?>
	<div id="primary">
		<main id="main" class="site-main" role="main">
            <?php include( locate_template( 'blocks/small-hero.php', false, false ) );?>

            <div id="page__content">
            <section class="content__section <?php echo $choice ? 'grey' : ''; ?>" data-layout="title_description">     
                <div class="wrapp both">
                    <div class="title-description-container">
<?php
                        if ( $first_section['title']) { 
                            echo "<h2 class='title-left-text'>" .  $first_section['title'] . "</h2>"; 
                        }
?>       
                        <div class="<?php if ( $first_section['title']) { echo 'title-left-text'; } ?>  paragraph wisi"><?php echo $first_section['text'] ; ?></div>
                    </div>
                </div>
            </section>
            <section class="content__section bourse-section">
                <div class="wrapp both">
<?php
                    //$terms = get_terms( array('bourse-categorie') );
                    //foreach ($terms as $term) {
                        $args = array(
                            /*'tax_query' => array(
                                array(
                                    'taxonomy' => 'bourse-categorie',
                                    'field' => 'slug',
                                    'terms' => $term->name
                                )),*/
                            'post_type' => 'bourse',
                            'posts_per_page' => '-1',
                        );
                        
                        $query = new WP_Query( $args );
                        
 ?>
                        <div class="container-bourse">
                            <h2><?php _e("Current and upcoming competitions and program", 'treize');  ?> </h2>
<?php                       while( $query->have_posts() ): $query->the_post();
                                $terms = get_the_terms( $post->ID, 'bourse-categorie' );
                                if ( $terms[0]->name == "PFRS" ) {
                                    $size = "large-size";
                                } else {
                                    $size = 'archive-researcher';
                                }
                                if( $terms[0]->name != "Autres" ) {
                                    //echo $terms[0]->name;
                                    $dateFormat = 'd F Y';
                                    $soonFormat ='F Y';
                                    $start = (int)strtotime( get_field('start_date') );
                                    $end = (int)strtotime( get_field('end_date')  );
                                    $todays = (int)strtotime(date($dateFormat));
                                    if($todays < $start) {
                                        $status = __('Soon','treize');
                                        $Statusclass = "before";
                                        $message = "<p class='date'><span>".__('Scheduled opening:','treize')."</span><br/><span>".date_i18n( $soonFormat, strtotime( get_field('start_date') ) )."</span></p>";
                                    }
                                    if($todays >= $start  && $todays <= $end ) {
                                        $status = __('Open','treize');
                                        $Statusclass = "open";
                                        $message = "<p class='date'><span>".__('Deadline:','treize')."</span><br/><span>".date_i18n( $dateFormat, strtotime( get_field('end_date') ) )."</span></p>";
                                    }
                                    if($todays > $end) {
                                        $status = __('Closed','treize');
                                        $Statusclass = "close";
                                        $message = "";
                                    }
                                
                                    ?>
                                    <div class="bourse-box <?php echo $terms[0]->slug?>">
                                        <?php if ( get_field('lien_externe') ) {
                                            echo "<a href=" .  get_field('lien_externe') . " class='bourse' target='_blank'>";
                                        } else {
                                            echo "<a href=" .  get_permalink() . " class='bourse'>";
                                        }?>
                                            <?php if(has_post_thumbnail()) { ?>
                                                <div class="image lozad not-hidden" data-background-image="<?php echo get_the_post_thumbnail_url( get_the_ID(), $size ) ;  ?> "></div>
                                            <?php } else { ?>
                                                <div class="image"></div>
                                            <?php } ?>
                                            <div class="status <?php echo $Statusclass; ?>">
                                                <?php  echo $status; ?>
                                            </div>
                                            <div class="content">
                                                <p class="cycle"><?php echo get_field('category') ; ?></p>
                                                <h3><?php the_title(); ?></h3>
                                                <?php echo $message ; ?>
                                            </div>
                                            <p href="<?php the_permalink(); ?>" class="more"><?php _e('Know more','treize') ; ?></p>
                                        </a>
                                    </div>
                                    <?php 
                                }
                            endwhile;  ?>      
                        </div>
<?php               //} ?>

                </div>
            </section>   

                <?php include( locate_template( 'blocks/main_flexible.php', false, false ) );?>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
