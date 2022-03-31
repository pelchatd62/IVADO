<?php
$complete = "";
if (is_post_type_archive('projects')) {
    $title = get_field('archive_projects', 'option')['title_project'];
    $background = get_field('archive_projects', 'option')['header_background']['sizes']['large-size'];
    $video = get_field('archive_projects', 'option')['background_video'];
    $videoLink = get_field('archive_projects', 'option')['video_link'];
    $subtitle = get_field('archive_projects', 'option')['zone_hero_content'];
} else if (is_post_type_archive('partners')) {
    $title = get_field('archive_partners', 'option')['title'];
    $background = get_field('archive_partners', 'option')['header_background']['sizes']['large-size'];
    $videoLink = get_field('archive_partners', 'option')['background_video'];
    $subtitle = get_field('archive_partners', 'option')['subtitle_hero'];
} else if (is_post_type_archive('events')) {
    $title = get_field('archive_events', 'option')['title'];
    $background = get_field('archive_events', 'option')['header_background']['sizes']['large-size'];
    $subtitle = get_field('archive_events', 'option')['subtitle'];
} else if (is_home()) {
    $title = get_field('archive_blog', 'option')['hero']['title'];
    $background = get_field('archive_blog', 'option')['hero']['background_image']['sizes']['large-size'];
    $video = get_field('background_video');
    $videoLink = get_field('video_link');
    $subtitle = get_field('archive_blog', 'option')['hero']['subtitle'];
} else {
    $title = get_the_title(get_queried_object_id());
    $background = get_the_post_thumbnail_url(get_queried_object_id(), 'large-size');
    $video = get_field('background_video');
    $videoLink = get_field('video_link');
    $subtitle = get_field('zone_hero_content');
    if ( get_field('image_complete')) { 
        $complete = "complete "; 
        $couleur_fond = get_field('couleur_fond'); 
    }
}
?>
<div id="page__header" class="full <?php if (is_singular('post')) echo "single-post"; ?>">
    <div class="banner <?php if (get_field('image_complete')) { echo "complete "; echo get_field('couleur_fond'); } ?>">
        <?php if ($videoLink) : ?>
            <a data-fancybox href="<?php echo $videoLink; ?>" class="image-video">
                <div class='btn play'><img src='<?php assets('svg/playblue.svg') ?>' alt="<?php _e('Blue arrow', 'treize'); ?>"></div>
            </a>
        <?php endif; ?>
        <?php if ($video['video_mp4']) { ?>
            <div class="background">
                <video autoplay muted loop>
                    <source src="<?php echo $video['video_mp4']['url'] ?>" type="video/mp4">
                    <source src="<?php echo $video['video_ogv']['url'] ?>" type="video/ogv">
                    <source src="<?php echo $video['video_webm']['url'] ?>" type="video/webm">
                    <img src="<?php echo $background; ?>" <?php echo $background; ?>>
                </video>
            </div>
        <?php } else {
            if ( get_field('image_complete' ) && is_singular() ) { ?>    
                <div class="background" >
                    <div style="background-image: url('<?php echo $background; ?>') ;"></div>
                </div>
            <?php } else { ?>
                <div class="background" style="background-image: url('<?php echo $background; ?>') ;">
            </div>
            <?php } ?>
        <?php }
        if (!(is_singular('post') || is_singular('events'))) { ?> <h1><?php echo $title; ?></h1> <?php }
            if ($subtitle) {
                echo "<p class='hero-text'>" . $subtitle . "</p>";
            };
        ?>
    </div>
    <?php
    if (is_singular('events')) {
        include(locate_template('pages/event/info-header.php', false, false));
    } ?>
</div>