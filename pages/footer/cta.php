<?php 

if(is_front_page()){
    $cta_footer = get_field('archive_blog' , 'option')['cta_footer'];  
    //echo var_dump($cta_footer);
    $choice = $cta_footer['choice'];}
else if(is_singular('post')){
    
    if(get_field('cta_footer')['background']){
        $cta_footer = get_field('cta_footer');
    }else{
        $cta_footer = get_field('archive_blog' , 'option')['cta_footer'];
    }
    $choice = $cta_footer['choice'];
}
else if(is_singular('projects')){
    if(get_field('cta_footer')['background']){
        $cta_footer = get_field('cta_footer');
    }else{
        $cta_footer = get_field('archive_projects' , 'option')['cta_footer'];
    }
    $choice = $cta_footer['choice'];
}
else if(is_post_type_archive('partners')){
    $cta_footer = get_field('archive_partners' , 'option')['cta_footer'];
    $choice = $cta_footer['choice'];
}
else if(is_post_type_archive('projects')){
    $cta_footer = get_field('archive_projects' , 'option')['cta_footer'];
    $choice = $cta_footer['choice'];
}
else if(is_post_type_archive('events')){
    $cta_footer = get_field('archive_events' , 'option')['cta_footer'];
    $choice = $cta_footer['choice'];
    $events = "eventssss";
}
else if(is_post_type_archive('bourse')){
    $cta_footer = get_field('archive_bourses' , 'option')['cta_footer'];
    $choice = $cta_footer['choice'];
}
else if(is_post_type_archive('resultat')){
    $cta_footer = get_field('archive_resultats' , 'option')['cta_footer'];
    $choice = $cta_footer['choice'];
}
else if(is_singular('bourse')){
    if(get_field('cta_footer')['background']){
        $cta_footer = get_field('cta_footer');
    }else{
        $cta_footer = get_field('archive_bourses' , 'option')['cta_footer'];
    }
    $choice = $cta_footer['choice'];
}
else if(is_singular('persons')){
    $cta_footer = get_field('single_person' , 'option')['cta_footer'];
    $choice = $cta_footer['choice'];
}
else if(is_singular('events')){
    if(get_field('cta_footer')['background']){
        $cta_footer = get_field('cta_footer');
    }else{
        $cta_footer = get_field('archive_events' , 'option')['cta_footer'];
    }
    
    $choice = $cta_footer['choice'];
}
else {
    if(get_field('cta_footer')['background']){
        $cta_footer = get_field('cta_footer');
    }else{
        $cta_footer = get_field('footer' , 'option')['cta_footer'];
    }
    $choice = $cta_footer['choice'];
}
$mail = $cta_footer['email_choice'] ?  'mailto:' : '';
if($cta_footer['email_choice'] && $choice){
    $link = $cta_footer['mail'];
}else{
    $link =  $choice ? $cta_footer['external_link'] : $cta_footer['internal_link'];
}
?>
<a <?php echo $cta_footer['blank'] && $choice ? 'target="_blank"' : '' ; ?>  href="<?php echo $mail; echo $link ; ?>" >
    <div class="background lozad not-hidden" data-background-image="<?php echo $cta_footer['background']['sizes']['article-media'] ;?>"></div>
    <div class="cta">
        <p><?php echo $cta_footer['subtitle'] ; ?></p>
        <h3><?php echo $cta_footer['title'] ; ?></h3>
        <p class='show'><?php _e('Show more', 'footer-treize') ?></p>
    </div>
</a>