<?php get_header(); ?>

	<div class="container descpagina">
			<h1 class="nome-item">Exposição virtual
				<?php /* If this is a category archive */ if (is_category()) { ?>
				 <span><?php echo single_cat_title(); ?></span>
				<?php /* If this is a tag archive */ } elseif (is_tag()) { ?>
				<span><?php echo single_tag_title(); ?></span>
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				 <span><?php the_time('j \d\e F \d\e Y'); ?></span>
				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				 <span><?php the_time('F \d\e Y'); ?></span>
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				 <span><?php the_time('Y'); ?></span>
				<?php /* If this is an author archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				 <span>Arquivos do site</span>
				<?php } ?>
			</h1>

		<div class="conteudo">

			<?php if (is_category('territorio-e-lugares')) { ?>
				<?php if( have_rows('exposicao_territorios','option') ): while (have_rows('exposicao_territorios','option')) : the_row(); ?>
					<?php if (get_sub_field('portugues')): ?>
						<?php echo get_sub_field('portugues'); ?>
					<?php endif; ?>
				<?php endwhile; endif; ?>
			<?php } elseif (is_category('saberes-e-tradicoes')) { ?>
				<?php if( have_rows('exposicao_saberes','option') ): while (have_rows('exposicao_saberes','option')) : the_row(); ?>
					<?php if (get_sub_field('portugues')): ?>
						<?php echo get_sub_field('portugues'); ?>
					<?php endif; ?>
				<?php endwhile; endif; ?>
			<?php } elseif (is_category('artes-e-museus')) { ?>
				<?php if( have_rows('exposicao_artes','option') ): while (have_rows('exposicao_artes','option')) : the_row(); ?>
					<?php if (get_sub_field('portugues')): ?>
						<?php echo get_sub_field('portugues'); ?>
					<?php endif; ?>
				<?php endwhile; endif; ?>
			<?php } get_template_part('inc/seletor'); ?>
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