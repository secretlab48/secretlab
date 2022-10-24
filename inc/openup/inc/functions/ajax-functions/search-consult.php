<?php


class SearchConsult
{
    public $link_key = '';
    public $main_data = '';

    function __construct()
    {
        add_action('wp_ajax_nopriv_consult_ajax_search', 'consult_ajax_search');
        add_action('wp_ajax_consult_ajax_search', 'consult_ajax_search');

    }

    public function consult_ajax_search()
    {
        $this->link_key = $_POST['link_key'];
        $this->link_key = strtolower($_POST['link_key']);
        cvs_link_data();

    }

    public function cvs_link_data()
    {
        $page_id = $_POST['page_id'];
        while (have_rows('flexible_boek_consult', $page_id)) : the_row();
            if (get_row_layout() == 'boek_consult_search_section'):
                $csv_file = get_sub_field('boek_consult_search_csv_links_file');
            endif;
        endwhile;

        $csv = file_get_contents($csv_file);
        return $this->main_data = csv_to_array($csv);

    }

    public function csv_to_array($csv)
    {
        $rows = explode("\n", trim($csv));
        $data = array_slice($rows, 1);
        $keys = array_fill(0, count($data), $rows[0]);
        $arrayData = array_map(function ($row, $key) {
            return array_combine(str_getcsv($key), str_getcsv($row));
        }, $data, $keys);

        return $arrayData;
    }

}

$test = new SearchConsult();