<section class="content__article <?php echo is_singular('projects') ? 'single-project' : 'article' ; ?>" data-layout="<?php echo $layout ;?>">     
    <div class="wrapp article">
        <div class="container <?php echo is_singular('projects') ? 'single-project' : 'article' ; ?>">
        <div class="quote"></div>
            <div class="paragraph wisi white"><?php echo $row['text'] ?></div>
            <div class="who">
                <div class="name">
                    <p><?php echo $row['name'] ?></p>
                    <p><?php echo $row['post'] ?></p>
                </div>
            </div>
        </div>
    </div>
</section>