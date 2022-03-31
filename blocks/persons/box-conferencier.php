<?php 
if($prof){
    $info = get_field('type_professeur') ;
    $datatype = 'prof';
}elseif($conf){
    $info = get_field('type_conferencier');
}elseif($team){
    $info = get_field('type_equipe') ;
    $datatype = 'team';
} 
$image = get_the_post_thumbnail_url( get_the_ID()) ? get_the_post_thumbnail_url( get_the_ID(),'cloud-logo') :  get_stylesheet_directory_uri() . '/assets/images/profil_picture.png';
?>
<div class="solo-conferencier <?php echo $prof ? 'prof' : '' ;?> info-pop-up"  data-aos="<?php echo $repeater["animation"]; ?>" data-aos-delay="<?php echo $repeater["delai"]; ?>" >


<?php if($info['institution_link'] && $conf){echo "<a target='_blank' style='width: 100%' href='".$info['institution_link']."'>" ;} ?>
            
<div class="image lozad not-hidden know-more ajax-researcher" data-type="<?php echo $datatype ?>" data-id-researcher="<?php echo get_the_ID()?>" data-background-image="<?php echo $image;  ?>"></div>

<?php if($info['institution_link'] && $conf){echo "</a>"; } ?>

    
<?php   if($info['institution_link'] && $conf){echo "<a target='_blank' href='".$info['institution_link']."'>" ;} ?>

<?php   if($team || $prof):
            if(get_field('resume')):
                echo "<div class='know-more ajax-researcher' data-type='".$datatype."' data-id-researcher='".get_the_ID()."'>" ;
            endif;
        endif;
?>
            <h3><?php the_title(); ?></h3>
<?php if($team || $prof):
            if(get_field('resume')):
                echo "</div>" ;
            endif;
        endif;
?>
<?php   if($info['institution_link'] && $conf){echo "</a>" ;} ?>
    
    <p class="poste"><?php echo $info['title']; ?></p>
    <p class="citation"><?php echo $info['citation']; ?></p>
<?php   if($team == false):
            if($info['institution_link'] && $prof){echo "<a class='institute' target='_blank' href='".$info['institution_link']."'>" ;} ?>
            <p class="institute"><?php echo $info['institution_label']; ?></p>
<?php       if($info['institution_link'] && $prof){echo "</a>" ;} 
        endif;    
        /*if($team || $prof):
            if(get_field('resume')):
                echo "<p class='know-more ajax-researcher' data-type='".$datatype."' data-id-researcher='".get_the_ID()."'>".__('Know more', 'researcher')."</p>" ;
            endif;
        endif;
        */ ?>
</div>
