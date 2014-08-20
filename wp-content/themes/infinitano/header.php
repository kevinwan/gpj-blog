<!doctype html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <title><?php wp_title(); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <!--[if lt IE 9]>
    <script
        src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<!-- end head section here -->

<body <?php body_class(); ?>>
<div class=" container">

    <!-- navigation for desktop start here -->
    <nav class="row hidden-sm hidden-xs">
        <!-- left side navigation -->
        <section class="col-md-5">
            <?php infinitano_left_menu(); ?>
        </section>
        <!-- logo section -->
        <section class="col-md-2 text-center logo">
            <?php infinitano_logo(); ?>
        </section>
        <!-- right navigation -->
        <section class="col-md-5">
            <?php infinitano_right_menu(); ?>
        </section>
    </nav>
    <!-- navigation for desktop ends here -->

    <!-- navigation for tablet start here -->
    <nav class="visible-sm">
        <!-- logo section -->
        <section class="text-center logo">
            <?php infinitano_logo(); ?>
        </section>
        <!-- left side navigation -->
        <section>
            <?php infinitano_tablet_menu(); ?>
        </section>
        <!-- right navigation -->
        <section class="col-md-5"></section>
    </nav>
    <!-- navigation for desktop ends here -->

    <!-- navigation for mobile devices -->
    <div class="navbar navbar-inverse visible-xs" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span> <span class="icon-bar"></span> <span
                    class="icon-bar"></span></button>
            <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>/">
                <strong><?php
                    echo get_bloginfo('name') ?></strong> </a></div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav phonenav">
                <?php infinitano_phone_menu(); ?>
            </ul>
        </div>
    </div>
    <!-- navigation for mobile ends here -->

    <!-- content wrapper start here -->
    <div class="wrapper">

        <!-- page header -->
        <header class="top-header">
            <section class="col-md-8">
                <h1 class="header-h2 hidden-sm hidden-xs">
                    <a href="<?php echo esc_url(home_url()); ?>"
                       class="text-danger"><i
                            class="fa fa-home"></i> <?php echo get_bloginfo('name') ?>
                    </a>
                    <small> - <?php echo get_bloginfo('description'); ?></small>
                </h1>
            </section>

            <section class="col-md-4">
                <div class="text-right cats-list">
                    <!-- visible on small screen -->
                    <div class="visible-sm visible-xs text-center">
                        <h1 class="header-h2"><a href="
                        <?php echo esc_url(home_url()); ?>"
                                                 class="text-danger"><i
                                    class="fa fa-home"></i> <?php echo get_bloginfo('name') ?>
                            </a></h1>

                        <div class="btn-group">
                            <button type="button"
                                    class="btn btn-danger btn-cats dropdown-toggle"
                                    data-toggle="dropdown"> Categories <span
                                    class="caret"></span></button>
                            <ul class="dropdown-menu text-left" role="menu">
                                <?php
                                $infinitano_cats_args = array(
                                    'orderby'            => 'name',
                                    'show_count'         => 0,
                                    'child_of'           => 0,
                                    'hierarchical'       => 0,
                                    'title_li'           => '',
                                    'depth'              => 0,
                                );
                                wp_list_categories($infinitano_cats_args); ?>
                            </ul>
                        </div>
                    </div>

                    <!-- visible on normal screen -->
                    <div class="hidden-xs hidden-sm">
                        <div class="btn-group">
                            <button type="button"
                                    class="btn btn-danger btn-cats dropdown-toggle"
                                    data-toggle="dropdown"> Categories <span
                                    class="caret"></span></button>
                            <ul class="dropdown-menu text-left" role="menu">
                                <?php wp_list_categories($infinitano_cats_args); ?>
                            </ul>
                        </div>
                        <a class="btn btn-warning"
                           href="<?php echo get_bloginfo('rss2_url'); ?>"><i
                                class="fa fa-rss"></i></a>
                    </div>

                </div>
                <!-- end col4 -->
            </section>

            <div class="clear"></div>
        </header>
        <!-- end page-header-->
