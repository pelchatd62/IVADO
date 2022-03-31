<?php
for ($i = 0; $i < $maxIndex; $i++) :
    global $post;
    $post = $thePosts[$i];
    setup_postdata($post);
    include(locate_template($cardNamePath, false, false));
endfor;
wp_reset_postdata();
array_splice($thePosts, 0, $maxIndex);
if (count($thePosts) > 0) :
    $encoded = json_encode($thePosts);
    echo "<div id='hiddenQuery' data-ids='" . $encoded . "' data-count='" . count($thePosts) . "'></div>";
?>
    
<?php endif; ?>