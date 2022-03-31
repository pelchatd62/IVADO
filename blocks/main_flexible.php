<?php
$flexible = get_field('flexible', $object );
if(is_post_type_archive('events')){
   $flexible = get_field('archive_events', 'option')['flexible'];
}
if(is_post_type_archive('partners')){
   $flexible = get_field('archive_partners', 'option')['flexible'];
}
if(is_post_type_archive('bourse')){
   $flexible = get_field('archive_bourses', 'option')['flexible'];
}
if(is_post_type_archive('resultat')){
   $flexible = get_field('archive_resultats', 'option')['flexible'];
}
if(is_post_type_archive('projects')){
	$flexible = get_field('archive_projects', 'option')['flexible'];
}
if(is_home()){
	$flexible = get_field('archive_blog', 'option')['flexible'];
}

if( $flexible ):
	foreach( $flexible as $rowIndex => $row ):
		//Setup Options
		$layout = $row['acf_fc_layout'];
		if($row['grey_choice']){
			$option= "grey";
		}else{
			$option="";
		}
		// $options .= $row['section_id'] ? ' id="' . $row['section_id'] . '"' : '';
		include( locate_template( 'blocks/flexible/' . $layout . '.php', false, false ) );
	endforeach;
endif;
?>