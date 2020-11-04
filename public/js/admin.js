var itemIdToDelete; // Soft delete
var itemIdToRemove; // Hard delete
var itemIdToRestore; // Restore deleted item

/*
    Generic function to init data table:
*/
function initDataTable(url, columns, columnDefs, apiDeleteUrl, apiRemoveUrl, apiRestoreUrl) 
{

    // Is it a list or trash bin?
    var deleted = $(".admin-data-table").attr("data-deleted");
    
    url += "?deleted=" + deleted;

    // Initialize data table:            
    var table = $(".admin-data-table").dataTable(
        {
            "ajax": url,
            "columns": columns,
            "columnDefs": columnDefs,
            "autoWidth": true,
            "processing": true,
            "serverSide": true,
            "order": [[ 0, "desc" ]],
            "drawCallback": function( settings ) {

                $(".admin-list-delete").click(
                    function(){
                        itemIdToDelete = $(this).attr("data-id");
                    }
                );

                $(".admin-list-remove").click(
                    function(){
                        itemIdToRemove = $(this).attr("data-id");
                    }
                );

                $(".admin-list-restore").click(
                    function(){
                        itemIdToRestore = $(this).attr("data-id");
                    }
                );

                $(".delete-confirm-yes").click(
                    function(){
                        
                        $.ajax({
                            url: apiDeleteUrl,
                            type: "delete",
                            data: {_token: $('meta[name=csrf-token]')[0].content, item_id: itemIdToDelete},
                            success: function(data){
                                $('#delete_confirm').modal('hide');
                                document.location.reload();
                            },
                            error: function(error){
                                $('#restore_confirm').modal('hide');
                                $(".alert-danger").removeClass("d-none").html(error.message);
                            } 
                        });
                    }
                );

                $(".remove-confirm-yes").click(
                    function(){
                        
                        $.ajax({
                            url: apiRemoveUrl,
                            type: "delete",
                            data: {_token: $('meta[name=csrf-token]')[0].content, item_id: itemIdToRemove},
                            success: function(data){
                                $('#remove_confirm').modal('hide');
                                document.location.reload();
                            },
                            error: function(error){
                                $('#remove_confirm').modal('hide');
                                $(".alert-danger").removeClass("d-none").html(error.message);
                            } 
                        });
                    }
                );

                $(".restore-confirm-yes").click(
                    function(){
                        
                        $.ajax({
                            url: apiRestoreUrl,
                            type: "put",
                            data: {_token: $('meta[name=csrf-token]')[0].content, item_id: itemIdToRestore},
                            success: function(data){
                                $('#restore_confirm').modal('hide');
                                document.location.reload();
                            },
                            error: function(error){
                                $('#restore_confirm').modal('hide');
                                $(".alert-danger").removeClass("d-none").html(error.message);
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
function saveItem(saveUrl, returnUrl, data)
{

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
function initPropertyStatusList() 
{
    var columns = [{ "data": "id" }, { "data": "title" }, { "data": "slug" }, { "data": "buttons" }];
    var columnDefs =  [{"targets": 3, "orderable": false, "className": "dt-right"}];
    initDataTable("/api/admin/property-status", columns, columnDefs, "/api/admin/property-status", "/api/admin/property-status/remove", "/api/admin/property-status/restore");

    $(".admin-property-status-save").click(
        function(){
            saveItem("/api/admin/property-status", "/admin/property-status" , 
                {
                    _token: $('meta[name=csrf-token]')[0].content, 
                    id: $("#item_id").val(),
                    title: $("#property_status_title").val(), 
                    slug: $("#property_status_slug").val()
                }
            );
        }
    );

}

function initToggleButton()
{
    $(".toggle-switch-checkbox").change(
        function(){
            var settingValue = 0;
            if(this.checked == true){
                settingValue = 1;
            }

            var setting = $(this).attr("data-setting");
            var settingWrapper = $(this).closest(".admin-toggle-item-wrapper");

            settingWrapper.find(".alert").addClass("d-none");
            settingWrapper.find(".alert-warning").removeClass("d-none");

            $.ajax({
                url: "/api/admin/setting/save",
                type: "post",
                data: {setting: setting, setting_value: settingValue},
                success: function(data){
                    settingWrapper.find(".alert").addClass("d-none");
                    var successAlert = settingWrapper.find(".alert-success");
                        successAlert.removeClass("d-none");
                            setTimeout(
                                function(){
                                    successAlert.addClass("d-none");
                                }, 2000
                            );
                },
                error: function(error){
                    settingWrapper.find(".alert").addClass("d-none");
                        var errorAlert = settingWrapper.find(".alert-danger");
                            errorAlert.removeClass("d-none");
                            setTimeout(
                                function(){
                                    errorAlert.addClass("d-none");
                                }, 2000
                            );
                } 
            });

        }
    );
}

$( document ).ready(function() {
    
    initPropertyStatusList();

    initToggleButton();

});