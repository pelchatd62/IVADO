<section class="content__section <?php echo $option ; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>     
    <div class="wrapp both">
        <div class="photo_cta-container">
            <?php if( $row['title'] ) {
                echo "<h2>" . $row['title'] . "</h2>";
            } ?>
            <div class="container-image">
                <img class="image lozad image-ratio" data-src="<?php echo $row['image']['sizes']['less-large'] ; ?>" alt="<?php echo $row['image']['alt'] ? $row['image']['alt'] : __('Ivado\'s image','treize') ; ?>" >
            </div>  
            <?php   if($row['label']){ ?>
            <a <?php echo $row['link_choice'] ? '' : 'target="_blank"' ; ?> class="btn ivado" href="<?php echo $row['link_choice'] ? $row['internal_link'] : $row['external_link'] ; ?>"> 
                <div class="label"><?php echo $row['label']?></div> 
            </a>
<?php   } ?>  
        </div>
    </div>
</section>