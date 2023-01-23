<?php
    $anchor = (!$anchor) ? get_sub_field('anchor') : $anchor;
    if(is_array($anchor)) {
        $anchor = reset($anchor);
    }
?>
<a id="<?php echo $anchor; ?>" name="<?php echo $anchor; ?>"></a>