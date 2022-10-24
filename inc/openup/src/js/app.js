global.$ = global.jQuery = require('jquery');
$(document).ready(function() {
    require('./components/modules');
    require('./components/mainMenu');
    require('./components/team-filter');
    require('./components/general');
    require('./components/accordion');
    require('./components/posts-load-more');
    require('./components/form');
    require('./components/blog-filter');
    require('./components/team-filter-ajax');
    require('./components/search-faq-ajax');
    require('./components/consult-search')
    require('./components/faq-category')
    require('./components/slider');
    require('./components/local-storage');
    require('./components/calculator');
    require('./components/input-numb');
    require('./components/jobs-filter');
    require('./components/calendly-section');
    require('./components/liveSpacesFilters');
    require('./components/onDemandSpacesFilters');
    require('./components/popups');
})