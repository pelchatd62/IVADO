<?php $info = get_field('type_chercheur') ; ?>
<div class="solo-researcher info-pop-up">
    <div class="image lozad not-hidden know-more ajax-researcher" data-type='researcher' data-id-researcher=' <?php echo get_the_ID() ?>' data-background-image="<?php echo $info['image']['sizes']['archive-researcher'] ; ?>"></div>
    <div class="content">
        <h3 class='know-more ajax-researcher' data-type='researcher' data-id-researcher=' <?php echo get_the_ID() ?>'><?php the_title(); ?></h3>
<?php   if($info['title']){
            echo "<p class='researcher-title'>".$info['title']."</p>";
        }?>
<?php   if($info['institution_link']){echo "<a target='_blank' href='".$info['institution_link']."'>" ;} ?>
            <p class="institute"><?php echo $info['institution_label']; ?></p>
<?php   if($info['institution_link']){echo "</a>" ;} ?>

    </div>
</div>
