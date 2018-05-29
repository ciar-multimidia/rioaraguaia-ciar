<?php get_header(); ?>
	<div class="container descpagina">
		<h1>Exposição virtual</h1>

		<div class="conteudo arealingua">
		<?php if( have_rows('apresenta_exposicao','option') ): while (have_rows('apresenta_exposicao','option')) : the_row(); ?>
			<?php if (get_sub_field('portugues')): ?>
				<div class="lingua-pt"><?php echo get_sub_field('portugues'); ?></div>
			<?php endif; ?>
			<?php if (get_sub_field('karaja')): ?>
				<div class="lingua-kr hidden"><?php echo get_sub_field('karaja'); ?></div>

					<select class="linguas">
					  <option value="pt">Português</option>
					  <option value="kr">Karajá</option>
					</select>		
			<?php endif; ?>
		<?php endwhile; endif; ?>
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