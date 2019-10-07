<?php 
/*
Template Name: Servies
*/

if ( !is_front_page() ) {
    get_header();
}

?>
<!-- Start Services -->
<section id="services">
    <div class="services-top">
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <?php
                    query_posts( array ( 'post_type' => 'services', 'services-cat' => 'services_title', 'posts_per_page'=>1 ) );
                    if ( have_posts() ) : while ( have_posts() ) : the_post();                          
                    ?>
                    <h2><?php the_title(); ?></h2>
                    <h2 style="font-size: 60px;line-height: 60px;margin-bottom: 20px;font-weight: 900;">
                    <?php $sub_title = get_post_meta( get_the_ID(), 'sub_title', true ); ?>
                    <?php echo $sub_title; ?>
                    </h2>
                    <p><?php the_content(); ?></p>
                    <?php endwhile; else: ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?>
                    <?php wp_reset_query(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-1 col-sm-12 col-md-12 col-lg-10">
                    <div class="services-list">
                        <div class="row">
                            <?php
                            query_posts( array ( 'post_type' => 'services', 'services-cat' => 'services_items' ) );
                            if ( have_posts() ) : while ( have_posts() ) : the_post();      
                            $class = get_post_meta( get_the_ID(), 'icon_class', true );
                            $sub_title = get_post_meta( get_the_ID(), 'sub_title', true );
                            ?>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="service-block wow flipInX">
                                    <div class="<?php echo $class; ?>"></div>
                                    <div class="text-block">
                                        <div class="name"><?php the_title(); ?></div>
                                        <div class="info"><?php echo $sub_title; ?></div>
                                        <div class="text"><?php the_excerpt(); ?></div>
                                    </div>
                                </div>
                            </div>
                            <p><?php the_content(); ?></p>
                            <?php endwhile; else: ?>
                            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                            <?php endif; ?>
                            <?php wp_reset_query(); ?>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="services-bottom" data-stellar-background-ratio="0.4">
        <div class="inner">
            <div class="container text-center">
                <div class="row">
                    <div id="quotes-slider" class="quotes-slider liquid-slider">
                        <?php
                        query_posts( array ( 'post_type' => 'services', 'services-cat' => 'services_slider' ) );
                        if ( have_posts() ) : while ( have_posts() ) : the_post();      
                        $class = get_post_meta( get_the_ID(), 'icon_class', true );
                        $sub_title = get_post_meta( get_the_ID(), 'sub_title', true );
                        ?>                        
                        <div class="quoteItem">
                            <div class="quote">
                                <?php 
                                    if ( has_post_thumbnail()) : 
                                        the_post_thumbnail( 'full', array( 'class' => 'img' ) );
                                    endif; 
                                ?>   
                                <div class="text"><?php the_content(); ?></div>
                                <div class="author"><?php the_title(); ?></div>
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
<!--=== End Services ===-->

<?php 
    if ( !is_front_page() ) {
        get_footer();
    }
?>