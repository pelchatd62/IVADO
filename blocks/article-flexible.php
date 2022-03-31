<?php
$flexible = get_field('article_flexible', $object );
if( $flexible ):
	foreach( $flexible as $rowIndex => $row ):
		//Setup Options
		$layout = $row['acf_fc_layout'];
		// $options .= $row['section_id'] ? ' id="' . $row['section_id'] . '"' : '';
		include( locate_template( 'blocks/article-flexible/' . $layout . '.php', false, false ) );
	endforeach;
endif;
?>