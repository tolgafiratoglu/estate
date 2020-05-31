/*
    Generic function to init data table for any admin panel:
*/
function initDataTable(url, columns, context, editUrl, deleteAjaxUrl) {

    // Is it a list or trash bin?
    var deleted = $(".admin-data-table").attr("data-deleted");
    
    // Push edit and delete buttons depending on the status:
    columns.push({ "data": "id",
                    "fnCreatedCell": function (nTd, sData, rowData, iRow, iCol) {
                        if(deleted == 0){
                            $(nTd).html("<a class='' href='"+editUrl+"/"+rowData.id+"'><i class='far fa-edit'></i></a>");
                        } else {
                            $(nTd).html("");
                        }
                    }, "orderable": false, "width": "30px"
                },
                { "data": "id",
                    "fnCreatedCell": function (nTd, sData, rowData, iRow, iCol) {
                        console.log('sData', this);
                        if(deleted == 0){
                            $(nTd).html("<span data-context='"+context+"' data-id='"+rowData.id+"' class='row-soft-delete'><i class='fas fa-trash'></i></span>");
                        }else{
                            $(nTd).html("<span data-context='"+context+"' data-id='"+rowData.id+"' class='row-hard-delete'><i class='fas fa-trash'></i></span>");
                        }
                    }, "orderable": false, "width": "30px"
                });

    // Initialize data table:            
    $(".admin-data-table").dataTable(
        {
            "ajax": url + "?deleted=" + deleted,
            "columns": columns,
            "autoWidth": true,
            "processing": true,
            "serverSide": true,
            "language": {
                "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            },
            "drawCallback": function( settings ) {
                


            }    
        }
    );
}

/*
    Init property status list:
*/
function initPropertyStatusList() {
    var columns = [{ "data": "id" }, { "data": "name" }, { "data": "slug" }];
    initDataTable("/api/admin/property-status", columns, "property-status", "/admin/property-status/edit", "/admin/property-status/delete");
}

$( document ).ready(function() {
    
    initPropertyStatusList();

});