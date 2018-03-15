<?php get_header(); ?>
	<div class="container duascolunas">
		<div>
			<h1>Exposição virtual</h1>

		<?php if( have_rows('apresenta_exposicao','option') ): while (have_rows('apresenta_exposicao','option')) : the_row(); ?>
			<?php if (get_sub_field('portugues')): ?>
				<?php echo get_sub_field('portugues'); ?>
			<?php endif; ?>
		<?php endwhile; endif; ?>
		</div>
		<div>
			<?php get_template_part('inc/seletor') ?>
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