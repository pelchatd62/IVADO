<?php
get_header();
$archive_restaurants= get_field('archive_restaurants', 'option');
$project_types = get_terms('project-type');
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
if(isset($_GET['projets'])){ 
    $projets = $_GET['projets'];
} else {
    $projets = 6;
}
$args = array(
	'post_type' => 'projects',
	'posts_per_page' => $projets,
	'paged' => $paged,
);
if(isset($_GET['cat'])){
	$args['tax_query'][] = array(
		array(
			'taxonomy' => 'project-type',
			'field'    => 'slug',
			'terms'    => array( $_GET['cat'] ),
		),
    );
    $all = '';
    $termActiv = 'active';
}else{
    $all = 'active';
    $termActiv = '';
}
if(isset($_GET['project-name'])){
    $args['s'] =  $_GET['project-name'];
    $all = '';
    $termActiv = '';
}
$query = new WP_Query( $args );
?>
<?php include( locate_template( 'blocks/big-hero.php', false, false ) );  ?>
<div id="page__content">
    <?php         
        $row = get_field('archive_projects', 'option'); 
        //   $row = get_field('text_illustration'); 
        $layout='text_illustration';
        include( locate_template( 'blocks/flexible/text_illustration.php', false, false ) ); ?>
    <div class="filters-container archive-project">
        <?php if(get_field('archive_projects', 'option')['title_before_project'] ){
            echo '<h2 id="project-section" class="title_before_project">'.get_field('archive_projects', 'option')['title_before_project'].'</h2>';
        } ?>
        <div class="wrapp both">

        <form id="search-form" action="" class="custom-search-bar projects">
            <div class="custom-submit"><i class="far fa-search"></i></div>
            <input name="project-name" class="project-name" type="text" placeholder="<?php _e('Search', 'filters-treize') ; ?>">
        </form>
            
        <div class="button-container">
            <p><?php _e('Categories','filters-treize') ; ?>:</p>
            <div data-term="" class="filter-button all <?php echo $all; ?>"><?php _e('All','filters-treize') ; ?></div>
            <?php   foreach( $project_types as $project_type): ?>
                        <div class="filter-button <?php echo $_GET['cat'] == $project_type->slug ? 'active' : '' ; ?>" data-term="<?php echo $project_type->slug; ?>"><?php echo $project_type->name; ?></div>
            <?php   endforeach; ?>
            <div class="button-youtube">
                <a href="https://www.youtube.com/playlist?list=PLnI094tgrXpyZI_d8l1XtMSZ0Dj9SNNMN">
                    <?php _e("Videos",'filters-treize'); ?>
                </a>
            </div>
            <div class="button-youtube">
                <a href="https://www.youtube.com/playlist?list=PLnI094tgrXpyq55YRN7XbF9tfHrdPRAci">
                    <?php _e("Digital October",'filters-treize'); ?>
                </a>
            </div>
        </div>
    </div>							
    </div>
    <section class="content__section archive-projects">
        <div class="container" id="project-ajax-container">
            <?php  include( locate_template( 'pages/archives/project-loop.php', false, false ) ); 
            // wp_reset_postdata();
            ?>    
        </div>   
    </section>
    <?php include( locate_template( 'blocks/main_flexible.php', false, false ) ); ; ?>
<div>
    
<?php get_footer();?>
