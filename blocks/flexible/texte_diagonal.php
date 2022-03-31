<section class="content__section <?php echo $option; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>
    <div class="container"> 
<?php   if($row['image']['sizes']['less-large']) { ?>
            <div class="image-container-diag">
                <div class="image">
                    <img class="lozad image-ratio" data-src="<?php echo $row['image']['sizes']['less-large'] ; ?>" alt="<?php echo $row['image']['alt'] ? $row['image']['alt'] : __('Ivado\'s image','treize') ?>">
                </div>
            </div>
<?php   } ?>        
        <div class="content wisi white <?php echo ($row['image']['sizes']['less-large']) ? "" : "pas-marge" ?>">
            <h2><?php echo $row['title'] ; ?></h2>
            <?php echo $row['text'] ; ?></div>
    </div>
</section>