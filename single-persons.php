<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Treize
 */
get_header();
if(get_field('type_equipe')['title'] || get_field('type_equipe')['institution_label']):
	$groupe = get_field('type_equipe') ;
elseif(get_field('type_professeur')['title'] || get_field('type_professeur')['institution_label']):
	$groupe = get_field('type_professeur') ;
	$type = "prof" ;
elseif(get_field('type_chercheur')['title'] || get_field('type_chercheur')['institution_label']):
	$groupe = get_field('type_chercheur') ;
elseif(get_field('type_gouvernance')['title'] || get_field('type_gouvernance')['institution_label']):
	$groupe = get_field('type_gouvernance') ;
else:
	$groupe = get_field('type_conferencier') ;
endif;
$titre = $groupe['title'];  
if(get_the_post_thumbnail_url( get_the_ID())){
	$profilPic = get_the_post_thumbnail_url( get_the_ID(),'cloud-logo');
}else{
 	$profilPic = get_stylesheet_directory_uri() . '/assets/images/profil_picture.png' ;	
}
?>
	<div id="primary">
		<main id="main" class="site-main" role="main">
			<?php include( locate_template( 'blocks/small-hero.php', false, false ) );?>
			<div id="page__content">
				<div id="person-info-box" class="wisi content__section" style="display: block; opacity: 1;"><div class="close-area"></div>
					<div class="container">
						<div class="content">
							<div>
								<div class="image" style="background-image: url('<?php echo $profilPic; ?>');"></div>
								<div class="personal-info">
<?php     							if($groupe['phone']){
                                        echo "<a class='btn' href='tel:".$groupe['phone']."' target='_blank'><i class='far fa-phone'></i><span>".$groupe['phone']."</span></a>";
									}if($groupe['mail']){
										echo "<a class='btn' href='mailto:".antispambot($groupe['mail'])."' target='_blank'><i class='far fa-envelope'></i><span>".$groupe['mail']."</span></a>";
									}if($groupe['linkedin']){ ?>
										<a class='btn' href='<?php echo $groupe['linkedin'] ; ?>' target='_blank'><i class='<?php echo $type == "prof" ? "far fa-globe" : "fab fa-linkedin-in" ?>'></i> <?php _e('View profile', 'treize') ?> </a>
<?php     							} ?>
								</div>
							</div>
							<div>
								<h2><?php the_title(); ?></h2>
<?php         					if($groupe['institution_link']){echo "<a class= 'institute link' target='_blank' href='".$groupe['institution_link']."'>" ;} ?>
<?php         					if($groupe['institution_label']): ?>
									<p class="institute"><?php echo $groupe['institution_label']; ?></p>
<?php         					endif;?>
<?php         					if($groupe['institution_link']){echo "</a>" ;} 
								if($titre){
									echo "<p class='title'>".$titre."</p>";
								} 
								if(get_field('resume')){echo get_field('resume') ; } ?>
							</div>
						</div>
					</div></div>
			</div>	
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
