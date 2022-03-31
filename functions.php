<?php
/**
 * Treize functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Treize
 * 
 * 
 **/
/* -----------------------------------------------------------
>>> TABLE OF CONTENTS:
--------------------------------------------------------------
# Treize Setup's function
	## Supports' functions
	## Image Sizes
	## Menu Registered
# Content Width
# Scripts & Stylesheets
	## Stylesheets
	## Scripts
# Custom Log-in Panel
# Custom Dashboard
# Custom Post Types
# Custom Post Taxonomies
# ACF
-------------------------------------------------------------- */

// ================================= //
// === # Treize Setup's function === //
// ================================= //
if ( ! function_exists( 'treize_setup' ) ) :
	function treize_setup() {
	
		load_theme_textdomain( 'treize', get_template_directory() . '/languages' );
		// ## Supports' functions
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-background', apply_filters( 'treize_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		// ## Image Sizes 
		add_image_size( 'medium-size', 9999, 900, false );
		add_image_size( 'large-size', 1940, 9999, false );
		add_image_size( 'article-media', 1080, 9999, false );
		add_image_size( 'size-1250', 1250, 9999, false );
		add_image_size( 'archive-researcher', 730, 9999, false );
		add_image_size( 'cloud-logo', 380, 9999, false );
		add_image_size( 'less-large', 1620, 9999, false );
		// ## Menu Registered
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'treize' ),
			'menu-2' => esc_html__( 'Footer', 'treize' ),
		) );
		
	}
