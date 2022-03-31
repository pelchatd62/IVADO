<?php 
if(get_field('about')['description']) : ?>
    <section class="content__section grey" data-layout="a_propos">
        <div class="wrapp both">
            <div class="container">
                <div class="content wisi">
                    <?php if(get_field('about')['image']['sizes']['large-size']){ ?>
                        <div class="image lozad not-hidden" data-background-image="<?php echo get_field('about')['image']['sizes']['less-large']; ?>"></div>
                    <?php }else{ ?>
                        <div class="image-blue">
                        </div>
                    <?php }?>
                    <h2 class="about-title"> <?php _e('Key informations', 'event-about-treize') ; ?> </h2>
                    <div> <?php echo get_field('about')['description'] ?></div>
                </div>
                
            </div>
        </div>
    </section>
<?php endif; ?>
