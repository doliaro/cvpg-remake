function hide_show_facets(facet_id, facet_class){
    jQuery(facet_id).css('cursor','pointer');
    jQuery(facet_class).css('display','none');
    jQuery('.facetwp-autocomplete-update').attr('value', 'Go!');

    jQuery(facet_id).click(function(){
        if ( jQuery(facet_class).css('display') == 'none' ){
            jQuery(facet_class).css('display','block');
            jQuery(this).find('svg').toggleClass('fa-chevron-up fa-chevron-down');

        } else {
            jQuery(facet_class).css('display','none');
            jQuery(this).find('svg').toggleClass('fa-chevron-up fa-chevron-down');
        }
    });
}

jQuery(document).ready(function() {
    setTimeout(function() {
        jQuery('.facetwp-autocomplete-update').attr('value', 'Go!');
        jQuery('.facetwp-checkbox[data-value=1]').append("<p><i>Montclair, Pomona, Fontana, Chino Hills, San Bernardino County and surrounding areas</i></p>");
        jQuery('.facetwp-checkbox[data-value=2]').append("<p><i>Covina, West Covina, Baldwin Park, El Monte, La Puente, Glendora, Azusa, Hacienda Heights, Rowland Heights and Whittier</i></p>");
        jQuery('.facetwp-checkbox[data-value=3]').append("<p><i>Arcadia, Duarte and Monrovia</i></p>");
        jQuery('.facetwp-checkbox[data-value=4]').append("<p><i>San Gabriel Valley, Inland Empire, Glendale and San Fernando Valley</i></p>");
        jQuery('.facetwp-checkbox[data-value=5]').append("<p><i>Long Beach, Downey, Bellflower, Lakewood, Paramount and Hawaiian Gardens</i></p>");
    }, 100);
});



jQuery(document).ajaxSuccess(function() {
    jQuery('.facetwp-autocomplete-update').attr('value', 'Go!');
    jQuery('.facetwp-checkbox[data-value=1]').append("<p><i>Montclair, Pomona, Fontana, Chino Hills, San Bernardino County and surrounding areas</i></p>");
    jQuery('.facetwp-checkbox[data-value=2]').append("<p><i>Covina, West Covina, Baldwin Park, El Monte, La Puente, Glendora, Azusa, Hacienda Heights, Rowland Heights and Whittier</i></p>");
    jQuery('.facetwp-checkbox[data-value=3]').append("<p><i>Arcadia, Duarte and Monrovia</i></p>");
    jQuery('.facetwp-checkbox[data-value=4]').append("<p><i>San Gabriel Valley, Inland Empire, Glendale and San Fernando Valley</i></p>");
    jQuery('.facetwp-checkbox[data-value=5]').append("<p><i>Long Beach, Downey, Bellflower, Lakewood, Paramount and Hawaiian Gardens</i></p>");
});