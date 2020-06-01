function trigger_admin_page(){

    var adminUrl = location.protocol+'//'+location.host+location.pathname+"?";

    $(".admin-url-field").each(
        function(){
            adminUrl += $(this).attr("data-field") + "=" + $(this).val() + "&";
        }
    )

    document.location = adminUrl;

}

function saveItem(saveUrl, returnUrl, data){

    $.ajax({
        url: saveUrl,
        type: "post",
        data: data,
        success: function(data){
            document.location = returnUrl;
        },
        error: function(error){
            $(".alert-warning-wrapper").removeClass("d-none").html(error.responseText);
        } 
    });

}

function initPropertyStatusList(){
    // Save the edit or insert forms:
    $(".admin-property-status-save").click(
        function(){
            saveItem("/api/admin/property-status/save", "/admin/property-status" , 
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

function init_admin_confirm() {

    $('#delete_confirm').on('show.bs.modal', function (e) {
        console.log('this', this);
    });
    
}

function init_admin_field_triggers(){
    $(".admin-sorting-icon").click(
        function(){

            var order   = $(this).attr("data-order");
            var orderBy = $(this).attr("data-orderBy");

            $(".admin-url-field[data-field=order]").val(order)
            $(".admin-url-field[data-field=order_by]").val(orderBy)
            
            trigger_admin_page();     
        }
    );
}

$( document ).ready(function() {
    
    initPropertyStatusList();

    init_admin_confirm();

    init_admin_field_triggers();

});