window.slugLock = false;

window.stringToSlug = function stringToSlug (str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();
  
    // remove accents, swap ñ for n, etc
    var from = "àáãäâèéëêıìíïîòóöôùúüûñçğ·/_,:;";
    var to   = "aaaaaeeeeiiiiioooouuuuncg------";

    for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
}

/*
    Init slug trigger
*/
function initSlugTrigger() 
{

    $(".slug").focusout(
        function(){
            if($(".slug").val() != ""){
                window.slugLock = true; 
            }
        }
    );        

    $(".slug-trigger").keyup(
        function(){
            if(!window.slugLock){
                var context = $(this).attr("data-context");
                var stringToSlug = window.stringToSlug($(this).val());
                $(".slug").val(stringToSlug);
            }
        }
    );
    
}    

function initCustomVariables(){
    $(".custom-variable-add-row").click(
        function(){
            var clonableRow = $(".estate-custom-variables .clonable").clone();
                clonableRow.removeClass("d-none");
                clonableRow.removeClass("clonable");
                    $(".estate-custom-variables table").append(clonableRow);
        }
    );
}

function initGoogleMaps(){

    var map;
    function initialize(map_handler_object) {

        var markers = [];

        if($(".estate-mappable").length > 0) {
            $('html').bind('keypress', function (e) {
                if (e.keyCode == 13) {
                    return false;
                }
            });
        }

        $(".estate-mappable").each(
            function(){
                var lat = $(this).attr("data-lat");
                var lng = $(this).attr("data-lng");
                var zoom = parseInt($(this).attr("data-zoom"));

                var mapOptions = {
                    zoom: zoom,
                    center: new google.maps.LatLng(lat, lng)
                };

                // Create a map object:
                map = new google.maps.Map(this,
                    mapOptions);

                var map_lat_lng = new google.maps.LatLng(lat, lng);

                var marker = new google.maps.Marker({
                    position: map_lat_lng,
                    map: map
                });

                markers.push(marker);

                // Search for keyword:

                var input = document.getElementById('map_search_keyword');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });

                // var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    // Clear out the old markers.
                    markers.forEach(function(marker) {
                        marker.setMap(null);
                    });
                    // markers = [];

                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function(place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));

                        // Set lat,long to settings:
                        var latitude = place.geometry.location.lat();
                        var longitude = place.geometry.location.lng();

                        $("#lat_value").val(latitude);
                        $("#lat_label").html(latitude);

                        $("#lng_value").val(longitude);
                        $("#lng_label").html(longitude);

                        setTimeout(
                            function(){
                                var zoom = map.getZoom();

                                $("#zoom_value").val(zoom);
                                $("#zoom_label").html(zoom);
                            }, 1000
                        );

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });

            }
        );

        if($(".clickable-map").length > 0){

            google.maps.event.addListener(map, "click", function(event) {
                var lat = event.latLng.lat();
                var lng = event.latLng.lng();

                var map_lat_lng = new google.maps.LatLng(lat, lng);

                console.log("Markers",markers);

                for(var i in markers){
                    console.log("Marker id:", i);
                    markers[i].setMap(null);
                }

                var marker = new google.maps.Marker({
                    position: map_lat_lng,
                    map: map
                });

                markers.push(marker);

                var zoom = map.getZoom();

                $("#lat_value").val(lat);
                $("#lat_label").html(lat);

                $("#lng_value").val(lng);
                $("#lng_label").html(lng);

                $("#zoom_value").val(zoom);
                $("#zoom_label").html(zoom);

            });

        }

    }

    // If there is a mappable div, init map:
    if($(".estate-mappable").length > 0){
        google.maps.event.addDomListener(window, 'load', initialize($(this)));
    }

}

function initChosen()
{
    $(".chosen-selector").chosen({});
}



function initFileUploader()
{
    
    $("#image-upload-select-button").click(
        function(){
            $("#image_upload_file_handler").click();
        }
    )

    $("#image_upload_file_handler").change(
        function(){
            if($(this).get(0).files.length > 0){
                // Upload images one by one:
                for(var i = 0; i < $(this).get(0).files.length; i++){
                    var fileToUpload   = $(this).get(0).files[i];
                    var fileUploadSize = $(this).get(0).files[i].size;

                    var imageUploadData = new FormData();
                        imageUploadData.append('upload_image', fileToUpload);
                        imageUploadData.append('_token', $('meta[name=csrf-token]')[0].content);

                        $.ajax({
                            url: '/media/save',
                            type: 'POST',
                            data: imageUploadData,
                            dataType: 'json',
                            mimeType: 'multipart/form-data',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(response, status, jqXHR){
                                console.log(response, status);
                            },
                            error: function(jqXHR,status,error){
                                
                            }
                        });

                }
            }
        }
    );    

}

$( document ).ready(function() {

    initSlugTrigger();

    initCustomVariables();

    initGoogleMaps();

    initChosen();

    initFileUploader();

});