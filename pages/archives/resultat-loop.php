<?php
 if($results): 
    foreach($results as $year => $programmes): 
        $yearTerm = get_term_by( 'slug', $year, 'annee' ); ?>
        <section class="content__section item-ajax" data-layout="accordeon">
            <div class="wrapp both">
                <div class="accordeon-container">
                    <h2><?php echo $yearTerm->name; ?></h2>
<?php               
                    foreach($programmes as $programme => $post):
                        $progTerm = get_term_by( 'slug', $programme, 'programme' );
                        ?>
                            <div class="faq-bandeau srh sreveal" id="<?php echo $progTerm->slug."-".$yearTerm->slug ; ?>">
                                <div class="header">
                                    <div class="bg"></div>
                                    <h3><?php echo $progTerm->name; ?></h3>
                                    <div class="cross"></div>
                                </div>
                                <div class="content">
                                    <div class="text wisi">                                
<?php                               $curEdition = "";
                                    echo "<div class='edition'>";
                                    foreach($post as $edition => $programme):
                                        $editionTerm = get_term_by( 'slug', $edition, 'edition' );
                                        if ( $curEdition != $edition ) {
                                            if ( $curEdition != "" ) {
                                                echo "</div><div class='edition'>";
                                            }
                                            $curEdition = $edition;
                                            if ( $edition != "pasEdition") {
                                                echo "<h3>" . $editionTerm->name . "</h3>"; 
                                            }
                                        }
                                        foreach ($programme as $resultat ):
                                            global $post;
                                            $post = $resultat;
                                            setup_postdata( $post ) 
                                            ?>
                                            <div class="result">
                                                <div class="top-content">
                                                    <h3 class="title"><?php the_title() ;?></h3>
<?php                                               if(get_field('superviseur')){ 
                                                        echo '<p class="supervisor">';
                                                        echo get_field('intitule_de_superviseur'). " ";
                                                        echo get_field('superviseur').'</p>'  ;
                                                    } 
                                                    if(get_field('university')){ echo '<p class="university">'.get_field('university').'</p>'  ;}  ?>
                                                </div>  
<?php                                       if(get_field('bourse_detail')){echo '<div class="bottom-content">'.get_field('bourse_detail').'</div>';}; ?>                      
                                            </div>
<?php                                   endforeach;
                                    endforeach; 
                                    echo "</div>";?>
                                    </div>
                                </div>
                            </div>
<?php                   
                    endforeach; ?>                               
                </div>
            </div>
        </section>                
<?php  
    endforeach ;
endif; ?>
