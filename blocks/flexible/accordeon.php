<section class="content__section <?php echo $option; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>
	<div class="wrapp both">
		<div class="accordeon-container">
			<?php if( $row['title'] ): ?>
				<h2><?php echo $row['title']; ?></h2>
			<?php 
				endif;
				$bandeaux = $row['rows'];
				if( $bandeaux ):
					foreach( $bandeaux as $bandeau ): ?>
						<div class="faq-bandeau srh sreveal" <?php echo  $bandeau['ancre'] ? "id='".$bandeau['ancre']."'" : ""; ?>>
							<div class="header">
								<div class="bg"></div>
								<h3><?php echo $bandeau['title']; ?></h3>
								<div class="cross"></div>
							</div>
							<div class="content">
								<div class="text wisi">
									<?php echo $bandeau['content']; ?>
								</div>
							</div>
						</div>	
			<?php 
					endforeach;
				endif; 
			?>	
<?php       if($row['label']){ ?>
				<a <?php echo $row['link_choice'] ? '' : 'target="_blank"' ; ?> class="btn ivado" href="<?php echo $row['link_choice'] ? $row['internal_link'] : $row['external_link'] ; ?>"> 
					<div class="label"><?php echo $row['label']?></div> 
				</a>
<?php       } ?> 
		</div>
	</div>
</section>