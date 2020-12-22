var table = $('.orderTable').DataTable({
    "order": [[ 0, "desc" ]],
     "lengthMenu": [[100, 150, 200], [100, 150, 200]],
    "PaginationType": "bootstrap",
     dom: 'Blfrtip',
     buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],       
      
});

$('.editstatus').click(function() {
    var id = $(this).data('id');
    $('#id').val(id);
  });