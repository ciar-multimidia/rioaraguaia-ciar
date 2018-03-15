<?php /* Template Name: Página Inicial */ ?>
<?php get_header(); ?>

<section class="sobre projeto container">
	<div class="descricao">
		<?php if (get_field('home_projeto_titulo','option')): ?><h2 class="verde"><?php echo get_field('home_projeto_titulo','option'); ?></h2><?php endif; ?>

		<?php if( have_rows('home_projeto_descricao','option') ): while (have_rows('home_projeto_descricao','option')) : the_row(); ?>
			<?php if (get_sub_field('portugues')): ?>
				<?php echo get_sub_field('portugues'); ?>
			<?php endif; ?>
		<?php endwhile; endif; ?>
	</div>
	<div class="fundo">
		<?php if (get_field('home_projeto_fundo','option') == 'Imagem'): ?>
			<div class="imagem" style="background-image: url('<?php echo get_field('home_projeto_imagem','option'); ?>');"></div>
		<?php elseif (get_field('home_projeto_fundo','option') == 'Vídeo'): ?>
			<div class="video"><?php echo video_youtube(get_field('home_projeto_video','option')); ?></div>
		<?php endif; ?>
	</div>
</section>



<section class="sobre curso container">
	<div class="fundo">
		<?php if (get_field('home_curso_fundo','option') == 'Imagem'): ?>
			<div class="imagem" style="background-image: url('<?php echo get_field('home_curso_imagem','option'); ?>');"></div>
		<?php elseif (get_field('home_curso_fundo','option') == 'Vídeo'): ?>
			<div class="video"><?php echo video_youtube(get_field('home_curso_video','option')); ?></div>
		<?php endif; ?>
	</div>
	<div class="descricao">
		<?php if (get_field('home_curso_titulo','option')): ?><h2 class="verde"><?php echo get_field('home_curso_titulo','option'); ?></h2><?php endif; ?>

		<?php if( have_rows('home_curso_descricao','option') ): while (have_rows('home_curso_descricao','option')) : the_row(); ?>
			<?php if (get_sub_field('portugues')): ?>
				<?php echo get_sub_field('portugues'); ?>
			<?php endif; ?>
		<?php endwhile; endif; ?>
	</div>
</section>



<section class="divisoria">
	<div class="container duascolunas">
		<div>
			<h2 class="verde">Exposição virtual</h2>
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
</section>


<div class="container">
	<section class="lista-grid">
			<?php 
				$args = array('post_type' => 'post', 'posts_per_page' => 3, 'orderby' => 'rand');	
				$my_query = new WP_Query( $args ); 
					while ( $my_query->have_posts() ) : $my_query->the_post();
						get_template_part( 'content', 'grid');
					endwhile; 
				wp_reset_query(); 
			?>
	</section>
	<div align="center"><a href="<?php echo get_bloginfo('url'); ?>/exposicao-virtual/" class="button maior">Ver exposição virtual</a></div>
</div>

<?php get_footer(); ?>