<?php 
/*
Template Name: Social
*/

if ( !is_front_page() ) {
    get_header();
}

?>

<!-- Start Social -->
<section id="social" data-stellar-background-ratio="0.4">
    <div class="bg-lanch"></div>
    <div class="inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-1 col-sm-12 col-md-6 col-lg-5 wow bounceInLeft">                    
                    <?php
                        query_posts( array ( 'post_type' => 'social', 'posts_per_page'=>1 ) );
                        if ( have_posts() ) : while ( have_posts() ) : the_post();                          
                    ?>
                    <h1><?php the_title(); ?></span></h1>
                    <p><?php the_content(); ?></p>
                    <?php endwhile; else: ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?>
                    <?php wp_reset_query(); ?>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!--=== End Social ===-->

<?php 
    if ( !is_front_page() ) {
        get_footer();
    }
?>