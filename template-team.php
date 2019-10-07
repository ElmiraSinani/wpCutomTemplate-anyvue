<?php 
/*
Template Name: Team Page
*/

if ( !is_front_page() ) {
    get_header();
}

?>
<!-- Start Team -->
<section id="team">
    <div class="container text-center">
        
        <?php
            query_posts( array ( 'post_type' => 'team', 'team-cat' => 'team_title', 'posts_per_page'=>1 ) );
            if ( have_posts() ) : while ( have_posts() ) : the_post();                          
        ?>
        <h2><?php the_title(); ?></h2>            
        <p><?php the_content(); ?></p>
        <?php endwhile; else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
        
        <div class="row team-members">
             <?php
                query_posts( array ( 'post_type' => 'team', 'team-cat' => 'team_members' ) );
                if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                $subtitle =  get_post_meta( get_the_ID(), 'sub_title', true ); 
                
                $fb   =  get_post_meta( get_the_ID(), 'member_fb', true );
                $tw   =  get_post_meta( get_the_ID(), 'member_tw', true );
                $mail =  get_post_meta( get_the_ID(), 'member_email', true );
                
            ?>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="team-member wow flipInX">
                    <div class="img">
                         <?php 
                         if ( has_post_thumbnail()) : 
                            the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                        endif; 
                        ?>
                    </div>
                    <div class="name"><?php the_title(); ?></div>
                    <div class="state"><?php echo $subtitle; ?></div>
                    <div class="text">
                        <?php the_content(); ?>
                    </div>
                    <div class="links">
                        <a href="<?php echo $fb; ?>" target="_blank" class="highlight" >Facebook</a>
                        <a href="<?php echo $tw; ?>" target="_blank"  class="highlight">Twitter</a>
                        <a href="mailto:<?php echo $mail; ?>" target="_top" class="highlight">Email</a>
                    </div>
                </div>
            </div>
            <?php endwhile; else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>
            <?php wp_reset_query(); ?>          
        </div>
    </div>
</section>
<!--=== End Team ===-->

<?php 
    if ( !is_front_page() ) {
        get_footer();
    }
?>