<section class="content__article <?php echo is_singular('projects') ? 'single-project' : 'article' ; ?> <?php echo is_singular('post') ? 'grey' : '' ; ?>" data-layout="<?php echo $layout ;?>" <?php echo is_singular('post') ? 'class="grey"' : '' ; ?>>     
    <div class="wrapp <?php echo is_singular('projects') ? 'single-project' : 'article' ; ?>">
        <div class="container <?php echo is_singular('projects') ? 'single-project' : 'article' ; ?> media">
            <?php if($row['choice']){ echo "<a href='".$row['link']."' data-fancybox >" ; } ?>
                <div class="media">
                    <?php if($row['choice']){ echo "<div class='btn play'><img src='".get_assets('svg/playblue.svg')."' alt='".__('Ivado\'s image','treize')."' ></div>" ; } ?>
                    <img class="image image-ratio lozad" data-src="<?php echo $row['image']['sizes']['size-1250'] ; ?>" alt="<?php echo $row['image']['alt'] ? $row['image']['alt'] : __('Ivado\s image','treize') ; ?>" >
                </div>
                <?php if($row['choice']){ echo "</a>" ;} ?>
        </div>
    </div>
</section>