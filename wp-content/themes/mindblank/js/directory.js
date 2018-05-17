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
        jQuery('.facetwp-checkbox[data-value=region_1]').append("<p>Montclair, Pomona, Fontana, Chino Hills, San Bernardino County and surrounding areas</p>");
        jQuery('.facetwp-checkbox[data-value=region_2]').append("<p>Covina, West Covina, Baldwin Park, El Monte, La Puente, Glendora, Azusa, Hacienda Heights, Rowland Heights and Whittier</p>");
        jQuery('.facetwp-checkbox[data-value=region_3]').append("<p>Arcadia, Duarte and Monrovia</p>");
        jQuery('.facetwp-checkbox[data-value=region_4]').append("<p>San Gabriel Valley, Inland Empire, Glendale and San Fernando Valley</p>");
        jQuery('.facetwp-checkbox[data-value=region_5]').append("<p>Long Beach, Downey, Bellflower, Lakewood, Paramount and Hawaiian Gardens</p>");
    }, 100);
});