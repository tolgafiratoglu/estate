var itemIdToDelete; // Soft delete
var itemIdToRemove; // Hard delete

/*
    Generic function to init data table:
*/
function initDataTable(url, columns, columnDefs, apiDeleteUrl) {

    // Is it a list or trash bin?
    var deleted = $(".admin-data-table").attr("data-deleted");
    
    // Initialize data table:            
    $(".admin-data-table").dataTable(
        {
            "ajax": url + "?deleted=" + deleted,
            "columns": columns,
            "columnDefs": columnDefs,
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
    Generalized saveItem function for all edit/insert forms.
*/
function saveItem(saveUrl, returnUrl, data){

    $.ajax({
        url: saveUrl,
        type: "post",
        data: data,
        success: function(data){
            document.location = returnUrl;
        },
        error: function(error){
            
            var errorMessage = "";

                if(typeof JSON.parse(error.responseText).message !== 'undefined'){
                    errorMessage = JSON.parse(error.responseText).message;
                }

                if(typeof JSON.parse(error.responseText).errors !== 'undefined'){
                    errors = JSON.parse(error.responseText).errors;
                    for (let error_key in errors) {
                        if(errors[error_key].length > 0){
                            for(var i = 0; i < errors[error_key].length; i++){
                                errorMessage += " " + errors[error_key][i];
                            }
                        }
                    }
                }

                $(".alert-warning-wrapper").removeClass("d-none").html(errorMessage);

        } 
    });

}

/*
    Init property status list:
*/
function initPropertyStatusList() {
    var columns = [{ "data": "id" }, { "data": "name" }, { "data": "slug" }, { "data": "buttons" }];
    var columnDefs =  [{"targets": 3, "orderable": false, "className": "dt-right"}];
    initDataTable("/api/admin/property-status", columns, columnDefs, "/api/admin/property-status");

    $(".admin-property-status-save").click(
        function(){
            saveItem("/api/admin/property-status", "/admin/property-status" , 
                {
                    _token: $('meta[name=csrf-token]')[0].content, 
                    id: $("#item_id").val(),
                    name: $("#property_status_name").val(), 
                    slug: $("#property_status_slug").val()
                }
            );
        }
    );

}

$( document ).ready(function() {
    
    initPropertyStatusList();

});