
<?php
/* Template Name: Contact */
get_header();
function toAscii($str, $replace=array(), $delimiter='-') {
    if( !empty($replace) ) {
     $str = str_replace((array)$replace, ' ', $str);
    }
    setlocale(LC_CTYPE, 'fr_FR');
    $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
   
    return $clean;
   }
?>
	<div id="primary">
		<main id="main" role="main">
			<div id="page__content">
                <div id="homepage-hero" class="homepage-hero"></div>
				<div id="contact-page-full" class="wrapp both">
                    <section class="contact-section"> 
                        <h1 class="contact-title"> <?php echo get_field('title') ?> </h1>
                        <div class="sub-container">
                            <p class="contact-subtitle"><?php _e('Visit us' , 'treize') ; ?></p>
                            <a target="_blank" href="https://www.google.com/maps/place/IVADO/@45.5304828,-73.6160719,17z/data=!3m1!4b1!4m5!3m4!1s0x4cc9194007ead403:0x6392f23c6c0a4231!8m2!3d45.5304828!4d-73.6138779"> 
                                <p class="contact-address"> <?php echo get_field('adresse'); ?> </p>  
                            </a>
                        </div>
                        <div class="sub-container">
                            <p class="contact-subtitle"><?php _e('Follow us' , 'treize') ; ?></p>
                            <div class="networks">
                                <a target="_blank" href="<?php echo get_field('general','option')['reseaux_sociaux']['facebook']; ?>"><i class="fab fa-facebook-f"></i></a>
                                <a target="_blank" href="<?php echo get_field('general','option')['reseaux_sociaux']['twitter']; ?>"><i class="fab fa-twitter"></i></a>
                                <a target="_blank" href="<?php echo get_field('general','option')['reseaux_sociaux']['linkedin']; ?>"><i class="fab fa-linkedin-in"></i></a>
                                <a target="_blank" href="<?php echo get_field('general','option')['reseaux_sociaux']['youtube']; ?>"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                        
                    </section>
                    <section class="contact-forms-section">
                        <div> 
                                <?php
                                    //gravity_form( 1, false, false, false, null, false, true );
                                    $nbForms = 8;
                                    $forms = get_field('forms');
                                    for($i = 1; $i <= $nbForms; $i++){
                                        $form = $forms['form_' . $i];
                                        if($form['show']){ ?>
                                        <div class="form-button" data-name="<?php echo toAscii($form['name']); ?>" data-id="<?php echo $i ;?>">
                                            <p> <?php echo $form['name']; ?> </p>
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/svg/chevron-droit.svg' ?>" alt="<?php _e('Arrow right', 'carousel_right_arrow-treize') ; ?>">
                                        </div>           
                                        <?php }
                                    }
                                ?> 
                        </div>
                    </section>
                </div>
                <div id="forms-container">
                    <div class="closing-area"></div>                
                    <div id="close-form-button" class="x-button"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/svg/cross.svg'; ?>" alt="<?php _e('Cross','treize'); ?>"></div>
                    <?php 
                        for($i = 1; $i <= $nbForms; $i++){ 
                            $formName = 'form_'.$i; ?>
                             <div id="<?php echo $formName ;?>" data-name="<?php echo toAscii($forms[$formName]['name']); ?>" class="ivado-form"> 
                                <h3 class="form-title"> <?php echo $forms[$formName]['title']?> </h3>
                                <div class="form-description wisi"> <?php echo $forms[$formName]['description']?> </div>
                                <?php if($forms[$formName]['condition']){
                                    echo "<div class='film'></div>";
                                    echo "<div class='bouton_popup'>" . __('Read conditions', 'treize');  
                                        echo "<div class='wisi popup_conditions'>". $forms[$formName]['popup_conditions'];
                                            echo "<div class='close_popup'>" . __('Close', 'treize' ) . "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                    // echo "<div class='condition'><label for='".$i."'>".$forms[$formName]['text_condition']."*</label><input id='".$i."' type='checkbox'></div>";
                                    } 
                                    echo '<div class="required-field"><em>* ' . __('indicates a required field', 'treize' ) . '</em></div>';
                                    ?>
                                <div class="form-wrapper">
                                    <?php gravity_form( $i, false, false, false, null, false, true ); ?>
                                </div>
                            </div>
                    <?php }
                    ?>
                </div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php wp_footer(); ?>