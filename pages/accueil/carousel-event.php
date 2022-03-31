<div class="carousel-container">
    <div class="title-section">
        <h2><?php echo $carousel['title']?></h2>
        <a class="btn ivado btn-fullscreen" href="<?php echo $carousel['button']['link']?>">
            <div class="label"> <?php echo $carousel['button']['label']?> </div>
        </a>
    </div>
    <div class="carousel-section carousel">
        <div class="carousel-arrow prev to-disapear">
            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/svg/chevron-gauche.svg' ?>" alt="<?php _e('Arrow left', 'carousel_left_arrow') ; ?>">
        </div>
        <div class="carousel-wrapper  owl-carousel" data-slider="front"> 
            <?php
            if( $getEvents ):
                foreach( $getEvents as $event ):
                $post = $event;
                setup_postdata( $post );
                //$image = get_field('in_carousel_image')['sizes']['archive-researcher'];
                $image = get_the_post_thumbnail_url( get_the_ID(),'archive-researcher' );
                $complete = ( get_field('image_complete') ) ? "complete" : "";
            ?>
            <?php if ( get_field('informations')['lien_externe'] ) {
                echo "<a href=" .  get_field('informations')['lien_externe'] . " class='image-carousel-container" . ($isGenerated ? ' generated' : '') . "' target='_blank'>";
            } else {?>
                <a class="image-carousel-container" href="<?php the_permalink() ?>">
            <?php } ?>
                
                    <?php if(get_the_terms($post->ID, $taxonomyName)): 
                        $categories = get_the_terms($post->ID, $taxonomyName );
                    ?>
                        <div class="category-container"
                            data-category="<?php echo $categories[0]->slug ?>"
                            data-url="<?php echo get_post_type_archive_link('events');?>"
                        > 
                            <div> 
                                <?php
                                    echo $categories[0]->name;
                                ?> 
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="img-container">
                        <div class="image <?php echo $complete ?>">
                            <div>
                                <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="title-container">
                        <div class="date">
                            <?php 
                                global $clc;
                                if($article){
                                    if($clc=="fr"){
                                        $date = get_the_time('j F Y');
                                    }
                                    else if($clc=="en"){
                                        $date = get_the_time('F j, Y');
                                    }else{
                                        $date = get_the_time('j F Y');
                                    }
                                }else{
                                    $dateInfo = get_field('informations')['date'];
                                    $dateFormat = 'j F Y';
                                    $begin = date_i18n( $dateFormat, strtotime( $dateInfo['start_date']) );
                                    $end = date_i18n( $dateFormat, strtotime( $dateInfo['enddate']) );

                                    $monthFormat = 'F';
                                    $beginMonth = date_i18n( $monthFormat, strtotime(  $dateInfo['start_date']));
                                    $endMonth = date_i18n( $monthFormat, strtotime( $dateInfo['enddate']));

                                    if($begin == $end){
                                        $date= $begin;
                                    }else{
                                        if($beginMonth == $endMonth){
                                            $date =  date_i18n( 'j', strtotime( $dateInfo['start_date']))."-".date_i18n( 'j', strtotime( $dateInfo['enddate'])).' '.date_i18n( 'F', strtotime( $dateInfo['enddate'])).' '.date_i18n( 'Y', strtotime( $dateInfo['enddate']));
                                        }else{
                                            $date =  date_i18n( 'j', strtotime( $dateInfo['start_date'])).' '.date_i18n( 'F', strtotime( $dateInfo['start_date'])). " - ".date_i18n( 'j', strtotime( $dateInfo['enddate'])).' '.date_i18n( 'F', strtotime( $dateInfo['enddate'])).' '.date_i18n( 'Y', strtotime( $dateInfo['enddate']));
                                        }
                                    }
                                    if($dateInfo['datetbd']){
                                        $date = __('Date to come','treize');
                                    }
                                    if($dateInfo['date_always']){
                                        $date = get_field('informations')['date']['texte_disponibilite'];
                                    }
                                }
                                
                                // $dateFormat = 'j F Y';
                                echo $date; 
                            ?>
                        </div>
                        <div><?php echo get_the_title( get_the_ID()); ?></div>
                        <div><?php echo get_field('title_establishment'); ?></div>
                    </div>
                </a>
            <?php
             
                endforeach;
                wp_reset_postdata();
            endif; 
            ?>
        </div>
        <div class="carousel-arrow next to-disapear">
            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/svg/chevron-droit.svg' ?>" alt="<?php _e('Arrow left', 'carousel_left_arrow') ; ?>">   
        </div>
        <div class="mobile-arrow">
            
            <div class="carousel-arrow prev">
                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/svg/chevron-gauche.svg' ?>" alt="<?php _e('Arrow left', 'carousel_left_arrow') ; ?>">   
            </div>
            <div class="carousel-arrow next">
                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/svg/chevron-droit.svg' ?>" alt="<?php _e('Arrow left', 'carousel_left_arrow') ; ?>">
            </div>
        </div>
    </div>
    <a class="btn ivado btn-mobile" href="<?php echo $carousel['button']['link']?>">
            <div class="label"> <?php echo $carousel['button']['label']?> </div>
    </a>
</div>
