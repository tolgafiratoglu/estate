function initPropertyStatusList() {

    $(".admin-data-table").dataTable(
        {
            "ajax": "/api/admin/property-status",
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "slug" },
                { "data": "id",
                    "fnCreatedCell": function (nTd, sData, rowData, iRow, iCol) {
                        $(nTd).html("<a class='btn btn-info' href='/admin/property-status/edit/"+rowData.id+"'><i class='far fa-edit'></i></a>");
                    }, "orderable": false, "width": "30px"
                },
                { "data": "id",
                    "fnCreatedCell": function (nTd, sData, rowData, iRow, iCol) {
                        $(nTd).html("<span class='property-status-delete btn btn-warning' data-id='"+rowData.id+"'><i class='fas fa-trash'></i></span>");
                    }, "orderable": false, "width": "30px"
                }
            ],
            "autoWidth": true,
            "processing": true,
            "serverSide": true
        }
    );

}

$( document ).ready(function() {
    
    initPropertyStatusList();

});