endif;
add_action( 'after_setup_theme', 'treize_setup' );
// ======================= //
// === # Content Width === //
// ======================= //
function treize_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'treize_content_width', 640 );
}
add_action( 'after_setup_theme', 'treize_content_width', 0 );
// ================= //
// === # Widgets === //
// ================= //
function treize_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'treize' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'treize' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'treize_widgets_init' );
// =============================== //
// === # Scripts & Stylesheets === //
// =============================== //
function treize_scripts() {
	// ## Stylesheets
    //Base Stylesheets
    wp_enqueue_style( 'treize-normalize', get_template_directory_uri() .'/css/normalize.css' );
    wp_enqueue_style( 'treize-style', get_stylesheet_uri() );
    //owl-carousel
    wp_enqueue_style( 'owl', get_template_directory_uri() .'/css/owl.carousel.min.css' );
    wp_enqueue_script( 'owl-carousel',  get_template_directory_uri() .'/js/owl.carousel.min.js', 'jquery', '4.0', true);
    //owl-theme-carousel
    wp_enqueue_style( 'owl-theme', get_template_directory_uri() .'/css/owl.theme.default.min.css' );
    wp_enqueue_script( 'slider',  get_template_directory_uri() .'/js/slider.js', 'jquery', '4.0', true);

// ## Scripts
    //Base Scripts
    wp_enqueue_script( 'treize-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'treize-contact-form-hashchange', get_template_directory_uri() . '/js/contact-form-hashchange.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'treize-contact', get_template_directory_uri() . '/js/contact.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'treize-scroll', get_template_directory_uri() . '/js/animatescroll.js', 'jquery', '4.0', true);
    wp_enqueue_script( 'treize-three', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/94/three.min.js', 'jquery', '4.0', true);
    wp_enqueue_script( 'three-canvas', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/143797/CanvasRenderer.js', 'jquery', '4.0', true);
    wp_enqueue_script( 'three-projector', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/143797/Projector.js', 'jquery', '4.0', true);
    if( is_page( 493 ) || is_page( 5541 ) || is_front_page() ) {
        wp_enqueue_script( 'treize-wave', get_template_directory_uri() . '/js/animation-wave.js', 'jquery', '4.0', true);
    }
    // wp_enqueue_script( 'treize-wave-header', get_template_directory_uri() . '/js/animation-wave-header.js', 'jquery', '4.0', true);
    if( is_front_page() ) {
        wp_enqueue_script( 'treize-front-page-scroll', get_template_directory_uri() . '/js/front-page-scroll.js', 'jquery', '4.0', true);
    }
    wp_enqueue_script( 'treize-hover', get_template_directory_uri() . '/js/hover.js', 'jquery', '4.0', true);
    wp_enqueue_style( 'flickity-css', 'https://unpkg.com/flickity@2/dist/flickity.min.css' );
    wp_enqueue_script( 'treize-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    wp_enqueue_script( 'treize-html5shiv', 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js' );
    wp_script_add_data( 'treize-html5shiv', 'conditional', 'lt IE 9' );
    //Libraries
    wp_enqueue_script( 'tweenmax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js', 'jquery', '4.0', true);
    //Font Awesome
    wp_enqueue_script( 'fa', 'https://kit.fontawesome.com/9539396031.js', '', '', true);
    //CountUp
    wp_enqueue_script( 'count-up',  get_template_directory_uri() .'/js/countUp/countUp.js', 'jquery', '4.0', true);
    
    if(is_singular('events')){
        //AddEvent to Calendar
        wp_enqueue_script('add-event', 'https://addevent.com/libs/atc/1.6.1/atc.min.js', 'jquery', '4.0', true);
    }
    if(!is_front_page()){
        // flickity
		wp_enqueue_script( 'flickity-library', 'https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', 'jquery', '4.0', true);
		wp_enqueue_script( 'flickity-carousel', get_template_directory_uri() . '/js/flickity.js', array( 'jquery' ), '', true );
        // fancybox
        wp_enqueue_style( 'fancy-css', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' );
        wp_enqueue_script( 'fancy-js', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', 'jquery', '4.0', true);
    }
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    //if ( is_page_template('tpl-rapport.php') ) {
        wp_enqueue_style('AOS_animate', 'https://unpkg.com/aos@2.3.1/dist/aos.css', false, null);
        wp_enqueue_script('AOS-script', 'https://unpkg.com/aos@2.3.1/dist/aos.js', false, null, true);
    //} 
}
add_action( 'wp_enqueue_scripts', 'treize_scripts' );

// ============================= //
// === # Custom Log-in Panel === //
// ============================= //
function my_custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/custom-login.css" />';
}
add_action('login_head', 'my_custom_login');
function my_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url_title() {
	return 'Bonjour';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
// ========================== //
// === # Custom Dashboard === //
// ========================== //
add_action( 'admin_menu', 'my_admin_menu' );
function my_admin_menu() {
	global $user_ID;
	if( get_current_user_id() != 1 ){
		//remove_menu_page( 'index.php' );                  		//Dashboard
		remove_menu_page( 'edit-comments.php' );          		//Comments
		// remove_menu_page( 'themes.php' );                 		//Appearance (Salient)
		//remove_menu_page( 'plugins.php' );               		//Plugins
		// remove_menu_page( 'users.php' );                  		//Users
		//remove_menu_page( 'tools.php' );                 		//Tools
		//remove_menu_page( 'options-general.php' );        		//Settings
	}
}
/* Disable WordPress Admin Bar for all users but admins. */ 
show_admin_bar(false);  

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	global $user_ID;
	if( get_current_user_id() != 1 && is_user_logged_in()){
		show_admin_bar(true);
	}
}

// ========================== //
// === # Custom Post Types == //
// ========================== //
include( locate_template('custom-taxonomy_post-type/post-type.php', false, false ) );
// ========================== //
// === # Custom Taxonomies == //
// ========================== //
include( locate_template('custom-taxonomy_post-type/taxonomy.php', false, false ) );	

// ================== //
// === # Functions == //
// ================== //

// ================== //
// === # Globals ==== //
// ================== //

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

// shortcut for get template url
function assets($path) {
    echo get_bloginfo("template_url") . '/assets/' . $path;
}
function get_assets($path) {
    return get_bloginfo("template_url") . '/assets/' . $path;
}
// ================== //
// === Ajax project == //
// ================== //

function ajax_scripts() {
	global $wp_query; 
	// Filtre article
	wp_register_script( 'articleChoiceCategroy', get_stylesheet_directory_uri() . '/js/ajax-function/article-filters.js', array('jquery') );
	wp_localize_script( 'articleChoiceCategroy', 'articleChoice', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
	wp_enqueue_script( 'articleChoiceCategroy' );
	
	// pop-up info
	wp_register_script( 'personInfoPopUp', get_stylesheet_directory_uri() . '/js/ajax-function/person-info.js', array('jquery') );
	wp_localize_script( 'personInfoPopUp', 'personInfo', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
	wp_enqueue_script( 'personInfoPopUp' );

	// page projects
	wp_register_script( 'projectCall', get_stylesheet_directory_uri() . '/js/ajax-function/projects.js', array('jquery') );
	wp_localize_script( 'projectCall', 'projectInfo', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
	wp_enqueue_script( 'projectCall' );

	// page partners
	wp_register_script( 'partnerCall', get_stylesheet_directory_uri() . '/js/ajax-function/partner.js', array('jquery') );
	wp_localize_script( 'partnerCall', 'partnerInfo', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
	wp_enqueue_script( 'partnerCall' );
    
    // page formations
	wp_register_script( 'formationsCall', get_stylesheet_directory_uri() . '/js/ajax-function/formations.js', array('jquery') );
	wp_localize_script( 'formationsCall', 'formationsInfo', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        'posts' => json_encode( $wp_query->query_vars ),
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
	wp_enqueue_script( 'formationsCall' );

	wp_localize_script( 'formationsFilterCall', 'formationsInfo', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
	wp_enqueue_script( 'formationsFilterCall' );

    // page formations en ligne
	wp_register_script( 'onlineFormationsCall', get_stylesheet_directory_uri() . '/js/ajax-function/formation-en-ligne.js', array('jquery') );
	wp_localize_script( 'onlineFormationsCall', 'onlineFormationsInfo', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        'posts' => json_encode( $wp_query->query_vars ),
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
	wp_enqueue_script( 'onlineFormationsCall' );

	wp_localize_script( 'onlineFormationsFilterCall', 'onlineFormationsInfo', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
	wp_enqueue_script( 'onlineFormationsFilterCall' );

    // filter archive event
    $version_script = filemtime( get_stylesheet_directory() . '/js/calendar-event.js' );
    wp_register_script( 'calendarEvents', get_template_directory_uri() . '/js/calendar-event.js', array( 'jquery' ), $version_script, true );
	wp_localize_script( 'calendarEvents', 'cEvent', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
	wp_enqueue_script( 'calendarEvents' );

    // page resultat
    if ( is_post_type_archive( 'resultat' ) ) { /*************** load seulement sur page archive **********/
        $version_script = filemtime( get_stylesheet_directory() . '/js/ajax-function/result.js' );
        wp_register_script( 'resultCall', get_stylesheet_directory_uri() . '/js/ajax-function/result.js', array('jquery'), $version_script, true );
        /*wp_localize_script( 'resultCall', 'resultInfo', array(
            'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
            'posts' => json_encode( $wp_query->query_vars ),
            'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
            'max_page' => $wp_query->max_num_pages
        ) );*/
        wp_enqueue_script( 'resultCall' );
    }
}
add_action( 'wp_enqueue_scripts', 'ajax_scripts' );


//add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);
function add_type_attribute($tag, $handle, $src) {
    if ( 'calendarEvents' !== $handle ) {
        return $tag;
    }
    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}


// events
include( locate_template('ajax-function/calendar-event.php', false, false ) );
// include( locate_template('ajax-function/calendar-event-search.php', false, false ) );

// pop-up info
include( locate_template('ajax-function/pop-up-info.php', false, false ) );

// blog
include( locate_template('ajax-function/article.php', false, false ) );

// page projects
include( locate_template('ajax-function/projects.php', false, false ) );

// page partners
include( locate_template('ajax-function/partners.php', false, false ) );

// page résultat
include( locate_template('ajax-function/resultat.php', false, false ) );

//lozad
wp_enqueue_script( 'lozad-js', 'https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js', '', '', true);

// page formations
include( locate_template('ajax-function/formations.php', false, false ) );
include( locate_template('ajax-function/formations-filter.php', false, false ) );
include( locate_template('ajax-function/online-formations.php', false, false ) );
include( locate_template('ajax-function/online-formations-filter.php', false, false ) );

// ================== //
// === Ajax project == //
// ================== //


// clc
$clc = apply_filters( 'wpml_current_language', null );



// Remove tags(blog) from admin
add_action('admin_menu', 'my_remove_sub_menus');

function my_remove_sub_menus() {
    // remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}

// Remove Categories and Tags
add_action('init', 'myprefix_remove_tax');
function myprefix_remove_tax() {
    register_taxonomy('post_tag', array());
}

//Tiny MCE modifications
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );
function my_add_mce_button() {
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'my_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'my_register_mce_button' );
	}
}
add_action('admin_head', 'my_add_mce_button');
function my_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['my_mce_button'] = get_template_directory_uri() .'/js/mce-button.js';
	return $plugin_array;
}
function my_register_mce_button( $buttons ) {
	array_push( $buttons, 'external_link' );
	return $buttons;
	//Tiny MCE modifications
}

function pre_get_posts_general( $query ) {
	if( !is_admin() ){
		// add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby_ignore', 10, 3);
			if( is_post_type_archive('bourse') ){
				if( $query->is_main_query() ){
					$query->set('posts_per_page', -1);
				}   			
			}
			if( is_post_type_archive('projects') ){
				if( $query->is_main_query() ){
					$query->set('posts_per_page', 6);
				}   			
			}
			if( is_home() ){
				if( $query->is_main_query() ){
					$query->set('posts_per_page', 6);
				}   			
			}
	}
 }
 add_action( 'pre_get_posts', 'pre_get_posts_general' ); 


// redirect 301 dont needed single
add_action( 'template_redirect', 'wpse_128636_redirect_post' );

function wpse_128636_redirect_post() {
	if( !is_admin()){
		if ( is_singular( 'resultat' ) || is_singular( 'partners' )) {
			wp_redirect( home_url(), 301 );
			exit;
		}
	}	
  
}

add_filter( 'pto/posts_orderby/ignore', 'pto_posts_orderby', 10, 3);
// enable manual sorting from POST TYPE ORDER
function pto_posts_orderby($ignore, $orderBy, $query)
{
	$ignore = FALSE;

	return $ignore;
}
// disable manual sorting from POST TYPE ORDER
function pto_posts_orderby_ignore($ignore, $orderBy, $query)
{
	$ignore = TRUE;
	return $ignore;
}

// gform_button
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    return "<button class='btn ivado gform_button' id='gform_submit_button_{$form['id']}'><span class='label'>{$form['button']['text']}</span></button>";
}



// date picker translation
add_action( 'gform_enqueue_scripts', 'add_datepicker_regional', 11 );
function add_datepicker_regional() {
    if ( wp_script_is( 'gform_datepicker_init' ) ) {
        wp_enqueue_script( 'datepicker-regional', get_template_directory_uri() . '/js/datepicker-fr-CA.js', array( 'gform_datepicker_init' ), false, true );
        remove_action( 'wp_enqueue_scripts', 'wp_localize_jquery_ui_datepicker', 1000 );
    }
}

/********************************************************************** */


/**********************************************************************
 * 
 *                Insérer espace insécable devant le : etc.
 * 
 **********************************************************************/

function new_content($content) {
    $content = str_replace(' :','&nbsp;:', $content);
    $content = str_replace(' $','&nbsp;$', $content);
    $content = str_replace(' »','&nbsp;»', $content);
    $content = str_replace('« ','«&nbsp;', $content);
    $content = str_replace(' k$','&nbsp;k$', $content);
    $content = str_replace(' $','&nbsp; $', $content);
    $content = str_replace('1er ','1<sup style="text-transform:none;">er</sup> ', $content);
    $content = str_replace('1ere ','1<sup style="text-transform:none;">ère</sup> ', $content);
    $content = str_replace('1ers ','1<sup style="text-transform:none;">ers</sup> ', $content);
    $content = str_replace('1st ','1<sup style="text-transform:none;">st</sup> ', $content);
    $content = str_replace('2e ','2<sup style="text-transform:none;">e</sup> ', $content);
    $content = str_replace(' ?','&#8239;?', $content);
    $content = preg_replace('/(?<=\d)\s(?=\d)/','&nbsp;', $content);
    return $content;
}
add_filter( 'the_content','new_content');
add_filter( 'the_title', 'new_content');

function new_term($term) {   
    if (!is_admin()) {
        $term->name = new_content( $term->name );
    }
    return $term;
}
add_filter( 'get_term', 'new_term');

function my_acf_load_value( $content, $post_id, $field ) {
    if( is_string($content) ) {
        $content = new_content($content);
    }
    return $content;
}
add_filter('acf/load_value/type=textarea', 'my_acf_load_value', 10, 3);
add_filter('acf/load_value/type=wysiwyg', 'my_acf_load_value', 10, 3);


/**********************************************************************
 * 
 *            Nombre mots maximum et minimum dans champs
 * 
 **********************************************************************/

add_action( 'gform_field_advanced_settings', 'my_advanced_settings', 10, 2 );
function my_advanced_settings( $position, $form_id ) {
 
    //create settings on position 50 (right after Admin Label)
    if ( $position == 50 ) {
        ?>
        <li class="max_min_setting field_setting">
            <label for="field_admin_label">
                <?php _e("Word count", "gravityforms"); ?>
                <?php gform_tooltip("form_field_max_min_value") ?>
            </label>
            <input type="number" id="field_minimum_value" onblur="SetFieldProperty('min_Field', this.value);"/> Minimum<br>
            <input type="number" id="field_maximum_value" onblur="SetFieldProperty('max_Field', this.value);"/> Maximum
        </li>
        <?php
    }
}
 
//Action to inject supporting script to the form editor page
add_action( 'gform_editor_js', 'editor_script' );
function editor_script(){
    ?>
    <script type='text/javascript'>
        //adding setting to fields of type "textarea"
        fieldSettings.textarea += ", .max_min_setting";
 
        //binding to the load field settings event to initialize the checkbox
        jQuery(document).on("gform_load_field_settings", function(event, field, form){
            if (field.type === 'textarea') {
                jQuery("#field_minimum_value").val( field["min_Field"] );
                jQuery("#field_maximum_value").val( field["max_Field"] );
            }
        });
    </script>
    <?php
}
 
//Filter to add a new tooltip
add_filter( 'gform_tooltips', 'add_max_min_tooltips' );
function add_max_min_tooltips( $tooltips ) {
   $tooltips['form_field_max_min_value'] = "<h6>Mots</h6>Entrez le minimum et maximum de mots de ce champ";
   return $tooltips;
}

// Validate Form Submission
add_filter( 'gform_validation', 'general_validation' );
function general_validation( $validation_result ) {
    $form = $validation_result['form'];
    foreach ( $form['fields'] as &$field ) {
        if ( ( $field->type == 'textarea' ) && ! ( empty( $field->min_Field ) && empty( $field->max_Field )) ) {
            $input_name = 'input_' . $field->id;
            if ( isset( $_POST[ $input_name ] ) && $_POST[ $input_name ] != '' ) {
                $words_number = count( preg_split('/\s+/', $_POST[ $input_name ] ));
                if ( ( $words_number < (int) $field->min_Field ) && ! empty( $field->min_Field ) ) {
                    $field->failed_validation      = true;
                    $field->validation_message     = 'Le champ doit contenir un minimum de ' . $field->min_Field . ' mots';
                    $validation_result['is_valid'] = false;
                } 
                if ( ( $words_number > (int) $field->max_Field ) && ! empty( $field->max_Field )  ) {
                    $field->failed_validation      = true;
                    $field->validation_message     = 'Le champ doit contenir un maximum de ' . $field->max_Field . ' mots';
                    $validation_result['is_valid'] = false;
                }
            }
        }
    }
    $validation_result['form'] = $form;

    return $validation_result;
}

add_action("gform_field_css_class", "custom_class", 10, 3);
function custom_class($classes, $field, $form){
    if( ( $field["type"] == "textarea") && ( isset( $field['min_Field'] ))  ) {
        if ($field['min_Field'] != "" ){
            $classes .= " min min_" . $field['min_Field'];
        }
    }
    if( ( $field["type"] == "textarea") && ( isset( $field['max_Field'] ))  ) {
        if ($field['max_Field'] != "" ){
            $classes .= " max max_" . $field['max_Field'];
        }
    }
    if( ( isset( $field['min_Field'] )) || ( isset( $field['max_Field'] )) ) {
        if ( ($field['min_Field'] != "" ) || ($field['max_Field'] != "") ) {
            $classes .= " min-max";
        }
    }
    return $classes;
}
// custom langage switcher
function custom_language_switcher() {
    $items = '';
    if ( function_exists('icl_get_languages') ) {
        $languages = icl_get_languages('skip_missing=0');
        if(!empty($languages)){
            $items = "work";
            $items = '<ul>';
            foreach($languages as $l){
                if(!$l['active']){
                    $items = $items . '<li class="menu-item"><a href="' . $l['url'] . '">' . $l['native_name'] . '</a></li>';}
            }
            $items .= '</ul>';
        }
    }
    echo $items;
}

// enlever <p> tag dans description catégorie bourse
remove_filter('term_description','wpautop');

/********************  Enqueue script & CSS  ***********************/
function ivado_scripts() {
    $version_script = filemtime( get_stylesheet_directory() . '/js/main.js' );
    wp_register_script( 'main-script', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), $version_script, true );
    wp_enqueue_script( 'main-script' );
    $version_style = filemtime( get_stylesheet_directory() . '/css/style.css' );
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/css/style.css', array(), $version_style, 'all'  );
}
add_action( 'wp_enqueue_scripts', 'ivado_scripts', 10 );

// Update CSS within in Admin
function admin_style() {
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
  }
add_action('admin_enqueue_scripts', 'admin_style');

/****  Ajouter la date de début et fin des événementnements à l'admninistration  ****************/
function ajout_events_columns( $columns ) {
    return array_merge ( $columns, array ( 
        'start_date' => __ ( 'Date début' ),
        'end_date'   => __ ( 'Date fin' ) 
      ) );
  return $columns;
}
add_filter( 'manage_events_posts_columns', 'ajout_events_columns' );

function ajout_event_column ( $column, $post_id ) {
    switch ( $column ) {
      case 'start_date':
        echo substr( get_field('informations')['date']['start_date'], 0, -9);
        break;
      case 'end_date':
        echo substr( get_field('informations')['date']['enddate'], 0, -9);
        break;
    }
 }
 add_action ( 'manage_events_posts_custom_column', 'ajout_event_column', 10, 2 );

 function my_column_register_sortable( $columns ) {
	$columns['start_date'] = 'start_date';
	$columns['end_date'] = 'end_date';
	return $columns;
}
add_filter('manage_edit-events_sortable_columns', 'my_column_register_sortable' );

/************************ Ajouter search pour CPT *********************/
add_filter( 'pre_get_posts', 'custom_post_type_search' );
function custom_post_type_search( $query ) {
    if ( $query->is_search() && $query->is_main_query() ) {
        if ( is_admin() ) {
            $query->set('post_type', array( 'post', 'page', 'events', 'projects', 'bourse', 'persons', 'resultat', 'partners' ));
        } else {
            $query->set('post_type', array( 'post', 'page', 'events', 'projects', 'bourse', 'persons', ));
        }
        $query->set( 'posts_per_page', '100' );
    }
    return $query;
}

/************************ Ajouter classe au body *********************/
add_filter( 'body_class','mes_classes_body' );
function mes_classes_body( $classes ) {
    $classes[] = get_field( "body-class" );
    return $classes;
}

/************************ Bouton CTA dans éditeur *********************/

add_action( 'init', 'CTA_bouton' );
function CTA_bouton() {
    add_filter( "mce_external_plugins", "CTA_add_bouton" );
    add_filter( 'mce_buttons', 'CTA_register_bouton' );
}
function CTA_add_bouton( $plugin_array ) {
    $plugin_array['CTA_bouton'] = get_template_directory_uri() . '/js/tiny-code-btn.js';
    return $plugin_array;
}
function CTA_register_bouton( $buttons ) {
    array_push( $buttons, 'CTA_bouton'); // droid_title
    return $buttons;
}
function CTA_bouton_fonction( $atts=array(), $content = null ) {
    $a = shortcode_atts( array(
        'lien' => '#',
        'centre' => 'centre',
        ), $atts );
        if ( $a['centre'] == "true" ) {
            $alignement = "centre";
        } else {
            $alignement = "";
        }
    $output = '<a class="btn ivado cta ' .  $alignement . '" href="' . esc_url( $a['lien']) . '"><div class="label">' . $content . '</div></a>';
    return $output;
}
add_shortcode( 'CTA_shortcode', 'CTA_bouton_fonction' );

/************* Empêcher les redirections lorsqu'on change url *************/
remove_action('template_redirect', 'wp_old_slug_redirect');

/************* Ajouter classe langage à body dans admin *************/
function admin_body_classes( $classes ) { 
    $classes .= " " . ICL_LANGUAGE_CODE . " ";
    return $classes;
}
add_filter( 'admin_body_class', 'admin_body_classes' );