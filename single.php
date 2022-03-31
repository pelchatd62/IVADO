<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Treize
 */
get_header();
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 2,
    'orderby' => 'date',
    'order' => 'DESC',
    'post__not_in' => array(get_the_ID())
);
$query = new WP_Query($args); ?>

<div id="primary">
    <main id="main" class="site-main" role="main">
        <?php include(locate_template('blocks/big-hero.php', false, false)); ?>
        <div id="page__content">
            <div class="container-article">
                <section data-layout="article_text">
                    <div class="wrapp article">
                        <div class="container <?php echo is_singular('projects') ? 'single-project' : 'article'; ?>">
                            <!-- <div class="article-grid">
								<div class="line"></div>
								<div class="line"></div>
								<div class="line"></div>
								<div class="line"></div>
							</div> -->
                            <?php $date = get_the_date();
                            $cats = get_the_terms(get_the_ID(), 'category'); ?>
                            <div class="type-date">
                                <p class="cat"><?php echo $cats[0]->name; ?></p>
                                <p class="date"><?php echo $date; ?></p>
                            </div>
                            <h1><?php the_title(); ?></h1>
                        </div>
                    </div>
                </section>
                <?php include(locate_template('blocks/article-flexible.php', false, false)); ?>
            </div>
            <section class="single-back-to-article content__section">
                <div class="back-social_media">
                    <div class="back">
                        <a class="link" href="<?php echo get_post_type_archive_link('post'); ?>">
                            <div class="btn cta-back">
                                <img src="<?php assets('svg/chevron-gauche.svg'); ?>" alt="<?php _e('Arrow pointing left', 'general-treize') ?>">
                            </div>
                            <?php
                            echo __('Back to articles', 'back-to-archive-treize');
                            ?>
                        </a>
                    </div>
                    <div class="social-media">
                        <p><?php _e('Share', 'general-treize'); ?></p>
                        <div class="social">
                            <a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" onclick="window.open(this.href, 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=800,height=600'); return false;"> <i class="fab fa-facebook-f" aria-hidden="true"></i> </a>
                            <a class="linkn" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>" target="_blank" onclick="window.open(this.href, 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=800,height=600'); return false;"> <i class="fab fa-linkedin-in" aria-hidden="true"></i> </a>
                            <a class="twit" href="https://twitter.com/intent/tweet?text=Rigging%20Lead&url=<?php the_permalink(); ?>" target="_blank"> <i class="fab fa-twitter"></i> </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content__section ">
                <div class="wrapp both">
                    <h2><?php _e('Other articles', 'single-article-treize'); ?></h2>
                    <div class="container single-article-cta">
                        <?php
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                                include(locate_template('blocks/box-event-article.php', false, false));
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>

        </div>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();