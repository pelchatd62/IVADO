
<?php
get_header();
$buttonReserveTicket = get_field('informations')['button_reserve_ticket'];
$informations = get_field('informations');
?>

<div id="primary">
	<main id="main" role="main">
    <?php include( locate_template( 'blocks/big-hero.php', false, false ) );?>
        <div id="page__content">
            <?php
                include( locate_template( 'pages/event/informations.php', false, false ) );
                //include( locate_template( 'pages/event/description.php', false, false ) );
                //include( locate_template( 'pages/event/about.php', false, false ) );
                include( locate_template( 'blocks/main_flexible.php', false, false ) );
                include( locate_template( 'blocks/back-social_media.php', false, false ) ) ;
            ?>
        </div>
	</main>
</div>
<?php get_footer(); ?>
