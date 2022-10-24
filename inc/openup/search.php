<?php

$search_refer = $_GET["post_type"];
if ($search_refer == 'faq') { load_template(TEMPLATEPATH . '/templates/template-search-faq.php'); }
//elseif ($search_refer == 'CUSTOM_POST_TYPE') { load_template(TEMPLATEPATH . '/template_two-name.php'); };

?>
