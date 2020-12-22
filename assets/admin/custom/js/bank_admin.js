var table = $('#productTable').DataTable({
    "order": [[ 0, "desc" ]],
     "lengthMenu": [[100, 150, 200], [100, 150, 200]],
    "PaginationType": "bootstrap",
    dom: 'Blfrtip',
    buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
});

var value= $('#mobile_banking').val();

if(value=="Yes"){
    $("#mobile_number").show();
}
else{
    $("#mobile_number").hide();
}

$('#mobile_banking').on('change', function () {   
    if(this.value=="Yes"){
        $("#mobile_number").show();       
    }
    else{       
        $("#mobile_number").hide();
    }
});