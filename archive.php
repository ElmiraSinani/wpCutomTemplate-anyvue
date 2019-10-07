<?php get_header(); ?>

<div class="container blog_container">
<div class="row">
    
    <div class="col-lg-9">
        <?php if (have_posts()) : ?>	       

        <?php while (have_posts()) : the_post(); ?>	
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
        <?php endwhile; ?>
        <?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
			
	<?php else : ?>
		<h2>Nothing found</h2>
	<?php endif; ?>
    </div>
    <div class="col-lg-3 sidebar_blog">
        <?php get_sidebar('blog-widgets'); ?>    
    </div>
</div>
</div>            


<?php get_footer(); ?>