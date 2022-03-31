<section class="content__article <?php echo is_singular('projects') ? 'single-project' : 'article' ; ?>" data-layout="<?php echo $layout ;?>">     
    <div class="wrapp <?php echo is_singular('projects') ? 'single-project' : 'article' ; ?>">
        <div class="container <?php echo is_singular('projects') ? 'single-project' : 'article' ; ?>">
            <div class="paragraph wisi"><?php echo $row['text'] ?></div>
        </div>
    </div>
</section>