var table = $('#customerTable').DataTable({
    "order": [[ 0, "desc" ]],
    "PaginationType": "bootstrap",
    dom: 'Blfrtip',
    buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": baseUrl+'admin/customer/customer-disp',
         "columns" : [ {
            "data" : "id"
        }, {
            "data" : 'customer_name'
        },
        {
            "data" : "mobile"
        },
        {
            "data" : "email"
        },        
        {
        "data": "status",
        render: function(data) {
                if(data == 1) {
                  return '<span class="label label-success">Active</span>'; 
                }
                else{
                  return '<span class="label label-danger">Inactive</span>';
                }
            }
        },{
            "data": "id",
            "mRender": function(data, type, full) {
                var output='<a class="btn btn-primary btn-custom waves-effect waves-light" href='+ baseUrl +'admin/customer/customer-address/'+ data +'>' + 'Addresses' + '</a>&nbsp;&nbsp;&nbsp;';
               // if(data !=3 && data !=4 && data !=5 ){
                 output +='<a class="btn btn-danger btn-custom waves-effect waves-light" href='+ baseUrl +'admin/customer/customer-orders/'+ data +'>' + 'Orders' + '</a>';
    
               // }
            return output;
            }
          }],
      'columnDefs': [{
      "targets": 0,
      "className": "text-center",
    },{
        "targets": 1,
      "className": "text-center",
    },{
        "targets": 2,
      "className": "text-center",
    }],
});

var table = $('#customerAddressTable').DataTable({
    "order": [[ 0, "desc" ]],
    "PaginationType": "bootstrap",
    dom: 'Blfrtip',
    buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],       
      
});



