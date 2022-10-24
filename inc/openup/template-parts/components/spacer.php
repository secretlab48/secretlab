<?php

$spacer_height = get_sub_field('spacer_height');
?>
<?php if ($spacer_height) : ?>
    <div class="c-spacer <?php echo $spacer_height; ?>"></div>
<?php endif; ?>