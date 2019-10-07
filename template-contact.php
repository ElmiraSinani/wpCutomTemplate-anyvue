<?php 
/*
Template Name: Contact Page
*/

if ( !is_front_page() ) {
    get_header();
}

?>
<!-- Start Contacts -->
<section id="contacts">
    <div class="contacts-top">
        <div class="container text-center">
            <?php
                query_posts( array ( 'post_type' => 'contact_info', 'contact_info-cat' => 'contact_form_title', 'posts_per_page'=>1 ) );
                if ( have_posts() ) : while ( have_posts() ) : the_post();                          
            ?>
            <h2><?php the_title(); ?></h2>            
            <p><?php the_content(); ?></p>
            <?php endwhile; else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
            
            <div class="row feedback">
                <div class="form">
                   <?php $content = '[contact-form-7 id="37" title="Contact form 1"]'; ?>
                    <?php echo do_shortcode( $content ) ?>
                </div>
            </div>

        </div>
    </div>
    <div class="contacts-bottom">
        <div class="up-btn text-center">
            <div class="container">
                <a href="#" id="up"></a>
            </div>
        </div>
        <div class="map-block">
            <div id="map"></div>
        </div>
    </div>
</section>
<!--=== End Contacts ===-->

<?php 
    if ( !is_front_page() ) {
        get_footer();
    }
?>
