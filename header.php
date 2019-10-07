<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php if (is_search()) { ?>
            <meta name="robots" content="noindex, nofollow" /> 
        <?php } ?>

        <title>
            <?php
            if (function_exists('is_tag') && is_tag()) {
                single_tag_title("Tag Archive for &quot;"); echo '&quot; - ';
            } elseif (is_archive()) {
                wp_title(''); echo ' Archive - ';
            } elseif (is_search()) {
                echo 'Search for &quot;' . wp_specialchars($s) . '&quot; - ';
            } elseif (!(is_404()) && (is_single()) || (is_page())) {
                wp_title('');  echo ' - ';
            } elseif (is_404()) {
                echo 'Not Found - ';
            }
            if (is_home()) {
                bloginfo('name'); echo ' - '; bloginfo('description');
            } else {
                bloginfo('name');
            }
            if ($paged > 1) {
                echo ' - page ' . $paged;
            }
            ?>
        </title>
        
            
       <link rel="shortcut icon" href="/favicon.ico">
        
       <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
       <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">


<?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( is_home() ) : ?>
<!-- Start Launch -->
<section id="launch" class="fullscreen" >
    <video id="video-lunch" class="video-bg" autoplay="autoplay" preload="auto" muted="" loop="" data-stellar-background-ratio="0.3">
        <source src="<?php bloginfo("template_directory"); ?>/images/shutterstock_v1402003.mp4" type="video/mp4">
    </video>
    <div class="bg-lanch"></div>
    <div class="inner">
        <div class="home-table">
            <div class="home-cell">
                
                <div class="container text-center">
                     
                    <div id="slider-home" class="liquid-slider">
                   
                        <?php
                            query_posts( array ( 'post_type' => 'welcome', 'welcome-cat' => 'launch', 'order' => 'ASC' ) );
                            if ( have_posts() ) : while ( have_posts() ) : the_post();          
                            $subtitle =  get_post_meta( get_the_ID(), 'sub_title', true ); 
                        ?>
                        <div>
                            <h2><?php echo $subtitle; ?></h2>
                            <h1 class="large-title"><span class="highlight"><?php the_title(); ?></span></h1>
                            <p><?php the_excerpt(); ?></p>
                            <a href="#contact-us" class="btn btn-default btn-lg inverted move-link">Learn More</a>
                        </div>                        
                        <?php endwhile; else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-links">
            <a href="#welcome" class="move-link down">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
    </div>
</section>
<!--=== End Launch ===-->
<?php endif; ?>

<!-- Start Header -->
<div id="header">
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
            <!-- Logo and navbar toggle are grouped for optimal mobile device display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a href="<?php echo get_home_url(); ?>" class="navbar-brand move-link" rel="home">
                    <img class="img-responsive" src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="logo">
                </a>
            </div>
			<!-- Nav menus here -->
            <div class="collapse navbar-collapse" id="main-nav">
                <?php
                    if (has_nav_menu('primary-nav')) {
                        wp_nav_menu(array(
                            'menu' => 'primary-nav',
                            'theme_location' => 'primary-nav',
                            //'depth' => 3,
                            'container' => false,
                            'menu_class' => 'nav navbar-nav navbar-right',
                            'fallback_cb' => 'wp_page_menu',
                            'walker' => new lis_top_menu( is_front_page() ? 'local-menu' : '' )
                            )
                        );
                    }
                ?>
            </div>
        </div>
    </nav>
</div>
<!--=== End Header ===-->       