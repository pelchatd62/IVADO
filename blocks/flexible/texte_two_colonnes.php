<section class="content__section <?php echo $option ; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>  
    <a id="<?php echo $row['section_id'] ?>"></a>
    <div class="wrapp both">
        <?php if( $row['title'] ) {
            echo "<h2>" . $row['title'] . "</h2>";
        } ?>
        <div class="container paragraph wisi">
           <div style="width: <?php echo $row['largeur_colonne_gauche'] ?>%; background-color: <?php echo $row['fond_gauche'] ?>; background-image: url(<?php echo $row['image_fond_gauche']?>);" data-aos="<?php echo $row["animation_gauche"]; ?>"><?php echo $row['text_left'] ; ?></div>
           <div style="width: <?php echo 100 - $row['largeur_colonne_gauche'] ?>%; background-color: <?php echo $row['fond_droite'] ?>; background-image: url(<?php echo $row['image_fond_droite']?>);" data-aos="<?php echo $row["animation_droite"]; ?>"><?php echo $row['text_right'] ; ?></div>
        </div>
    </div>
</section>