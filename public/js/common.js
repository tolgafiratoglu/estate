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

$( document ).ready(function() {

    initSlugTrigger();

});