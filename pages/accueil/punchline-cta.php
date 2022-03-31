<?php 
    $punchline_cta = get_field('punchline_cta');
?>
<h1 class="description">
    <?php echo $punchline_cta['description'] ?>
</h1>
<a class="btn ivado" href="<?php echo $punchline_cta['button']['link']?>">
    <div class="label"> <?php echo $punchline_cta['button']['label']?> </div>
</a>