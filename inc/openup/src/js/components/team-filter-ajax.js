$('.JS-team-filter-item > a').click(function (e) {
    e.preventDefault();

    let taxonomyId = $(this).data('team-id');
    let currentTerm = $(this).data('current-term-id');

    $.ajax({
        url: appLocations.admin_ajax,
        data: {
            action: 'team_consult_filter',
            team_id: taxonomyId,
            current_term: currentTerm,

        },
        type: 'POST',

        success: function (result) {
            $('.JS-team-filter').fadeIn(250).html(result);
        },

        error: function (result) {
            console.warn(result);
        }
    })
})
