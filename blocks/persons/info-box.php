<?php 
if($type == "team"){
  $groupe = get_field('type_equipe', $searcherId); 
}elseif($type == "prof"){
  $groupe = get_field('type_professeur', $searcherId); 
}
else{
  $groupe = get_field('type_chercheur', $searcherId) ;
} 
$title = $groupe['title'];  
if( get_the_post_thumbnail_url( $searcherId)){
	$profilPic =  get_the_post_thumbnail_url( $searcherId,'cloud-logo');
}else{
 	$profilPic = get_stylesheet_directory_uri() . '/assets/images/profil_picture.png' ;	
}
?>
<div class="close-area"></div>
<div class="container">
    <div class="croix"><img src="<?php assets('svg/cross.svg'); ?>" alt="<?php _e('A cross to close content', 'pop-up-treize'); ?>"></div>
    <div class="content">
        <div>
            <div class="image">
                <img class="image-ratio" src="<?php echo $profilPic; ?>" alt="<?php echo get_the_title($searcherId); ?>">
            </div>
          <div class="personal-info">
<?php     if($groupe['phone']){
            echo "<a class='btn' href='tel:".$groupe['phone']."' target='_blank'><i class='far fa-phone'></i><span>".$groupe['phone']."</span></a>";
          }if($groupe['mail']){
            echo "<a class='btn' href='mailto:".antispambot($groupe['mail'])."' target='_blank'><i class='far fa-envelope'></i><span>".$groupe['mail']."</span></a>";
          }if($groupe['linkedin']){ ?>
            <a class='btn' href='<?php echo $groupe['linkedin'] ; ?>' target='_blank'><i class='<?php echo $type == "prof" ? "far fa-globe" : "fab fa-linkedin-in" ?>'></i><span><?php _e('View profile','treize') ; ?></span></a>
<?php     } ?>
          </div>
          <!-- <i class='far fa-globe'></i> -->
        </div>
        <div>
            <h2><?php echo get_the_title($searcherId); ?></h2>
<?php         if($groupe['institution_link']){echo "<a class= 'institute link' target='_blank' href='".$groupe['institution_link']."'>" ;} ?>
<?php         if($groupe['institution_label']): ?>
                   <p class="institute"><?php echo $groupe['institution_label']; ?></p>
<?php         endif;?>
<?php         if($groupe['institution_link']){echo "</a>" ;} 
              if($title){
                echo "<p class='title'>".$title."</p>";
              } ?>
          <?php echo $resume; ?>
        </div>
    </div>
</div>