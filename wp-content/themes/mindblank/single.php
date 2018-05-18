<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtGfWMP7UZ-0k3oPapHlWLEQkCbsmFno4"></script>
<?php get_header();
include 'layout/top-header.php';
include 'layout/brand.php';
?>
    <main role="main" aria-label="Content" <?php post_class('container'); ?>>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-10">
                        <h3>
                            <?php $name = get_field('name');
                            $clean = ucwords(strtoupper($name)); echo $clean;?>
                        </h3>
                        <h5>
                            <?php $primary_care = get_field('primary_care');
                            $specialists = get_field('specialists');
                            $ancillary = get_field('ancillary');
                            $capitated_specialists = get_field('capitated_specialists');

                            echo ucfirst(strtoupper($primary_care));
                            echo ucfirst(strtoupper($specialists));
                            echo ucfirst(strtoupper($ancillary));
                            echo ucfirst(strtoupper($capitated_specialists));?>
                        </h5>
                        <p>Phone: <?php $phone = get_field('phone'); echo $phone; ?>
                        <br>Fax: <?php $fax = get_field('fax'); echo $fax; ?>
                        </p>
                        <p><?php $address = get_field('address'); echo $address['address'];?></p>
                    </div>
                </div>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="row">
                        <div class="col-12">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="single-thumb">
                                <?php
                                $image = get_the_post_thumbnail_url();
                                $image_url = aq_resize($image, 300, 300, true, true);
                                ?>
                                <img src="<?php echo $image_url; ?>"  title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <?php the_content(); ?>
                <div class="row">
                    <!-- <div class="col-md-4">
                        <?php $address = get_field('address'); echo $address['address'];?>
                    </div> -->
                    <div class="col-md-10">
                        <?php $address = get_field('address'); if( !empty($address) ): ?>
                            <div class="acf-map">
                                <div class="marker" data-lat="<?php echo $address['lat']; ?>" data-lng="<?php echo $address['lng']; ?>"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <!-- /section -->
    </main>

<?php include 'layout/top-footer.php';
get_footer();
