
<?php
//Template Name: Directory
get_header();
include 'layout/top-header.php';
include 'layout/brand.php';
?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtGfWMP7UZ-0k3oPapHlWLEQkCbsmFno4"></script>

<div class="container" style="padding: 20px;">
    <div class="row">
        <div id="main" class="col-md-3">
            <div class="facet-widget">
                <h5 id="search-facet" class="facet-label"> Search </h5>
                    <?php echo facetwp_display( 'facet', 'search' ); ?>
                <h5 id="region-facet" class="facet-label"> Regions <i class="fas fa-chevron-down"></i></h5>
                    <?php echo facetwp_display( 'facet', 'regions' ); ?>
                <h5 id="primary-care-facet" class="facet-label"> Primary Care <i class="fas fa-chevron-down"></i></h5>
                    <?php echo facetwp_display( 'facet', 'primary_care' ); ?>
                <h5 id="specialists-facet" class="facet-label"> Specialists <i class="fas fa-chevron-down"></i></h5>
                    <?php echo facetwp_display( 'facet', 'specialist' ); ?>
                <h5 id="ancillary-facet" class="facet-label"> Ancillary <i class="fas fa-chevron-down"></i></h5>
                    <?php echo facetwp_display( 'facet', 'ancillary' ); ?>
                <!-- <h5 id="capitated-specialists-facet" class="facet-label"> Capitated Specialists <i class="fas fa-chevron-down"></i></h5>
                    <?php echo facetwp_display( 'facet', 'capitated_specialist' ); ?> -->
            </div>
        </div>
        <script>
            hide_show_facets('#region-facet', '.facetwp-facet-regions');
            hide_show_facets('#primary-care-facet', '.facetwp-facet-primary_care');
            hide_show_facets('#specialists-facet', '.facetwp-facet-specialist');
            hide_show_facets('#ancillary-facet', '.facetwp-facet-ancillary');
            hide_show_facets('#capitated-specialists-facet', '.facetwp-facet-capitated_specialist');
        </script>
        <?php
        $dir_args = array(
          "post_type" => "physicians",
          "post_status" => "publish",
          "orderby" => "title",
          "order" => "ASC",
          "posts_per_page" => -1
        );
        $physicians = new WP_Query($dir_args);
        $directory = get_field('directory');

        if($physicians->have_posts()) : ?>
            <div id="main" class="col-md-8 offset-md-1">
                <div class="facetwp-template directory-section">
                    <?php while ( $physicians->have_posts()): $physicians->the_post(); ?>
                        <div class="container" style="border-top: solid 1px; padding: 20px;">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>
                                    <?php
                                    $name = get_field('name');
                                    $clean = ucwords(strtolower($name));?>
                                   <a class="physician-name" href="<?php the_permalink(); ?>" title="<?php get_field('name'); ?>"><?php echo $clean; ?></a>
                                </h4>
                                <span><i><?php
                                    $primary_care = get_field('primary_care');
                                    $specialists = get_field('specialists');
                                    $ancillary = get_field('ancillary');
                                    $capitated_specialists = get_field('capitated_specialists');

                                    echo ucfirst(strtolower($primary_care));
                                    echo ucfirst(strtolower($specialists));
                                    echo ucfirst(strtolower($ancillary));
                                    echo ucfirst(strtolower($capitated_specialists));
                                ?>
                                </i></strong></span>
                            </div>

                            <div class="col-md-4">
                                <span>Phone: <?php $phone = get_field('phone'); echo $phone; ?></span>
                                <br>
                                <span>Fax: <?php $fax = get_field('fax'); echo $fax; ?></span>
                                <br>
                                <span>Hours: <?php $hours = get_field('hours'); echo $hours; ?></span>
                            </div>
                            <div class="col-md-4">
                                <?php $address = get_field('address'); if ($address) : echo ucwords(strtolower($address['address']));  endif ?>
                            </div>
                        </div>
                        <br>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php echo facetwp_display( 'pager' ); ?>
                <div class="facetwp-pager"></div>
                <button class="fwp-load-more">Load more</button>
            </div>
        <?php endif;?>
    </div>
</div>

<?php include 'layout/top-footer.php';
get_footer(); ?>


