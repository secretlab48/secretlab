$(".JS--jobs-filter-btn").click(function () {
    const post_id = $('.s-job-board__filters').data('post_id');
    const location = (typeof $(this).data('job-location') != undefined) ? $(this).data('job-location') : false;
    const department = (typeof $(this).data('job-department') != undefined) ? $(this).data('job-department') : false;
    const token = $('.s-job-board__filters').data('token-url');
    const data = {
        'action': "jobs_filter",
        'post_id': post_id,
        'location': location,
        'department': department,
        'token': token,
    };
    console.log(data);

    $.ajax({
        url: appLocations.admin_ajax,
        type: 'POST',
        data: data,
        success: function (result) {
            $('.JS--ajax-job-container').html(result).fadeIn(250);
        },

        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });

});
