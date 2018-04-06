<?php
//Template Name: Full Width Page
get_header();
include 'layout/top-header.php';
include 'layout/brand.php';

// $front_image_url = mapi_thumb($front_image, 1500, 700, 90);
// $post_thumbnail_id = get_post_thumbnail_id( $post->ID );

?>
    <main role="main" aria-label="Content" class="container-fluid">
        <div class="row">
            <!-- <div class="top-image" style="background-image: linear-gradient(rgba(0, 0, 0, .45), rgba(0, 0 ,0, .45)), url('<?= $front_image_url; ?>');">
            <img src="('<?= $front_image_url; ?>')"></img> -->
            <div class="col-12">
                <section>
                    <!-- <h1><?php the_title(); ?></h1> -->
                    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php
                            $image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
                            $front_image_url = aq_resize($image_url, 2100, 1000, true, true, true);
                            ?>
                            <div class="banner">
                                <img src="<?php echo $front_image_url; ?>" title="banner"/>
                            </div>


                            <?php comments_template('', true);  ?>

                            <br class="clear">

                            <!-- <?php edit_post_link(); ?> -->

                        </article>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </section>
            </div>

        </div>
    </main>
    <?php include 'layout/overlay_boxes.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col welcome-text">
                <?php
                    if( have_rows('homepage_welcome_text') ){
                        while ( have_rows('homepage_welcome_text') ) : the_row(); ?>
                            <div class="welcome-title">
                                <?php the_sub_field('main_text');?>
                            </div>
                            <br>
                            <div class="welcome-subtext">
                                <?php the_sub_field('subtext');?>
                            </div>
                        <?php endwhile;
                    }
                ?>
            </div>
        </div>
    </div>
<?php include 'layout/top-footer.php';
get_footer();


