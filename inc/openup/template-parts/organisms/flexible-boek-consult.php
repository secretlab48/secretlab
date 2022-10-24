<?php while (have_rows('flexible_boek_consult')) : the_row();

    if (get_row_layout() == 'boek_consult_card_section')
        get_template_part('template-parts/sections/flexible-boek-consult/card-section');

    if (get_row_layout() == 'boek_consult_buttons_section')
        get_template_part('template-parts/sections/flexible-boek-consult/buttons-section');

    if (get_row_layout() == 'boek_consult_search_section')
        get_template_part('template-parts/sections/flexible-boek-consult/search-section');

    if (get_row_layout() == 'boek_consult_teams_section')
        get_template_part('template-parts/sections/flexible-boek-consult/team-section');

endwhile;