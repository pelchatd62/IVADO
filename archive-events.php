<?php
get_header();
?>
	<div id="primary">
		<main id="main" class="site-main" role="main">
            <?php include( locate_template( 'blocks/big-hero.php', false, false ) );?>
            <div id="page__content">
                <section class="content__section archive-events">
                    <div class="wrapp both container calendar-container">
                        <?php include( locate_template( 'pages/archives/events/calendar_en.php', false, false ) ); ?>
                        <div id="daily-events">
                        </div>
                    </div>
                    
                    <div class="filters-container">
                        <h2> <?php echo get_field('archive_events', 'option')['title_events'] ?> </h2>
                        <p class="wrapp both"> 
                        <?php 
                            if( ICL_LANGUAGE_CODE == "fr" ) {
                                echo "Vous avez manqué l'un de nos webinaires ou formations? Consultez nos playlists sur la <a class='wisi-standard-btn' href='https://www.youtube.com/c/IVADO/playlists'> Chaîne YouTube IVADO!</a>";
                            } else {
                                echo "Did you miss one of our webinars or training course? Consult our playlists on the <a class='wisi-standard-btn' href='https://www.youtube.com/c/IVADO/playlists'> IVADO YouTube Channel!</a>"; 
                            }
                        ?>
                        </p><br>
                        <div class="wrapp both event-search-tools">
                            <form id="search-form" class="custom-search-bar events">
                                <div class="custom-submit"><i class="far fa-search"></i></div>
                                <input name="event-name" class="event-name" type="text" placeholder="<?php _e('Search', 'filters-treize') ; ?>">
                            </form>
                            <form id="form-event" method='get' action="<?php echo get_post_type_archive_link('post'); ?>">
                        <?php   $terms = get_terms('event-type', array( 'hide_empty' => true ) ); 
                                    if(isset($_GET['event-category'])){
                                        $catTous = '';
                                        $catValue = $_GET['event-category'];
                                    }else{
                                        $catTous = 'selected';
                                        $catValue = '';
                                    }
                        ?>
                                <div class="select-container">
                                    <div class="solo-select">
                                        
                                        <select class="custom-select" name="event-category" id="categorie">
                                            <option value=""><?php _e('All Categories','filters-treize') ; ?></option>
                                            <?php foreach( $terms as $term ): ?>
                                                <?php if($term->parent == 0 && ($term->slug != 'mooc') && ($term->slug != 'mooc-en') ) :?>
                                                <option value="<?php echo $term->slug; ?>" <?php echo $catValue == $term->slug ? 'selected' : '' ; ?>><?php echo $term->name; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>	
                    </div>

                    <div class="wrapp both event-info-section">
                    </div>
                    <?php include( locate_template( 'blocks/main_flexible.php', false, false ) );?>
                </section>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
