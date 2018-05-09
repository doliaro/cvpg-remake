<?php
//Template Name: Full Width Page
get_header();
include 'layout/top-header.php';
include 'layout/brand.php';
?>
    <main role="main" aria-label="Content" class="container-fluid">
        <div class="row">
            <section>
                <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php
                        $image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );

                        $front_image_url = aq_resize($image_url, 2100, 1000, true, true, true);

                        ?>
                        <div class="banner">
                            <img width="100%" src="<?php echo $front_image_url; ?>" title="banner"/>
                        </div>

                        <?php comments_template('', true);  ?>

                        <br class="clear">

                    </article>
                <?php endwhile; ?>
                <?php endif; ?>
            </section>
        </div>
    </main>
    <?php include 'layout/overlay_boxes.php'; ?>

    <div class="container">

        <div class="row">
            <img class="aligncenter wp-image-1365 size-full"
                 src="<?php echo get_template_directory_uri(); ?>/img/cvpg_br.png"
                 alt="" width="1300" height="82" style="margin-bottom: 85px;margin-top: -110px;"/>
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


