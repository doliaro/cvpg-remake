function hide_show_facets(facet_id, facet_class){
    jQuery(facet_id).css('cursor','pointer');
    jQuery(facet_class).css('display','none');

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

'#region-facet'
'.facetwp-facet-regions'