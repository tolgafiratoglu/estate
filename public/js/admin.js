/*
    Generic function to init data table:
*/
function initDataTable(url, columns, contextClass, editUrl) {

    // Is it a list or trash bin?
    var deleted = $(".admin-data-table").attr("data-deleted");
    
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