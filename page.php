<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="container single_post" id="post-<?php the_ID(); ?>">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h2 ><?php the_title(); ?></h2>

                    <?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

                    <div class="post_content">
                        <?php the_content(); ?>
                        <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
                        <?php the_tags( 'Tags: ', ', ', ''); ?>
                    </div>

                    <?php edit_post_link('Edit this entry','','.'); ?>

                    </div>
                </div>
            </div>
                


	<?php endwhile; endif; ?>

<?php get_footer(); ?>