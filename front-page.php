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
		<div class="video"><?php echo video_youtube(get_field('home_projeto_video','option')); ?></div>
		<div class="imagem" style="background-image: url('<?php echo get_field('home_projeto_imagem','option'); ?>');">
			<span><i class="fa fa-youtube-play" aria-hidden="true"></i></span>
		</div>
	</div>
</section>



<section class="sobre curso container">
	<div class="fundo">
		<div class="video"><?php echo video_youtube(get_field('home_curso_video','option')); ?></div>
		<div class="imagem" style="background-image: url('<?php echo get_field('home_curso_imagem','option'); ?>');">
			<span><i class="fa fa-youtube-play" aria-hidden="true"></i></span>
		</div>
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
	<div class="container descpagina">
		<h2>Exposição virtual</h2>

		<div class="conteudo" style="margin-bottom: 0">
		<?php if( have_rows('apresenta_exposicao','option') ): while (have_rows('apresenta_exposicao','option')) : the_row(); ?>
			<?php if (get_sub_field('portugues')): ?>
				<?php echo get_sub_field('portugues'); ?>
			<?php endif; ?>
		<?php endwhile; endif; ?>
		</div>
	</div>
</section>



<?php 
echo '<section class="container">'; 
	echo '<div class="acessoeixos">';   
		echo '<a style="background-image: url(/wp-content/uploads/2018/04/galeria-territorios-lugares002-375x250.jpg);" href="/exposicao-virtual/territorio-e-lugares/"><span>Eixo Território e Lugares</span></a>';
		echo '<a style="background-image: url(/wp-content/uploads/2018/04/galeria-territorios-lugares017-375x250.jpg);" href="/exposicao-virtual/saberes-e-tradicoes/"><span>Eixo Saberes e Tradições</span></a>';
		echo '<a style="background-image: url(/wp-content/uploads/2018/04/galeria-artes-museus-006-375x250.jpg);" href="/exposicao-virtual/artes-e-museus/"><span>Eixo Artes e Museus</span></a>';
    echo '</div>';
echo '</section>';

get_footer(); ?>