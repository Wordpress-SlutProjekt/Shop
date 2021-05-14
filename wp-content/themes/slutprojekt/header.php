<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" type="image/x-icon" />
	<title><?php wp_title(' - ',TRUE,'right'); bloginfo('name'); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>


<header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                    <a href="./index.html"><img src="<?php echo get_template_directory_uri(); ?>/img/sneakers-logo.png"></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                        <?php wp_nav_menu([
                                    'container' => false,
                                    
                                    'theme_location' => 'header-menu'
                                ]) ?>
                          
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                    <?php dynamic_sidebar('search_bar') ?> 
                        <div class="header__right__auth">
                            <!-- <a href="#">Login</a>
                            <a href="#">Register</a> -->
                        </div>
                        <ul class="header__right__widget">
                            
                            
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>