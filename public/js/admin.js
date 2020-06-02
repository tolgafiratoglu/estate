/*
    Generic function to init data table:
*/
function initDataTable(url, columns, contextClass, editUrl) {

    // Is it a list or trash bin?
    var deleted = $(".admin-data-table").attr("data-deleted");
    
    // Push edit and delete buttons depending on the status:
    /*
    columns.push({ "data": "id",
                    "fnCreatedCell": function (nTd, sData, rowData, iRow, iCol) {
                        if(deleted == 0){
                            $(nTd).html("<a class='btn btn-info' href='"+editUrl+"/"+rowData.id+"'><i class='far fa-edit'></i></a>");
                        } else {
                            $(nTd).html("");
                        }
                    }, "orderable": false, "width": "30px"
                },
                { "data": "id",
                    "fnCreatedCell": function (nTd, sData, rowData, iRow, iCol) {
                        if(deleted == 0){
                            $(nTd).html("<span class='"+contextClass+"-soft-delete btn btn-warning' data-id='"+rowData.id+"'><i class='fas fa-trash'></i></span>");
                        }else{
                            $(nTd).html("<span class='"+contextClass+"-hard-delete btn btn-warning' data-id='"+rowData.id+"'><i class='fas fa-trash'></i></span>");
                        }
                    }, "orderable": false, "width": "30px"
                });
    */

    // Initialize data table:            
    $(".admin-data-table").dataTable(
        {
            "ajax": url + "?deleted=" + deleted,
            "columns": columns,
            "autoWidth": true,
            "processing": true,
            "serverSide": true
        }
    );
}

/*
    Init property status list:
*/
function initPropertyStatusList() {
    var columns = [{ "data": "id" }, { "data": "name" }, { "data": "slug" }, { "data": "buttons" }];
    initDataTable("/api/admin/property-status", columns, "property-status", "/admin/property-status/edit");
}

$( document ).ready(function() {
    
    initPropertyStatusList();

});