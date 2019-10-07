<?php 
/*
Template Name: Welcome
*/

if ( !is_front_page() ) {
    get_header();
}

?>

<!-- Start Welcome -->
<section id="welcome">
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <?php
                    query_posts( array ( 'post_type' => 'welcome', 'welcome-cat' => 'welcome', 'posts_per_page'=>1, 'order' => 'ASC' ) );
                    if ( have_posts() ) : while ( have_posts() ) : the_post();                          
                ?>
                <h1><span class="highlight">
                <span class="word-rotate">
                    <span class="word-rotate-items">
                        <?php $slide_items = get_post_meta( get_the_ID(), 'title_slide_items', true ); ?>
                        <?php echo title_slider_item($slide_items); ?>
                    </span>
                </span>
                </span><?php the_title(); ?></h1>
                <div class="row">
                    <div class="col-md-offset-1 col-lg-offset-1 col-sm-12 col-md-10 col-lg-10">
                        <p class=" hp-center-text">
                            <?php the_content(); ?>
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="devices wow fadeInUp">
                            <?php 
                                if ( has_post_thumbnail()) : 
                                    the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                                endif; 
                            ?>                            
                        </div>
                    </div>
                </div>
                <?php endwhile; else: ?>
                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>
        </div>
    </div>
</section>
<!--=== End Welcome ===-->


<?php 
    if ( !is_front_page() ) {
        get_footer();
    }
?>
