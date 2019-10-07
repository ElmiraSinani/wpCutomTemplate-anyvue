<?php 
/*
Template Name: Features
*/

if ( !is_front_page() ) {
    get_header();
}

?>
<!-- Start Features -->
<section id="features">
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <?php
                    query_posts( array ( 'post_type' => 'features', 'features-cat' => 'feature_title', 'posts_per_page'=>1 ) );
                    if ( have_posts() ) : while ( have_posts() ) : the_post();                          
                ?>
                <h2><?php the_content(); ?></h2>
                <h2 style="font-size: 60px;line-height: 60px;margin-bottom: 20px;font-weight: 900;">
                     <?php $title_item = get_post_meta( get_the_ID(), 'title_item', true ); ?>
                     <?php echo $title_item; ?>
                     <span class="highlight"><?php the_title(); ?></span>
                </h2>
                <p><?php the_excerpt(); ?></p>
                <?php endwhile; else: ?>
                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-offset-1 col-sm-12 col-md-12 col-lg-10">
                <div class="features-list">
                    <div class="row">
                         <?php
                            query_posts( array ( 'post_type' => 'features', 'features-cat' => 'feature_items', 'posts_per_page'=>-1, 'order' => 'DESC' ) );
                            if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                            $icon_class = get_post_meta( get_the_ID(), 'icon_class', true ); 
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="feature-block wow bounceIn">
                                <div class="<?php echo $icon_class; ?>"></div>
                                <div class="name">
                                    <?php the_title(); ?>
                                </div>
                                <div class="text"><?php the_excerpt(); ?></div>
                                <!-- <div class="more">
                                    <a href="<?php //the_permalink();?>" class="btn btn-default btn-sm">Read more</a>
                                </div>-->
                            </div>
                        </div>
                        <?php endwhile; else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=== End Features ===-->

<?php 
    if ( !is_front_page() ) {
        get_footer();
    }
?>