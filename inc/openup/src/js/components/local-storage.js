let currentDownload = $('.JS--download-book').data('current-download');

$(".JS--download-book").find("._submit").on('click',function(){
    localStorage.setItem('download', currentDownload);
} );
let download = localStorage.getItem('download');
$(".downloadResult").on('click',function(){
    $(this).attr("href", download);
} );
