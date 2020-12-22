var table = $('#categoryTable').DataTable({
    "order": [[ 0, "desc" ]],
    "PaginationType": "bootstrap",
    dom: 'Blfrtip',
    buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
       
      'columnDefs': [{
      "targets": 0,
      "className": "text-center",
    },{
        "targets": 1,
      "className": "text-center",
    },{
        "targets": 2,
      "className": "text-center",
    },{
        "targets": 3,
      "className": "text-center",
    }],
});

table.on('click','.editCategory',function(){
    var id = $(this).data('id');
    var name = $(this).data('name');
    var abbr = $(this).data('indic');
    console.log(abbr);
    $('#id').val(id);
    $('#edit_category_name').val(name);
    $('#abbr').html(abbr);
  });

  $('#editimage').click(function() {
    var id = $(this).data('id');
    $('#catid').val(id);
  });
function deletePopup(){
    var status = confirm("Do you really want to delete");
   if(status)
   {
    return true;
   }else{
    return false;
   }
}
