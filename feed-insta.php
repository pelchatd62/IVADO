<?php
/* Template Name: Instagram */
get_header();
$userID = "17841408124418375";
$accesToken = "IGQVJWS0VoYUw5Y0ROekpyMUZA6cUk5dERDZAmx6Y21BYTRKYk5mcFZAjSGJhRGdHV3lubmFzTUdMbEFkaXRfZAnJrUjk1SmY1cTZAwYkJpNG16ZAi02TDZAta1F4ZAmJaNFA5RVJreGZAfMnZA3" ;
$urlToGetMediaId = 'https://graph.instagram.com/'.$userID.'/media?access_token='.$accesToken; 
$json_data = file_get_contents($urlToGetMediaId);
$mediasIdDecode = json_decode($json_data);
$mediasId = $mediasIdDecode->data;
$urlMediaList = array();
$field = "media_url" ;
foreach($mediasId as $media){
    $id = $media->id;
    $urlToGetMediaInfo = 'https://graph.instagram.com/'.$id.'?fields='.$field.'&access_token='.$accesToken;
    $json_data = file_get_contents($urlToGetMediaInfo);
    $mediaInfoDecode = json_decode($json_data);
    $urlMediaList[] = $mediaInfoDecode->media_url;
}

?>
<div id="primary">
	<main id="main" role="main">
        <?php include( locate_template( 'blocks/small-hero.php', false, false ) ) ; ?>
        <section class="content__section">
            <div class="wrapper both">
                <div style="display:none;" class="instagram-container">
                    <?php 
                        foreach($urlMediaList as $url):
                            echo '<img src="'.$url.'" alt="">';
                        endforeach; ?>
                        
                </div>
            </div>
        </section>
	</main>
</div>
<?php get_footer(); ?>