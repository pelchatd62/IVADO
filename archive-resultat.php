<?php
get_header();
$years = get_terms('annee');
$programmes = get_terms('programme');
$editions = get_terms('edition');/******************************************* */
$args = array(
    'post_type'  => 'resultat',
    'posts_per_page' => -1,
);
$postslist = get_posts( $args );
$results = array();
foreach($years as $year):
    $results[$year->slug] = array();
    foreach($programmes as $programme):
        $results[$year->slug][$programme->slug] = array();
        $results[$year->slug][$programme->slug]["pasEdition"] = array();
        foreach($editions as $edition):
            $results[$year->slug][$programme->slug][$edition->slug] = array();
        endforeach;
    endforeach;
endforeach; 
/*echo "<pre>";
var_dump($results);
echo "<br>";    
echo "</pre>";*/

if($postslist){
    foreach($postslist as $post):
        setup_postdata( $post );
        $curYear = get_the_terms( get_the_ID(), 'annee');
        $curProgs = get_the_terms( get_the_ID(), 'programme');
        $curEdition = get_the_terms( get_the_ID(), 'edition');/********************************** */
        if($curProgs):
/*echo "<pre>";
var_dump($curProgs);
echo "<br>";    
echo "</pre>";*/
            foreach($curProgs as $programme):
                /*if ( !isset( $results[ $curYear[0]->slug ][$prog->slug] ) ) { 
                    $results[ $curYear[0]->slug ][$prog->slug] = array();  
                }
                if ($curEdition) {
                        if ( !isset( $results[ $curYear[0]->slug ][$prog->slug][$curEdition[0]->slug] ) ) { 
                            $results[$curYear[0]->slug ][$prog->slug][$curEdition[0]->slug] = array();
                        }
                    $results[ $curYear[0]->slug ][$prog->slug][$curEdition[0]->slug][] = get_post( get_the_ID() );
                } else {
                    if ( !isset( $results[$curYear[0]->slug ][$prog->slug]["pasEdition"] ) ) {
                        $results[$curYear[0]->slug ][$prog->slug]["pasEdition"] = array();
                    }
                    $results[ $curYear[0]->slug ][$prog->slug]["pasEdition"][] = get_post( get_the_ID() );
                }            
            */
                if ($curEdition) {
                    $results[ $curYear[0]->slug ][$programme->slug][$curEdition[0]->slug][] = get_post( get_the_ID() );
                } else {
                    /*if ( !isset( $results[$curYear[0]->slug ][$prog->slug]["pasEdition"] ) ) {
                        $results[$curYear[0]->slug ][$prog->slug]["pasEdition"] = array();
                    }*/
                    $results[ $curYear[0]->slug ][ $programme->slug ][ "pasEdition" ][] = get_post( get_the_ID() );
                }
            endforeach;
        endif;  
            
        wp_reset_postdata();
    endforeach;
}
/******* Enlever les programmes et éditions vides **********/
foreach($results as &$result) {
    foreach($result as &$programme ) {
        $programme = array_filter(array_map('array_filter', $programme));
    }
}
$results = array_filter(array_map('array_filter', $results));

?>
    <div id="primary">
        <main id="main" class="site-main" role="main">
            <?php include( locate_template( 'blocks/small-hero.php', false, false ) );?>

            <div id="page__content">  
            <div class="wrapp both">
                <h2 class="sous-titre"><?php echo get_field('archive_resultats','option')['sous_titre'] ; ?></h2>
            </div>
                <?php include( locate_template( 'blocks/main_flexible.php', false, false ) );?>
                <div class="filters-container">
                    <div id="laureats" class="wrapp both">
                        <h2 class="archive-resultat-title"><?php echo get_field('archive_resultats','option')['first_title'] ; ?></h2>
                        <form id="search-form" action="" class="custom-search-bar results">
                            <div class="custom-submit"><i class="far fa-search"></i></div>
                            <input name="result-name" class="result-name" type="text" placeholder="<?php _e('Search', 'filters-treize') ; ?>">
                        </form>
                        
                        <form id="results-form" method='get' action="<?php echo get_post_type_archive_link('partners'); ?>">
                            <div class="select-container">
                                <?php $terms = get_terms('programme', array( 'hide_empty' => true ) ); ?>
                                <div class="solo-select">
                                    <select class="custom-select" name="programmes" id="programmes">
                                      
                                        <option value="" ><?php _e('All Programs','filters-treize') ; ?></option>
                                        <?php foreach( $terms as $term ): ?>
                                            <option value="<?php echo $term->slug; ?>" <?php echo $strucValue == $term->slug ? 'selected' : '' ; ?>><?php echo $term->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="solo-select">
                                    <select class="custom-select" name="annees" id="annees">
                                        
                                        <option value=""><?php _e('All Years','filters-treize') ; ?></option>
                                        <?php foreach( $years as $term ): ?>
                                            <option value="<?php echo $term->slug; ?>" <?php echo $domValue == $term->slug ? 'selected' : '' ; ?>><?php echo $term->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>                          
                </div>
                <div id="results-ajax" class="result-ajax-container">                           
<?php               
                    include( locate_template( 'pages/archives/resultat-loop.php', false, false ) ); ?>
                    <div class="wrapp both">
                        <div class="error_row item-ajax cache">
                            <h2 class="no_result"><?php _e("No result found within your research criterias", 'treize' ); ?> </h2>
                            <div class="btn ivado " id="reset-button">
                                <div class="label"><?php _e("Reset", "reset-treize");?></div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
