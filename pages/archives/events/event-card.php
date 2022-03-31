
<?php 
global $clc;
$isGenerated = false; 
if( isset($generated) ){
    $isGenerated = $generated;
}
$isAlwaysAvailable = false;
?>
<?php   if ( get_field('informations')['lien_externe'] ) { ?>
            <a href="<?php echo the_permalink()?>" class="event-info-container <?php echo $isGenerated ? ' generated' : ''; ?>" target="_blank">
<?php   } else {?>
            <a href="<?php echo the_permalink()?>" class="event-info-container <?php echo $isGenerated ? ' generated' : ''; ?>">
<?php   } ?>
    <div class="event-informations-container">
        <?php  
            $taxonomyName = 'event-type';
            if(get_the_terms($post->ID, $taxonomyName)): 
        ?>
            <div class="event-categories">
                <?php  $post_categories = get_the_terms($post->ID, $taxonomyName, array() ); 
                        $categories = get_terms( array( 'taxonomy' => 'event-type', 'parent' => 0 ) );
                    foreach($categories as $category){ ?>
                    <?php 
                    if(in_array($category, $post_categories)){
                    
                        if($category->slug === 'formations-en-ligne'){
                            $isAlwaysAvailable = true;
                        } ?>
                            <div class="event-category filter-category" data-category="<?php echo $category->slug;  ?>"> 
                                <?php echo $category->name; ?> 
                            </div>
                        <?php
                        }
                    }
                ?>
                <?php if(get_field('informations')['date']['date_limite']) { 
                   if ( get_field('informations')['date']['date_limite'] < current_time( "Y-m-d-H:i:s" ) ) { ?>
                        <div class="event-category rouge">
                            <?php _e("Registration closed" , "treize"); ?>
                        </div>
                   <?php }
                 } ?>
            </div>
            
        <?php endif; ?>
        <div class="event-info-title"><?php the_title(); ?> </div>
        <div class="event-info-location"> <?php echo get_field('informations')['location'] ?> </div>
        <?php if(get_field('informations')['date']['date_always']){ ?>
            <div class="event-status"><?php echo get_field('informations')['date']['texte_disponibilite']; ?></div>
        <?php }
            else if(get_field('informations')['date']['texte_dates']) { ?>
            <div class="same-day-dates plusieurs-dates">
                <?php echo get_field('informations')['date']['texte_dates']; ?>
            </div>
        <?php }
             else if(get_field('informations')['date']['datetbd']){ ?>
            <div class="event-status"><?php _e('Date to come', 'treize') ; ?></div>
        <?php } 
            else if(get_field('informations')['button_reserve_ticket']['full']){ ?>
               <div class="event-status"><?php _e('Full', 'treize') ; ?></div>
           <?php } 
            else {
                              
                if($clc == "fr"){
                    $sameDayFormat = 'l j F Y';
                    $dateFormat = 'l j F Y à H:i';
                    $timeFormat = 'H:i';
                }else{
                    $timeFormat = 'g:iA';
                    $sameDayFormat = 'F j, Y';
                    $dateFormat = 'l F j, Y at g:iA';
                }
                
                if(get_field('informations')['date']['pas_dheure']) { 
                    $dateFormat = 'l j F Y';
                    $timeFormat = '';
                }
                $startDate = get_field('informations')['date']['start_date'];
                $endDate = get_field('informations')['date']['enddate'];
                
                $dayFormat = 'j';
                $startDay = date_i18n( $dayFormat, strtotime( $startDate));
                $endDay = date_i18n( $dayFormat, strtotime( $endDate));
                
                $monthFormat = 'F';
                $startMonth = date_i18n( $monthFormat, strtotime( $startDate));
                $endMonth = date_i18n( $monthFormat, strtotime( $endDate));

                $startTime = date_i18n( $timeFormat, strtotime( $startDate));
                $endTime = date_i18n( $timeFormat, strtotime( $endDate));
                $sameDay = date_i18n( $sameDayFormat, strtotime( $startDate));

                $dayFormat = 'l';
                $day = date_i18n( $dayFormat, strtotime( $startDate));

                if($startDay === $endDay && $startMonth === $endMonth){
            ?>
                    <div class="same-day-dates plusieurs-dates">
                        <div>
                            <div class='plus_date'>
                                <?php echo ucfirst($sameDay) ?>
                            </div>
                            <?php if( ! get_field('informations')['date']['pas_dheure']) {
                                echo "<div class='plus_heure'>";
                                echo $startTime . " - " . $endTime; 
                                echo "</div>";
                            }?>
                        </div>
                    </div>
                <?php
                } else {

                    $startingDate = ucfirst(date_i18n( $dateFormat, strtotime( $startDate )));
                    $endingDate = date_i18n( $dateFormat, strtotime( $endDate));
                    if($clc == "en"){
                       $startingDate = str_replace('pm30' , 'at', $startingDate);
                       $endingDate = str_replace('pm30' , 'at', $endingDate);
                    }
                    if( have_rows('informations')) {
                        the_row();
                        if( have_rows('date')) {
                            the_row();
                            if(have_rows('plusieurs_dates')) {
                                if($clc == "fr") { 
                                    $dateFormat = 'l j F Y';
                                } else {
                                    $dateFormat = 'l F j, Y';
                                }
                                echo "<div class='event-dates plusieurs-dates'>";
                                while (have_rows('plusieurs_dates')) {
                                    the_row();
                                    echo "<div><div class='plus_date'>";
                                    echo ucfirst( date_i18n( $dateFormat, strtotime( get_sub_field( "une_date"))) . " ");
                                    echo "</div>";
                                    if( get_sub_field("debut") ) { 
                                        echo "<div class='plus_heure'>";
                                        echo get_sub_field("debut") . " - " . get_sub_field("fin");
                                        echo "</div>";
                                    }
                                    echo "</div>";
                                }
                                echo "</div>";
                            } else { ?>
                                <div class="event-dates">  
                                    <div class="start-date"> <?php echo $startingDate; ?> </div>
                                    <div class="date-separation"><?php _e('to', 'date-separation-treize') ; ?></div>
                                    <div class="end-date"> <?php  echo   ucfirst( $endingDate ); ?> </div>
                                </div>
                            <?php }
                        }
                    }
                } 
            } ?>
    </div>
    <div class="event-illustration lozad not-hidden" data-background-image="<?php echo get_the_post_thumbnail_url( get_the_ID(),'article-media') ;  ?>" style="background-image: url(<?php echo get_the_post_thumbnail_url( get_the_ID(),'article-media') ;  ?>)">
    </div>
</a>