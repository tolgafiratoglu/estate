var itemIdToDelete; // Soft delete
var itemIdToRemove; // Hard delete

/*
    Generic function to init data table:
*/
function initDataTable(url, columns, apiDeleteUrl) {

    // Is it a list or trash bin?
    var deleted = $(".admin-data-table").attr("data-deleted");
    
    // Initialize data table:            
    $(".admin-data-table").dataTable(
        {
            "ajax": url + "?deleted=" + deleted,
            "columns": columns,
            "autoWidth": true,
            "processing": true,
            "serverSide": true,
            "drawCallback": function( settings ) {

                $(".admin-list-delete").click(
                    function(){
                        itemIdToDelete = $(this).attr("data-id");
                    }
                );

                $(".delete-confirm-yes").click(
                    function(){
                        
                        $.ajax({
                            url: apiDeleteUrl,
                            type: "delete",
                            data: {_token: $('meta[name=csrf-token]')[0].content, item_id: itemIdToDelete},
                            success: function(data){
                                document.location = returnUrl;
                            },
                            error: function(error){
                                $(".alert-warning-wrapper").removeClass("d-none").html(error.responseText);
                            } 
                        });
                    }
                );

            }    
        }
    );
}

/*
    Init property status list:
*/
function initPropertyStatusList() {
    var columns = [{ "data": "id" }, { "data": "name" }, { "data": "slug" }, { "data": "buttons" }];
    initDataTable("/api/admin/property-status", columns, "/api/admin/property-status");
}

$( document ).ready(function() {
    
    initPropertyStatusList();

});