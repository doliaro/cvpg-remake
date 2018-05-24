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
                                            if( get_sub_field('show_boxes')) :
                                                if( have_rows('links')) : ?>
                                                    <div class="col-4">
                                                        <ul style="padding-left:0;">
                                                            <li class="list-group-item"><h5>Links</h5></li>
                                                            <?php while( have_rows('links')) : the_row(); ?>
                                                                <li class="list-group-item"><strong><u><a href="<?php echo get_sub_field('href'); ?>"><?php echo get_sub_field('name'); ?></a></u></strong></li>
                                                            <?php endwhile; ?>
                                                        </ul>
                                                    </div>
                                                <?php endif;
                                                if( have_rows('forms')) : ?>
                                                    <div class="col-4">
                                                        <ul style="padding-left:0;">
                                                            <li class="list-group-item"><h5>Forms</h5></li>
                                                            <?php while( have_rows('forms')) : the_row(); ?>
                                                                <li class="list-group-item"><strong><u><a href="<?php echo get_sub_field('href'); ?>"><?php echo get_sub_field('name'); ?></a></u></strong></li>
                                                            <?php endwhile; ?>
                                                        </ul>
                                                    </div>
                                                <?php endif;
                                                if( have_rows('pdfs')) : ?>
                                                    <div class="col-4">
                                                        <ul style="padding-left:0;">
                                                            <li class="list-group-item"><h5>PDF</h5></li>
                                                            <?php while( have_rows('pdfs')) : the_row(); ?>
                                                                <li class="list-group-item"><strong><u><a href="<?php echo get_sub_field('href'); ?>"><?php echo get_sub_field('name'); ?></a></u></strong></li>
                                                            <?php endwhile; ?>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div> <?php
                                the_sub_field('content');
                            endwhile;
                        } ?>


                        <?php if( have_rows('training_section')) {
                            while( have_rows('training_section')) : the_row();?>
                                <div class="training">
                                    <h5 style="text-align: left;"><?php echo get_sub_field('training_section_header'); ?></h5>
                                    <ul style="list-style: none;">
                                        <?php while( have_rows('training_content')) : the_row(); ?>
                                            <li>
                                                <strong><u><a href="<?php echo get_sub_field('href'); ?>" target="_blank" rel="noopener"><?php echo get_sub_field('link_title'); ?>:</a></u></strong>
                                                <?php echo get_sub_field('description'); ?>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                                <?php the_sub_field('content');
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
