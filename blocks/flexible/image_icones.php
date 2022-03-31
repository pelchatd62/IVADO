<?php 
if($row['no_image']){
    $noImage = "no-image";
}else{
    $noImage = "";
}
; ?>
<section class="content__section <?php echo $noImage; ?> <?php echo $option; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>
    <div class="wrapp <?php echo $row['no_image'] ? 'both' : 'right' ;  ?>">
        <?php if( $row['title'] ) {
            echo "<h2 class='image-icon-title'>" . $row['title'] . "</h2>";
        } ?>
        <div class="img-icon-container">
            <div class="image-container">
                <div class="front-image">
                    <img class="lozad image-ratio" data-src="<?php echo $row['front-image']['sizes']['article-media'] ; ?>" alt="<?php echo $row['front-image']['alt'] ? $row['front-image']['alt'] : __( 'Front Image', 'treize_image_icones' ); ?>" >
                </div>
                <div class="background-image">
                    <?php if( $row['background-image']) { ?>
                    <img class="lozad image-ratio" data-src="<?php echo $row['background-image']['sizes']['article-media'] ; ?>" alt=" <?php echo $row['background-image']['alt'] ? $row['background-image']['alt']: __( 'Background Image', 'treize_image_icones' ); ?>" >
                    <?php } else { ?>
                        <div class="blue-background"></div>
                    <?php } ?>
                </div>
            </div>
            <div class="rows">
                <?php $icons_texts = $row['row'];
                    if( $icons_texts ):
                        $colorsCount = 0;
                        foreach( $icons_texts as $icon_text ):?>
                            <div class="repeater-img-icon wisi">

                                <div class="title-icon">
                                    <div class="icon">
                                        <?php if($colorsCount == 4): $colorsCount = 0; endif;?>
                                        <div class="icon-background <?php echo 'background-color-' . $colorsCount?>"  > </div>
                                        <?php $colorsCount++; ?>
                                        <?php 
                                            if($icon_text['icon']):
                                        ?>
                                            <img class="lozad" data-src="<?php echo $icon_text['icon']['sizes']['cloud-logo'] ; ?>" alt="<?php echo $icon_text['icon']['alt'] ? $icon_text['icon']['alt'] : __( 'Icon', 'treize_image_icones' ); ?>" >
                                        <?php        
                                            endif ; 
                                        ?>
                                    </div>
                                </div>
                                <div class="text wisi">
                                    <?php if( $icon_text['label'] ): ?>
                                        <h3 class="title"><?php echo $icon_text['label']; ?></h3>
                                    <?php endif; ?>
                                    <?php echo $icon_text['description'] ?>
                                </div>
                            </div>
                <?php 
                        endforeach;
                    endif;
                if($row['button']['title'] && !$row['no_image']){ ?>
                    <a class="btn ivado services-link" href="<?php echo $row['button']['link'] ?>"  <?php if($row['button']['is_external_link']){echo "target='_blank'";}?> > 
                        <div class="label"> <?php echo $row['button']['title']; ?> </div> 
                    </a>
<?php           }    ?>
                
            </div>
<?php       if($row['button']['title'] && $row['no_image']){ ?>
            <div class="btn-container">   
                <a class="btn ivado services-link" href="<?php echo $row['button']['link'] ?>"  <?php if($row['button']['is_external_link']){echo "target='_blank'";}?> > 
                    <div class="label"> <?php echo $row['button']['title']; ?> </div> 
                </a>
            </div>     
<?php       }    ?>
        </div>
    </div>
</section>