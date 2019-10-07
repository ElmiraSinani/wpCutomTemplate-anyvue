
<!-- Start Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4">
                <a href="<?php echo get_home_url(); ?>" class="logo">
                    <img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="" />
                </a>
            </div>
            <?php
                query_posts( array ( 'post_type' => 'contact_info', 'contact_info-cat' => 'footer_contacts', 'posts_per_page'=>2 ) );
                if ( have_posts() ) : while ( have_posts() ) : the_post();                          
            ?>
            <div class="col-lg-3 col-md-3 col-sm-4">
                <div class="contacts">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php endwhile; else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
            
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="copyright">
                    <p>Copyright &copy; <?php echo date("Y"); echo " "; bloginfo('name');  ?>. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--=== End Footer ===-->

<?php wp_footer(); ?>
<!-- Don't forget analytics -->	
</body>
</html>
