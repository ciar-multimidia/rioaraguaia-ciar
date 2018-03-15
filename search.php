<?php get_header(); ?>

<div class="container duascolunas">
	<div>
		<h1>Resultados de busca</h1>
		
	</div>
</div>
<div class="container">
	<section class="lista-grid">
		<?php if (have_posts()) : while (have_posts()) : the_post(); 
	
			get_template_part('content-grid');

		endwhile; else : endif; global $wp_query; ?>
	</section>

	<?php if (  $wp_query->max_num_pages > 1 ) { echo '<div align="center"><button class="maisposts button">Ver mais</button></div>'; } ?>
</div>

<?php get_footer(); ?>