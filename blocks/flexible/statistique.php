<?php
    $stats = $row['statistiques'];
?>
<section <?php if(is_front_page()) echo 'id="statistics"' ?> class="content__section <?php echo $option ; ?>" data-layout="<?php echo $layout ;?>" <?php echo $row['section_id'] ? 'id="'.$row['section_id'].'"' : '' ; ?>>     
    <div class="wrapp both">
<?php   if($row['title']){ ?>
            <h2><?php echo $row['title'] ; ?></h2> 
<?php   } ; ?>  
        <div class="container">
<?php   foreach($stats as $stat): ?>
            <div class="solo">
                <h3><?php echo $stat['entete_stat']; ?></h3>
                <?php $stat_rows = $stat['statistique'] ?> 
                <?php   foreach($stat_rows as $stat_row): ?> 
                    <p>
                        <span><?php echo $stat_row['symbole']; ?></span><span data-number="<?php echo $stat_row['nombre_stat']; ?>" class="stats-number">0</span>
                        <?php  if($stat_row['symbole_fin']){ echo '<span class="symbole_after">'.$stat_row['symbole_fin'].'</span>' ;} ?>
                    </p>
                    <p class="subtitle">
                        <?php echo $stat_row['unite'] ; ?>
                    </p>
                <?php   endforeach; ?>
            </div>
<?php   endforeach; ?>
        </div>
        
<?php   if($row['label']){ ?>
            <a <?php echo $row['link_choice'] ? '' : 'target="_blank"' ; ?> class="btn ivado services-link" href="<?php echo $row['link_choice'] ? $row['internal_link'] : $row['external_link'] ; ?>"> 
                <div class="label"><?php echo $row['label']?></div> 
            </a>
<?php   } ?>  
    </div>
</section>