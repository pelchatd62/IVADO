<section class="content__section <?php echo $option; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>
    <div class="wrapp both">
        <?php if( $row['title'] ) {
            echo "<h2>" . $row['title'] . "</h2>";
        } ?>
        <?php 
            $repeaterIllustration = $row['repeater'];
            if($repeaterIllustration){
                foreach($repeaterIllustration as $illustration){
                    if( $illustration){
                        $image = $illustration['illustration_type'] ? $illustration['illustration_video'] : $illustration['illustration'] ;?>
                            <div class="illustration-container <?php if($illustration['illustration_right']){echo "illustration-reverse";}?> <?php if( $illustration['image_complete'] ) { echo " complete"; } ?>"> 
                                <div class="image-container <?php echo $illustration['svg'] ? 'svg' : '' ; ?>">
                                    <div class="illustration lozad not-hidden" data-background-image="<?php echo $image['sizes']['article-media']?>">
                                        <?php  if($illustration['illustration_type']) { ?>
                                            <a data-fancybox href="<?php echo $illustration['link_video']; ?>" class="image-video">
                                                <div class='btn play'><img src='<?php assets('svg/playblue.svg')?>' ></div>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="description-container">
                                    <div class="illustration-description wisi">
<?php                                   if($illustration['title']){ ?>
                                            <h3 class="<?php echo $illustration['color'] ? $illustration['color'] : '';  ?>"><?php echo $illustration['title'] ?></h3>        
<?php                                   } ?>    
                                        <?php echo $illustration['description'] ?>
                                    </div>
                                </div>
                            </div>
                       <?php 
                    }
                }
            }
        ?>
        <?php if($row['button']['title']){ ?>
            <a class="btn ivado illustration-button" href="<?php echo $row['button']['link'] ?>"  <?php if($row['button']['is_external_link']){echo "target='_blank'";}?> > 
                <div class="label"> <?php echo $row['button']['title'] ?> </div> 
            </a>
        <?php } ?>
    </div>
</section>