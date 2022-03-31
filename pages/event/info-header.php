<?php 
$toCome = $informations['date']['datetbd']; 
global $clc;
if($clc=="fr"){
    $informationDateFormat = 'l j F Y à H\&\n\b\s\p\;\h\&\n\b\s\p\;i';
    $showFormat = 'l j F Y';
    //$hourFormat = 'H\&\n\b\s\p\;\h\&\n\b\s\p\;i';
    $hourFormat = 'H:i';
}
else if($clc=="en"){
    $showFormat = 'l F j, Y';
    $informationDateFormat = 'l F j, Y à g:iA';
    $hourFormat = 'g:iA';
}
if(get_field('informations')['date']['pas_dheure']) { 
    $informationDateFormat = 'l j F Y';
    $hourFormat = '';
}
$startDate = str_replace(',',__('at','treize'), date_i18n( $informationDateFormat, strtotime( $informations['date']['start_date'] )));
$endDate =  str_replace(',',__('at','treize'),date_i18n( $informationDateFormat, strtotime( $informations['date']['enddate'] )));
$dateFormat = 'd-m-Y';
if($clc=="en"){
    $startDate = str_replace('à',__('at','treize'), date_i18n( $informationDateFormat, strtotime( $informations['date']['start_date'] )));
    $endDate =  str_replace('à',__('at','treize'),date_i18n( $informationDateFormat, strtotime( $informations['date']['enddate'] )));
}
$start = date_i18n( $dateFormat, strtotime( $informations['date']['start_date'] ) );
$end = date_i18n( $dateFormat, strtotime( $informations['date']['enddate'] ) );
// when its the same date
$dayMonthYear = date_i18n( $showFormat, strtotime( $informations['date']['start_date'] ));
$beginHour = date_i18n( $hourFormat, strtotime( $informations['date']['start_date'] )) ;
$endHour = date_i18n( $hourFormat, strtotime( $informations['date']['enddate'] ));
if($start == $end){
    if(get_field('informations')['date']['pas_dheure']) { 
        $showDate = '<p><span>'.$dayMonthYear.'</span></p>';
    } else {
        $showDate = '<p><span>'. ucfirst($dayMonthYear).' '.__('from','treize').'<br/>'.$beginHour.' '.__('to','single-event').' '.$endHour.' </span></p>';
    }
}else{
    $showDate = '<p><span>'.$startDate.' '.__('to','treize').'<br/>'.$endDate.'</span></p>';
}

if(strtotime(date('d-m-Y')) <= strtotime($end)){
    if( $buttonReserveTicket['link'] ){
        $reserveSection = ' <a class="btn ivado" href="'.$buttonReserveTicket['link'].'"  target="_blank"> 
                            <div class="label">'.$buttonReserveTicket['label'].'</div> 
                            </a>';
    } else {
        $reserveSection = ' <a class="btn ivado" target="_blank"> 
                            <div class="label">'.$buttonReserveTicket['label'].'</div> 
                            </a>';
    }
}
if($toCome){
    $reserveSection = '<p>'.__('Date to come','treize').'</p>';
    $showDate = '<p><span>'.__('Date to come','treize').'</span></p>';
}
if($informations['date']['date_always']){
    $showDate = '<p><span>'.__('Always available','treize').'</span></p>';
}
$reserveSectionGrey = false;

if($buttonReserveTicket['full']){
    $reserveSectionGrey = true;
    $reserveSection = '<p>'.__('Full','treize').'</p>';
}
$date_limite = date_i18n( $dateFormat, strtotime( $informations['date']['date_limite'] ) );

if( (strtotime($date_limite) < strtotime(date('d-m-Y'))) or  (strtotime($end) < strtotime(date('d-m-Y'))) ){
    $reserveSectionGrey = true;
    if($buttonReserveTicket['link_ended']){
        $reserveSection = ' <a class="btn ivado" href="'.$buttonReserveTicket['link_ended'].'"  target="_blank"> 
        <div class="label">'.$buttonReserveTicket['label_ended'].'</div> 
            </a>';
    }else{
        $reserveSection = '<a class="btn ivado is_disabled"> <div class="label">'.$buttonReserveTicket['label_ended'].'</div></a>' ;
    }
}

?>
<!-- <?php echo date('l jS F Y'); ?> -->
<section class="content__section information-single-event">
    <div class="container">
        <div class="when">
            <p><?php _e('When','treize') ; ?></p>

            <?php
            if( have_rows('informations')) {
                the_row();
                if( have_rows('date')) {
                    the_row();
                    if(get_field('informations')['date']['texte_dates']) { ?>
                        <p>
                            <?php echo get_field('informations')['date']['texte_dates']; ?>
                    </p>
                    <?php }
                    else if(have_rows('plusieurs_dates')) {
                        if($clc == "fr") { 
                            $dateFormat = 'l j F Y';
                        } else {
                            $dateFormat = 'l F j, Y';
                        }
                        echo "<div class='event-dates plusieurs-dates'>";
                        while (have_rows('plusieurs_dates')) {
                            the_row();
                            echo "<div><div class='plus_date'>";
                            echo date_i18n( $dateFormat, strtotime( get_sub_field( "une_date"))) . " ";
                            echo "</div>";
                            if( get_sub_field("debut") ) { 
                                echo "<div class='plus_heure'>";
                                echo get_sub_field("debut") . " - " . get_sub_field("fin");
                                echo "</div>";
                            }
                            echo "</div>";
                        }
                        echo "</div>";
                    } else {            
                        echo  $showDate ; 
                        if(!$informations['date']['datetbd'] && strtotime($end) > strtotime(date('d-m-Y'))){ ?>
                            <a class="" href=""  target='_blank'> 
                                <div title="Add to Calendar" class="addeventatc informations-button">
                                    <?php _e("Add to my calendar", 'add-to-my-calendar-treize') ; ?>
                                    <span class="start"><?php echo $start . " " . $beginHour; ?></span>
                                    <span class="end"><?php echo $end . " " . $endHour ; ?></span>
                                    <span class="timezone">America/Toronto</span>
                                    <span class="title"><?php echo get_the_title() ;?></span>
                                    <span class="description"><?php echo $informations['location']; ?></span>
                                    <span class="location"><?php echo $informations['address']; ?></span>
                                </div> 
                            </a>
                <?php   }
                    }
                }
            }?>
           
        </div>

        <div class="where">
            <p><?php _e('Where','treize') ; ?></p>
            <p><?php echo $informations['location']; ?></p>
            <?php if($informations['address']){ ?>
                <a href="http://maps.google.com/?q=<?php echo $informations['address'] ; ?>" target='_blank'><?php _e('Show on map','treize'); ?></a>
            <?php } ?>
        </div>

        <div class="price">
            <p><?php _e('Price','treize') ; ?></p>
            <p><?php echo $informations['price'] ?></p>
        </div>

        <div class="<?php 
        if($reserveSectionGrey){
            echo 'grey-reserve';
        }else{
            echo 'reserve'; 
        }?>">
        <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3210289&conversionId=3748636&fmt=gif" />
            <?php echo  $reserveSection ; ?>
        </div>
    </div> 
</section>