<?php get_header(); ?>

<!--container start-->
<div class="container blog_container">
    <div class="row">
        <!--blog start-->
        <div class="col-lg-9 ">
            <?php query_posts( array (  'posts_per_page' => -1, 'post_type' => 'blog', 'order' => 'ASC', 'paged' => get_query_var( 'paged' ) ) ); ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php  
                $post_date = strtotime($post->post_date);
                $day = date('d', $post_date);
                $month = date('M', $post_date);
                $year = date('Y', $post_date);
                $tags = wp_get_post_tags($post->ID);
            ?>        
            
            <div class="blog-item">
                <div class="row">                    
                    <div class="col-lg-12 blog_first_block">
                        <div class="blog-img">
                             <?php getImage('1'); ?>
                        </div>
                        <span class="comment_counts"><?php echo $post->comment_count; ?> Comments</span>
                    </div>
                </div>
                <div class="row blog_txt">
                    <div class="col-lg-2 col-sm-2 text-right">
                        <div class="date-wrap">
                            <span class="date"><?php echo $day; ?></span>
                            <span class="month_year">
                                <?php echo $month ." ". $year; ?>
                            </span>
                        </div>                  
                    </div>
                    <div class="col-lg-10 col-sm-10">
                        <h1 class="blog_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <ul class="blog_tags">
                            <?php if(!empty($tags)){
                                foreach ($tags as $key=>$val){?>
                                <li><a href="javascript:;"><?php echo $val->name; ?></a></li>
                            <?php } }?>
                        </ul>
                        <p><?php the_excerpt(); ?></p>   
                    </div>
                </div>
            </div>          

            <?php endwhile; else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>            
           
            <?php wp_reset_query();  ?>

        </div>

        <div class="col-lg-3 sidebar_blog">

            <?php get_sidebar('blog-widgets'); ?>


        </div>

        <!--blog end-->
    </div>

</div>
<!--container end-->

<?php get_footer(); ?>