<?php

add_action('wp_ajax_nopriv_consult_ajax_search', 'consult_ajax_search');
add_action('wp_ajax_consult_ajax_search', 'consult_ajax_search');


function consult_ajax_search()
{
    $link_key = $_POST['link_key'];
    $page_id = $_POST['page_id'];
    $link_key = strtolower($link_key);
    $all_link_titles = [];
    $link_index = [];
    $csv_file  = '';

    while (have_rows('flexible_boek_consult', $page_id)) : the_row();
        if (get_row_layout() == 'boek_consult_search_section'):
            $csv_file = get_sub_field('boek_consult_search_csv_links_file', $page_id);
        endif;
    endwhile;

    $csv = file_get_contents($csv_file);
    $mainData = csvToArray($csv);


    foreach ($mainData as $dataItem):
        if ($dataItem):
            $all_link_titles[] = $dataItem['name_employer'];
        endif;
    endforeach;

    foreach ($all_link_titles as $link_title => $string) {
        if (strpos(strtolower($string), $link_key) !== FALSE)
            $link_index[] = $link_title;
    }

    if (!empty($link_key)): ?>
        <div class="c-search-filter__list-wrap u-bg-primary-skin">
            <ul class="c-search-filter__list">
                <?php foreach ($link_index as $i) :
                    $row = $mainData[$i]; ?>

                    <li class="c-search-filter__list-item">
                        <a class="u-color-primary-dark-blue JS-search-consult-item"
                           data-serch-consult-url="<?php echo $row['booking_link'] ?>"
                           href="javascript:void(0);"><?php echo $row['name_employer'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif;


    wp_die();
}

function csvToArray($csv)
{
    $rows = explode("\n", trim($csv));
    $data = array_slice($rows, 1);
    $keys = array_fill(0, count($data), $rows[0]);
    $arrayData = array_map(function ($row, $key) {
        return array_combine(str_getcsv($key), str_getcsv($row));
    }, $data, $keys);

    return $arrayData;
}