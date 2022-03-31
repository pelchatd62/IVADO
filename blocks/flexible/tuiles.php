<?php
    $tuiles = $row['tuiles'];
?>
<section id="tuiles" class="tuiles content__section <?php echo $option ; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?> style="background-color: <?php echo $row['couleur_fond'] ?>;">
    <div class="wrapp both">
        <div class="container-bourse">
<?php   if($row['title']){ ?>
            <h2><?php echo $row['title'] ; ?></h2> 
<?php   } ; ?>  
<?php       foreach($tuiles as $tuile): ?>
                <div class="bourse-box"  data-aos="<?php echo $tuile["animation"]; ?>" data-aos-delay="<?php echo $tuile["delai"]; ?>">
                    <a href="<?php echo $tuile['lien'] ?>" class="bourse">
                        <div class="image lozad not-hidden" data-background-image="<?php echo wp_get_attachment_image_src($tuile['image_tuile'],'archive-researcher')[0] ?>">
                        </div>
                        <div class="content">
                            <h3> <?php echo $tuile['texte'] ?> </h3>
                        </div>
                        <p class="more"><?php _e('Know more','treize') ; ?></p>
                    </a>
                </div>
<?php       endforeach; ?> 
        </div>
    </div>
</section>