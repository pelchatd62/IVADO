<?php
    if(is_post_type_archive('partners')){
        $title = get_field('archive_partners','option')['title'];
        $background = get_field('archive_partners','option')['header_background']['sizes']['less-large'];
    } else if(is_post_type_archive('events')){
        $title = get_field('archive_events','option')['title'];
        $background = get_field('archive_events','option')['header_background']['sizes']['less-large'];
    }
    else if(is_post_type_archive('bourse')){
        $title = get_field('archive_bourses','option')['title'];
        $background = get_field('archive_bourses','option')['header_background']['sizes']['less-large'];
    }
    else if(is_singular('persons')){
        $title = get_the_title();
        $background = get_field('single_person','option')['hero_image']['sizes']['less-large'];
    }
    else if(is_post_type_archive('resultat')){
        $title = get_field('archive_resultats','option')['title'];
        $background = get_field('archive_resultats','option')['header_background']['sizes']['less-large'];
    }
    else{
        $title = get_the_title(get_queried_object_id(),'less-large');
        $background = get_the_post_thumbnail_url( get_queried_object_id(),'less-large');
    }
?>

<div id="page__header" class="small">
    <div class="blue-background burger-change"></div>
    <!-- <div class="grey-background"></div> -->
    <?php if( ! is_singular('persons')){ ?>
    <div class="wrapp both">
    
        <div class="banner">
            <div class="background" style="background-image: url('<?php echo $background ; ?>') ;"></div>
            <?php  
                if(is_singular('projects')) {
                    echo '<h1>' . __("Digital intelligence to...", 'archive-projects-treize') . '</h1>';
                }
            ?>
            <h1><?php echo $title ; ?> </h1>
            <?php  if(is_singular('projects')):
                if(get_field('name')){
                    echo "<p class='name'>".get_field('name')."</p>";
                }
            endif; ?>
        </div>
        
    </div>
    <?php } ?>
</div>
       