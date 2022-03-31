<?php 
if($row['text']) : ?>
    <section class="content__section grey" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?> >
        <div class="wrapp both">
            <div class="container">
                <div class="content wisi">
                    <div class="image lozad not-hidden" data-background-image="<?php echo $row['image']['sizes']['less-large']; ?>"></div>
                    <?php if( $row['title'] ) {
                        echo "<h2 class='about-title'>" . $row['title'] . "</h2>";
                    } ?>
                    <div> <?php echo $row['text']; ?></div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>