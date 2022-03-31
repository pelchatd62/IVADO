<?php  
function personInfoPopUp_handler(){

	if( $_POST['run'] ){

		switch( $_POST['run'] ){

			case 'searcherinfo':
				$searcherId = $_POST['posts'];
				$types = $_POST['type'];
				showPopUp($searcherId, $types);
			break;
		}
	}
	die;
} 
function showPopUp($searcherId, $types){
	$searcherPost = get_post($searcherId);
	$resume = get_field('resume', $searcherId);
	$type = $types;
	include( locate_template('blocks/persons/info-box.php', false, false ) );
} 
add_action('wp_ajax_personInfoPopUp', 'personInfoPopUp_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_personInfoPopUp', 'personInfoPopUp_handler'); // wp_ajax_nopriv_{action}
?>
