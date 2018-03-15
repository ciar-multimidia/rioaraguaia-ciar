<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
<head>
<title><?php titulo_pagina(); ?></title>
<?php get_template_part('inc/metatags'); ?>
</head>
<body <?php body_class(); ?>>

<main>

	<header id="cabecalho"<?php if (! is_front_page()): ?> class="interno"<?php endif; ?>>
		<div class="container">
			<a href="<?php echo get_bloginfo('url') ?>" class="marca"><img src="<?php echo get_template_directory_uri() ?>/img/marca.svg"></a>

			<nav>
				<ul>
					<?php wp_nav_menu ( array( 
				        'theme_location' => 'menu-topo', 
				        'menu' => 'menu-topo', 
				        'container' => '', 
				        'container_class' => '', 
				        'container_id' => '', 
				        'menu_class' => '', 
				        'menu_id' => '', 
				        'echo' => true, 
				        'fallback_cb' => 'wp_page_menu', 
				        'before' => '', 
				        'after' => '', 
				        'items_wrap' => '%3$s', 
				        'depth' => 0, 
				        'walker' => ''
				    )); ?>
					<li><a href="#rodape-site">Contato</a></li>
				</ul>
			</nav>
		</div>
	</header>