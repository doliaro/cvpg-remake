<?php get_header();
include 'layout/top-header.php';
include 'layout/brand.php';
?>
<main role="main" aria-label="Content" class="container">
    <div class="row">
        <div class="col">
            <section>
                <h1><?php the_title(); ?></h1>
                <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                    <? if( has_post_thumbnail() ): ?>
                        <div class="post-image">
                            <img title="image title" alt="thumb image" class="wp-post-image"
                                 src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" style="width:100%; height:auto; display:block;">
                        </div>
                    <? endif; ?>

                    <!-- article -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php if( have_rows('section_content')) {
                            while( have_rows('section_content')) : the_row();
                                the_sub_field('content_title'); ?>
                                    <div class="container">
                                        <div class="row"> <?php
                                            if( get_sub_field('show_boxes')){
                                                if( have_rows('links')) {
                                                    while( have_rows('links')) : the_row(); ?>
                                                        <div class="col-4">
                                                            <ul style="padding-left:0;">
                                                                <li class="list-group-item"><h5>Links</h5></li>
                                                                <li class="list-group-item"><strong><u><a href="<?php echo get_sub_field('href'); ?>"><?php echo get_sub_field('name'); ?></a></u></strong></li>
                                                            </ul>
                                                        </div>
                                                    <?php endwhile;
                                                }
                                                if( have_rows('forms')) {
                                                    while( have_rows('forms')) : the_row(); ?>
                                                        <div class="col-4">
                                                            <ul style="padding-left:0;">
                                                                <li class="list-group-item"><h5>Forms</h5></li>
                                                                <li class="list-group-item"><strong><u><a href="<?php echo get_sub_field('href'); ?>"><?php echo get_sub_field('name'); ?></a></u></strong></li>

                                                            </ul>
                                                        </div>
                                                    <?php endwhile;
                                                }
                                                if( have_rows('pdfs')) {
                                                    while( have_rows('pdfs')) : the_row(); ?>
                                                        <div class="col-4">
                                                            <ul style="padding-left:0;">
                                                                <li class="list-group-item"><h5>PDF</h5></li>
                                                                <li class="list-group-item"><strong><u><a href="<?php echo get_sub_field('href'); ?>"><?php echo get_sub_field('name'); ?></a></u></strong></li>

                                                            </ul>
                                                        </div>
                                                    <?php endwhile;
                                            }
                                        } ?>
                                        </div>
                                    </div> <?php
                                the_sub_field('content');
                            endwhile;
                        } ?>


                        <?php the_content(); ?>

                        <?php comments_template('', true); // Remove if you don't want comments ?>

                        <br class="clear">

                    </article>
                    <!-- /article -->

                <?php endwhile; ?>

                <?php else: ?>

                    <!-- article -->
                    <article>

                        <h2><?php _e('Sorry, nothing to display.', 'mindblank'); ?></h2>

                    </article>
                    <!-- /article -->

                <?php endif; ?>

            </section>
        </div>
    </div>
            <!-- /section -->
</main>

<?php include 'layout/top-footer.php';
get_footer();
