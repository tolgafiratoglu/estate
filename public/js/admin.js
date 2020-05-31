function initPropertyStatusList(){

    $(".admin-property-status-save").click(
        function(){
            
            $.ajax({
                url: "/api/admin/property-status/save",
                type: "post",
                data: {_token: $('meta[name=csrf-token]')[0].content, "name": $("#property_status_name").val(), "slug": $("#property_status_slug").val()},
                success: function(data){
                    console.log(data);
                },
                error: function(error){
                    console.log(error.responseText);
                } 
            });

        }
    );

}

$( document ).ready(function() {
    
    initPropertyStatusList();

});