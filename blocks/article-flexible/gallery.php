<?php $gallerys = $row['gallery'] ; ?>
<section class="content__section content__article <?php echo is_singular('projects') ? 'single-project' : 'article' ; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>
	<div class="wrapp both">
		<div class="container slider <?php echo is_singular('projects') ? 'single-project' : 'article' ; ?>">
			<div class="highlight-thumbs">
	<?php   if($gallerys):
				foreach($gallerys as $gallery): ?>
					<div class="carousel-cell">
						<img src="<?php echo $gallery['sizes']['large-size']; ?>" alt="<?php echo $gallery['alt'] ? $gallery['alt'] : __('Ivado\'s image','treize') ;  ?>">
					</div>
	<?php		endforeach;
			endif; ?>
				<div class="carousel-scrollbar is-hidden">
					<div class="carousel-scrollbar-inner"></div>
				</div>
			</div>
		</div>
	</div>		
</section>