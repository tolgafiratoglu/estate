function initPropertyStatusList() {

    $(".admin-data-table").DataTable(
        {
            "ajax": "/api/admin/property-status",
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "slug" },
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