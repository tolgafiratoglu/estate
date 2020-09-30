var page_offset = 0;

    var xhr;
    var request_source = "filter";

    var ajax_request = function request_ajax(){

        if(xhr && xhr.readyState != 4){
            xhr.abort();
        }

        var csrfToken = $('meta[name=csrf-token]')[0].content;

        var posts_per_page  = $("#qual_property_results").attr("data-perpage");
        var pagination = $("#qual_property_results").attr("data-pagination");

        if(request_source == "infinite_scroll"){
            page_offset += 1;
        }else{

            $(".qual-uptown-infinite-scroll").removeClass("active");
            $(".qual-uptown-pagination-no-posts").removeClass("active");

            $(".property-results-loading").show();
            $("#property_results").html("");
        }

        var location            = $("#qual_location").val();
        var floor               = $("#qual_floor").val();
        var property_type       = $("#qual_property_type").val();
        var property_status     = $("#qual_property_status").val();
        var interior_features   = $("#qual_interior_features").val();
        var exterior_features   = $("#qual_exterior_features").val();
        var number_of_bathrooms = $("#qual_number_of_bathrooms").val();
        var order               = $("#qual_order").val();

        var area                 = $("#qual_area").val();
        var number_of_rooms      = $("#qual_number_of_rooms").val();
        var age_of_building     = $("#qual_age_of_building").val();

        var address             = encodeURIComponent($("#qual_address").val());
        var keyword             = encodeURIComponent($("#qual_keyword").val());

        var min_price    = $("#property_filter_min_price").val();
        var max_price    = $("#property_filter_max_price").val();

        var request_data = {
                                _token: csrfToken,
                                page_offset:page_offset,
                                posts_per_page: posts_per_page,
                                pagination: pagination,
                                    min_price: min_price,
                                    max_price: max_price,
                                    location: location,
                                    property_type: property_type,
                                    property_status: property_status,
                                    interior_features: interior_features,
                                    exterior_features: exterior_features,
                                    number_of_bathrooms: number_of_bathrooms,
                                    area: area,
                                    floor: floor,
                                    number_of_rooms: number_of_rooms,
                                    age_of_building: age_of_building,
                                    order: order
                            };

            if(address != "undefined"){
                request_data["address"] = address;
            }

            if(keyword != "undefined"){
                request_data["keyword"] = keyword;
            }

                xhr = $.ajax( {
                    url : "/api/search/property",
                    type : 'POST',
                    data: request_data,
                    success: function(response){

                        $(".property-results-loading").hide();

                        if(request_source == "infinite_scroll"){
                            if(response != ""){
                                $(".qual-uptown-infinite-scroll").addClass("active");
                                $(".qual-uptown-pagination-loading").removeClass("active");
                                    $("#qual_property_results").append(response);
                            }else{
                                $(".qual-uptown-infinite-scroll").removeClass("active");
                                $(".qual-uptown-pagination-no-posts").addClass("active");
                            }
                        }else{
                            $("#qual_property_results").html(response);

                            if(pagination == "infinite_scroll"){
                                $(".qual-uptown-infinite-scroll").addClass("active");
                            }

                        }

                        if($(response).filter(".qual-no-post-found").length > 0){
                            $(".qual-uptown-infinite-scroll").removeClass("active");
                        }

                        init_link_handler();
                        init_pagination_handler();

                    }
                });

    }

    var timeout_handle = null;
    var instant_request_lock = false;

    function request_ajax_timeout(source){


        if(timeout_handle != null){
            clearTimeout(timeout_handle);
        }

        request_source = source;

            timeout_handle = setTimeout(
                ajax_request, 500
            );


    }

    function number_format(number, decimals, decPoint, thousandsSep) {

        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        var n = !isFinite(+number) ? 0 : +number
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
        var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
        var s = ''

        var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
        }

        // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
        }

        return s.join(dec)
    }

    function location_keyup(){

        $(".location_keyword").keyup(
            function(){

                var location_search_keyword = $(this).val();

                $(this).closest(".filter-input").find(".qual-filter-switcher").each(
                    function(){

                        var switch_content = $(this).html();
                        var search_in_keyword = switch_content.toLowerCase().indexOf(location_search_keyword.toLowerCase());

                        if(search_in_keyword == -1 && !$(this).hasClass("qual-location-all")){
                            $(this).hide();
                        }else{
                            $(this).show();
                        }

                    }
                );

            }
        );

    }

    function init_filter_handlers(){

        $(".filter-element").keyup(
            function(){
                if(instant_request_lock == false){
                    request_ajax_timeout("filter");
                }
            }
        );

        $(".qual-range-value-input.qual-price-range").keyup(
            function(){
                var data_target = $(this).attr("data-target");
                var data_value  = $(this).val();

                if(data_value == ""){
                    $("."+data_target).find(".value-wrapper .default-label").show();
                    $("."+data_target).find(".value-wrapper .custom-label").hide();
                }else{
                    var qual_default_currency = $("#qual_default_currency").val();

                        data_value = qual_default_currency+number_format(Number(data_value));
                    $("."+data_target).find(".value-wrapper .custom-label").html(data_value);
                    $("."+data_target).find(".value-wrapper .default-label").hide();
                    $("."+data_target).find(".value-wrapper .custom-label").show();
                }

            }
        );

        $(".qual-range-value-input.qual-area-range").keyup(
            function(){
                var data_target = $(this).attr("data-target");
                var data_value  = $(this).val();

                if(data_value == ""){
                    $("."+data_target).find(".value-wrapper .default-label").show();
                    $("."+data_target).find(".value-wrapper .custom-label").hide();
                }else{
                    var qual_default_currency = $("#qual_default_currency").val();

                    data_value = qual_default_currency+number_format(Number(data_value));
                    $("."+data_target).find(".value-wrapper .custom-label").html(data_value);
                    $("."+data_target).find(".value-wrapper .default-label").hide();
                    $("."+data_target).find(".value-wrapper .custom-label").show();
                }

            }
        );

        location_keyup();

        $(".filter-switcher").click(
            function(){

                var target = $(this);
                target.closest("ul").find("li").removeClass("active");
                target.addClass("active");

                var data_id     = target.attr("data-id");
                var data_target = target.attr("data-target");
                var label_value = target.html();

                var target_value_wrapper = target.closest(".qual-filter-wrapper-unit");

                $("#"+data_target).val(data_id);

                if(data_id == 0){

                    target_value_wrapper.find(".default-label").css("display", "inline-block");
                    target_value_wrapper.find(".custom-label").css("display", "none");

                }else{

                    target_value_wrapper.find(".custom-label").html(label_value);

                    target_value_wrapper.find(".default-label").css("display", "none");
                    target_value_wrapper.find(".custom-label").css("display", "inline-block");

                }

                if(instant_request_lock == false){
                    request_ajax_timeout("filter");
                }
            }
        );

        $(".qual-filter-order-switcher").click(
            function(){
                $(".order-label").html($(this).html());
            }
        );

        $(".qual-filter-location-switcher").click(
            function(){

                var getchildren = $(this).attr("data-getchildren");
                if(getchildren == false){
                    return;
                }

                $(".location-label").html($(this).html());

                var base_url = $("#qual_uptown_base_url").val();
                var qual_filter_nonce = $("#_qual_filter_nonce").val();

                var parent_id = $(this).attr("data-id");
                var parent_label = $(this).html();

                var target_obj = $(this);

                $.ajax( {
                    url : base_url
                        + "/wp-admin/admin-ajax.php",
                    type : 'POST',
                    data: {action: "get_location_with_parent", parent_id:parent_id, parent_label:parent_label, qual_filter_nonce:qual_filter_nonce},
                    success: function(response){

                        if(parent_id > 0){
                            target_obj.closest(".qual-filter-wrapper-unit").find(".qual-child-location-wrapper").html(response);
                            location_keyup();
                            init_filter_handlers();
                        }else{
                            target_obj.closest(".qual-filter-wrapper-unit").find(".qual-child-location-wrapper").html("");
                        }

                    }
                });

            }
        );

        $(".filter-switcher-multiple").click(
            function(){

                var target = $(this);

                if(target.hasClass("active")){
                    target.removeClass("active");
                }else{
                    target.addClass("active");
                }

                var data_id     = target.attr("data-id");
                var data_target = target.attr("data-target");

                

                if(data_id == 0){

                    target.closest(".filter-content-wrapper").find(".filter-switcher-multiple").not(".default-switch");
                    $("#"+data_target).val("");

                }else{

                    target.closest(".filter-content-wrapper").find(".filter-switcher-multiple.default-switch").removeClass("active");

                    var values_serialized = [];
                    target.parent().find(".active."+data_target).each(
                        function(){
                            values_serialized.push($(this).attr("data-id"));
                        }
                    );


                    if(values_serialized.length > 0){
                        $("#"+data_target).val(values_serialized);
                    }else{
                        target.parent().find(".default-switch").addClass("active");
                        $("#"+data_target).val("");
                    }

                }

                if(instant_request_lock == false){
                    request_ajax_timeout("filter");
                }

            }
        );

        // $(".filter-wrapper-unit-scrollable").mCustomScrollbar({theme: "dark-thin"});
        // $(".dropdown-content .qual-filter-wrapper .filter-content-wrapper").mCustomScrollbar({theme: "dark-thin"});

    }

    var last_open_infowindow = null;

    function create_marker(infowindows, marker_obj, i){

        var qual_uptown_base_url = $("#qual_uptown_base_url").val();
        var google_maps_marker = $("#google_maps_marker").val();

        var map = window.map;

            var lat = marker_obj.lat;
            var lng = marker_obj.lng;
            var featured_image_src = marker_obj.featured_image_src;
            var property_title = marker_obj.property_title;

            var address = marker_obj.address;

            var price = marker_obj.price;

            var map_lat_lng = new google.maps.LatLng(lat, lng);

            var marker = new google.maps.Marker({
                position: map_lat_lng,
                map: map
            });

            if(google_maps_marker == ""){
                marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png')
            }else{
                marker.setIcon(google_maps_marker);
            }

            var deafult_currency = $("#qual_default_currency").val();

            var price_content = "";
                if(price != null){
                    price_content = '<div>'+deafult_currency+price+'</div>';
                }

            var infowindow_content = '<div class="qual-map-infowindow">' +
                                        '<div class="property-image-wrapper"><img src="'+featured_image_src+'"></div>' +
                                        '<div class="qual-map-property-content">' +
                                            '<h5 class="property-title">'+property_title+'</h5>' +
                                            '<div>'+address+'</div>'+
                                            price_content+
                                        '</div>'+
                                     '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: infowindow_content
            });

            infowindows.push(infowindow);

            // Open infowindow of the first property:
            if(i == 0){
                infowindow.open(map, marker);
                last_open_infowindow = infowindow;
            }

            // And add a listener to all markers:
            marker.addListener('click', function() {

                if(last_open_infowindow != null){
                    last_open_infowindow.close();
                }

                infowindow.open(map, marker);
                last_open_infowindow = infowindow;
            });

            /*
                marker.addListener('mouseout', function() {
                    setInterval(
                        function(){
                            infowindow.close();
                        }
                    ,2000);
                });
            */

        init_link_handler();

    }

    function init_map_button_handler(){


        $(".qual-advanced-filter-handler").click(
            function(){
                var target = $(this).attr("data-target");

                if(target == "open"){
                    $(".qual-top-filter-wrapper").removeClass("qual-uptown-hidden");
                    $(this).attr("data-target", "close");
                }else{
                    $(".qual-top-filter-wrapper").addClass("qual-uptown-hidden");
                    $(this).attr("data-target", "open");
                }

            }
        );

        $(".qual-map-handler").click(
            function(){

                var map_preference = $(this).attr("data-map");

                popup_last_content = "map";

                var base_url = $("#qual_uptown_base_url").val();
                var qual_filter_nonce = $("#_qual_filter_nonce").val();

                var request_data = {action: "get_map_locations", qual_filter_nonce: qual_filter_nonce};

                $.ajax( {
                        url : base_url
                            + "/wp-admin/admin-ajax.php",
                        type : 'POST',
                        data: request_data,
                        success: function(response){

                            $(".qual-uptown-single-loading").removeClass("active");

                            var lat = 0;
                            var lng = 0;

                            var parsed_json = JSON.parse(response);

                            // if(popup_last_content == "map"){

                                var google_maps_front_default_zoom = $("#google_maps_front_default_zoom").val();

                                if(typeof parsed_json[0].lat != "undefined"){
                                    lat = parsed_json[0].lat;
                                    lng = parsed_json[0].lng;
                                }

                                if(map_preference == "popup"){

                                    $(".qual-uptown-single-content-inner").html("");
                                    $(".qual-uptown-single-loading").addClass("active");
                                    $(".qual-uptown-single-content-wrapper").addClass("active");

                                    $(".qual-uptown-single-content-inner").html('<div class="qual-map-canvas-popup qual-uptown-mappable" data-setmarker="0" data-lat="'+lat+'" data-lng="'+lng+'" data-zoom="'+google_maps_front_default_zoom+'"></div>');
                                    $(".qual-uptown-single-content-inner").attr("data-loaded", 1);

                                    init_map($(".qual-uptown-mappable.qual-map-canvas-popup"));

                                    $("body").css({overflow: "hidden"});

                                }else{

                                    var map_status = $("#qual-uptown-map-content").attr("map-status");

                                    if(map_status == "open"){
                                        $("#qual-uptown-map-content").hide();
                                        $("#qual-uptown-map-content").html("");
                                        $("#qual-uptown-map-content").attr("map-status", "close");
                                    }else{
                                        $("#qual-uptown-map-content").show();
                                        $("#qual-uptown-map-content").attr("map-status", "open");
                                    }

                                        $("#qual-uptown-map-content").html('<div class="qual-map-canvas-content qual-uptown-mappable" data-setmarker="0" data-lat="'+lat+'" data-lng="'+lng+'" data-zoom="'+google_maps_front_default_zoom+'"></div>');
                                        $("#qual-uptown-map-content").attr("data-loaded", 1);

                                        init_map($(".qual-uptown-mappable.qual-map-canvas-content"));

                                }


                                content_wrapper_handlers();

                                    var infowindows = [];

                                        for(var i = 0; i <= parsed_json.length - 1; i++){

                                            create_marker(infowindows, parsed_json[i], i);

                                        }

                            // }

                        }
                    }
                );


            }
        );

        if($(".qual-uptown-mappable.qual-uptown-single-map").length > 0){
            init_map($(".qual-uptown-mappable.qual-uptown-single-map"));
        }

    }

    var rangeslider_filter_timeout = null;

    function range_slider(){

        $(".filter-value-range").each(

            function(){

                var range_id = $(this).attr("id");

                var target  = $(this).attr("data-target");
                var min     = parseInt($(this).attr("data-start"));
                var max     = parseInt($(this).attr("data-end"));
                var prefix  = $(this).attr("data-prefix");
                var postfix = $(this).attr("data-postfix");

                var slider = document.getElementById(range_id);

                    noUiSlider.create(slider, {
                        start: [min, max],
                        connect: false,
                        range: {
                            'min': min,
                            'max': max
                        }
                    });

                slider.noUiSlider.on('update', function ( values, handle ) {
                    $("#"+target).val(parseInt(values[0])+","+parseInt(values[1]));
                        $("#"+target+"_range_min").html(number_format(Number((values[0]))));
                        $("#"+target+"_range_max").html(number_format(Number(values[1])));
                });

                slider.noUiSlider.on('end', function(){
                    if(instant_request_lock == false){
                        request_ajax_timeout("filter");
                    }
                });

            }

        );



    }

    function init_slider(){

            var slider = $(".qual-light-slider").lightSlider({
                gallery: true,
                item: 1,
                thumbItem: 9
            });

    }

    function close_content(){

        $(".qual-uptown-single-content-inner").html("");
        $(".qual-uptown-single-content-wrapper").removeClass("active");
        $("body").css({ overflow: 'inherit' });

        var qual_uptown_base_url = $("#qual_uptown_base_url").val();

        if (history.pushState) {
            history.pushState({}, null, qual_uptown_base_url);
        }

    }

    function content_wrapper_close_handlers(){

        $(".qual-uptown-close-popup").click(
            function(){
                close_content();
            }
        );

        $(".qual-uptown-single-content-wrapper").click(
            function(e){
                if(e.target != this) return;

                close_content();

            }
        );

        $(".qual-uptown-single-close a").click(
            function(){
                close_content();
            }
        );

    }

    function content_wrapper_handlers(){

        content_wrapper_close_handlers();

    }

    var popup_last_content = "";

    function open_content_popup(href, browser){

        popup_last_content = href;

        $(".qual-uptown-single-content-inner").html("");
        $(".qual-uptown-single-loading").addClass("active");
        $(".qual-uptown-single-content-wrapper").addClass("active");

        $("body").css({overflow: "hidden"});
        content_wrapper_handlers();

        $.ajax( {
            url : href,
            type : 'POST',
            success: function(response){

                $(".qual-uptown-single-loading").removeClass("active");

                var single_content = $(response).find(".qual-uptown-content-wrapper");

                if(popup_last_content == href){
                    $(".qual-uptown-single-content-inner").html(single_content);
                }

                if(browser == "popup"){
                    document.location.hash = "url:"+href;
                }else{
                    window.history.pushState({"html":href},"", href);
                }

                // Init slider:
                $(document).ready(
                    function(){
                        init_slider();
                        init_link_handler();



                    }
                );

                init_map($(".qual-uptown-mappable.qual-uptown-single-map"));

            },
            statusCode: {
                404: function() {
                    $(".qual-uptown-single-loading").removeClass("active");
                    $(".qual-uptown-single-content-inner").html($("#qual_page_not_found").val()).addClass("active");
                }
            }
        });

    }

    function init_link_handler(){

        $(".qual-uptown-open-menu").click(
            function(eventObj){

                eventObj.preventDefault();

                var data_filter = $(this).attr("data-filter");

                document.location.hash = "qual-filter-wrapper";
                $(".qual-filter-wrapper").removeClass("qual-uptown-hidden");
                return false;

                if(data_filter == "top" || data_filter == "top-button"){
                    document.location.hash = "qual-top-filter-wrapper";
                }else{
                    document.location.hash = "qual-filter-wrapper";
                }

                $("body").css({overflow: "hidden"});
                $(".qual-filter-wrapper").removeClass("qual-uptown-hidden");
                // $(".qual-filter-wrapper").addClass("qual-filter-wrapper-target");

            }
        );

        $(".qual-uptown-close-menu").click(
            function(){
                $("body").css({overflow: "inherit"});

                var data_filter = $(".qual-uptown-open-menu").attr("data-filter");

                if(data_filter == "top" || data_filter == "top-button"){
                    $(".qual-left-filter-wrapper").addClass("qual-uptown-hidden");
                }

            }
        );

        $(".qual-uptown-popup-link").click(
            function(e){
                e.preventDefault();

                var href = $(this).attr("href");
                var browser = $(this).attr("data-browser");

                open_content_popup(href, browser);

            }
        );

    }

    function init_pagination_handler(){

        $(".qual-uptown-pagination .qual-page").click(
            function(e){

                e.preventDefault();

                var page = $(this).attr("data-page");
                page_offset = page - 1;

                request_ajax_timeout("pagination");

                $('html, body').animate({ scrollTop: 0 }, 'slow', function () {});

                var get_page_link = $("#get_page_link").val();
                window.history.pushState({"html": get_page_link+"page/"+page},"", get_page_link+"page/"+page);

            }
        );

    }

    function init_infinite_scroll(){
        $(".qual-uptown-infinite-scroll").click(
            function(){

                $(".qual-uptown-infinite-scroll").removeClass("active");
                $(".qual-uptown-pagination-loading").addClass("active");

                    request_ajax_timeout("infinite_scroll");

            }
        );
    }

    function init_listen_hash(){

        var hash = window.location.hash;
            var hash_split = hash.split("url:");

            if(typeof hash_split[1] == "string"){
                open_content_popup(hash_split[1], "popup");
            }

    }

    function init_map(map_object){

        var map;
        // function initialize(map_handler_object) {

            var qual_uptown_base_url = $("#qual_uptown_base_url").val();
            var google_maps_marker = $("#google_maps_marker").val();

            var markers = [];

            // $(".qual-uptown-mappable").each(
            //    function(){

                    var lat = map_object.attr("data-lat");
                    var lng = map_object.attr("data-lng");
                    var setmarker_flag = map_object.attr("data-setmarker");
                    var zoom = parseInt(map_object.attr("data-zoom"));

                    if(typeof lat == "undefined"){
                        return false;
                    }

                        var mapOptions = {
                            zoom: zoom,
                            center: new google.maps.LatLng(lat, lng)
                        };
                        map = new google.maps.Map(map_object[0],
                            mapOptions);

                        window.map = map;

                        var map_lat_lng = new google.maps.LatLng(lat, lng);

                        var set_marker = true;
                            if(setmarker_flag == 0){
                                set_marker = false;
                            }

                            if(set_marker == true){
                                var marker = new google.maps.Marker({
                                    position: map_lat_lng,
                                    map: map
                                });

                                if(google_maps_marker == ""){
                                    marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png')
                                }else{
                                    marker.setIcon(google_maps_marker);
                                }

                                markers.push(marker);
                            }

                // }
            // );



        // }

        /*
            // If there is a mappable div, init map:
            if($(".qual-uptown-mappable").length > 0){
                google.maps.event.addDomListener(window, 'load', initialize($(this)));
            }
        */

        $(".qual-uptown-single-loading").removeClass("active");

    }

    function init_ajax_button(){

        if($(".qual-filter-ajax-button").length > 0){
            instant_request_lock = true;
        }

        $(".qual-filter-ajax-button").click(
            function(){
                request_ajax_timeout("filter_button");
            }
        );

    }

    function enableFontAwesomeContent(){
        window.FontAwesomeConfig = {
            searchPseudoElements: true
        }
    }

    $(document).ready(
        function(){

            // Filter handlers:
            init_filter_handlers();

            // init_map();
            init_map_button_handler();

            init_slider();

            init_link_handler();

            init_pagination_handler();
            init_infinite_scroll();

            init_listen_hash();

            init_ajax_button();

            content_wrapper_close_handlers();

            enableFontAwesomeContent();

        }
    );
