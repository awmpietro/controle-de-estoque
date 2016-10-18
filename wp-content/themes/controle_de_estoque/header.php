<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <title><?php wp_title(); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
	</head>

  <body <?php body_class(isset($class) ? $class : ''); ?>>
  <nav class="navbar navbar-inverse navbar-static-top">
  	<div class="container">
  		<div class="navbar-header">
  			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
  				<span class="sr-only">Toggle navigation</span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  			</button>
  			<a class="navbar-brand" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
  		</div>
  		<div id="navbar" class="navbar-collapse collapse">
  		<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => '', 'items_wrap' => '<ul class="nav navbar-nav">%3$s</ul>'  ) ); ?>
  		</div>
  	</div>
  </nav>