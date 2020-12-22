var table = $('#productTable').DataTable({
    "order": [[ 0, "desc" ]],
     "lengthMenu": [[100, 150, 200], [100, 150, 200]],
    "PaginationType": "bootstrap",
    dom: 'Blfrtip',
    buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
});



$('.locale-change').click(function () {
    var toLocale = $(this).data('locale-change');
    $('.locale-container').hide();
    $('.locale-container-' + toLocale).show();
    $('.locale-change').removeClass('active');
    $(this).addClass('active');
});