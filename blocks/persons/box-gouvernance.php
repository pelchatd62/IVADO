<?php 
    $info = get_field('type_gouvernance');
?>
<div class="solo-gouvernance solo-conferencier">
    <h4><?php if( $info['lien_profil']) { ?>
        <a href="<?php echo $info['lien_profil']; ?>"> <?php the_title(); ?></a></h4>
    <?php } else {
        the_title();
    } ?>
    </h4>
    <p class="poste"><?php echo $info['title']; ?></p>
    <?php if($info['institution_link']){echo "<a class='institute' target='_blank' href='".$info['institution_link']."'>" ;} ?>
            <p class="institute"><?php echo $info['institution_label']; ?></p>
    <?php if($info['institution_link']){echo "</a>" ;} ?>
</div>