<?php
/**
 * The Blog Widgets Sidebar
 *
 * @package WordPress
 * @subpackage Social Heroz
 */
?>

<aside>
    <div class="row search_block">
        <div class="col-lg-12">
            <div class="search-row">
                <!--<input type="text" class="form-control" placeholder="Search here">-->
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
    <div class="row ">
        
    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('blog-widgets')) : ?>
        <?php  dynamic_sidebar('blog-widgets'); ?>        
    <?php else: ?>  
        
    <div class="col-sm-6 category"> 
        <h3>Categories</h3>
        <ul class="list-unstyled">
        <?php 
        $cat = get_terms('blog_category');
        foreach ($cat as $key => $val){
        ?>
            <li>
                <a href="<?php echo get_term_link( $val, 'blog_category' ); ?>">
                    <?php echo $val->name; ?> 
                </a>
            </li>                                
        <?php } ?>
        </ul>
    </div>
    <div class="col-sm-6 archive">    
        <h3>Archives</h3>
        <ul class="list-unstyled">
            <?php
            $blog_archive = get_cpt_archives( 'blog' );
            foreach ( $blog_archive as $k=>$v){
            ?>
                <li>
                    <a href="<?php echo $v['link']; ?>">                        
                        <?php echo $v['month']; ?> 
                        <?php echo $v['year']; ?> 
                    </a>
                </li>

            <?php } ?>
        </ul>
    </div>
        
    <?php endif; ?>
        
    </div>

</aside>