<?php /* Template Name: Página Inicial */ ?>
<?php get_header(); ?>

<section class="sobre projeto container">
	<div class="descricao arealingua">
		<?php if (get_field('home_projeto_titulo','option')): ?><h2 class="verde"><?php echo get_field('home_projeto_titulo','option'); ?></h2><?php endif; ?>

		<?php if( have_rows('home_projeto_descricao','option') ): while (have_rows('home_projeto_descricao','option')) : the_row(); ?>
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

	</div>
	<div class="fundo">
		<?php if (get_field('home_projeto_video','option')): ?><div class="video"><?php echo video_youtube(get_field('home_projeto_video','option'), 'video-projeto'); ?></div><?php endif; ?>
		<?php if (get_field('home_projeto_imagem','option')): ?>
			<div class="imagem bt-youtube-video" style="background-image: url('<?php echo get_field('home_projeto_imagem','option'); ?>');<?php if (! get_field('home_projeto_video','option')): ?> cursor: auto;<?php endif; ?>">
				<?php if (get_field('home_projeto_video','option')): ?>
					<span><i class="fa fa-youtube-play" aria-hidden="true"></i></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>



<section class="sobre curso container">
	<div class="fundo">
		<?php if (get_field('home_curso_video','option')): ?><div class="video"><?php echo video_youtube(get_field('home_curso_video','option'), 'video-curso'); ?></div><?php endif; ?>
		<?php if (get_field('home_curso_imagem','option')): ?>
			<div class="imagem bt-youtube-video" style="background-image: url('<?php echo get_field('home_curso_imagem','option'); ?>');<?php if (! get_field('home_curso_video','option')): ?> cursor: auto;<?php endif; ?>">
				<?php if (get_field('home_curso_video','option')): ?>
					<span><i class="fa fa-youtube-play" aria-hidden="true"></i></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="descricao arealingua">
		<?php if (get_field('home_curso_titulo','option')): ?><h2 class="verde"><?php echo get_field('home_curso_titulo','option'); ?></h2><?php endif; ?>

		<?php if( have_rows('home_curso_descricao','option') ): while (have_rows('home_curso_descricao','option')) : the_row(); ?>
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
	</div>
</section>



<section class="divisoria">
	<div class="container descpagina arealingua">
		<h2>Exposição virtual</h2>

		<?php if( have_rows('apresenta_exposicao','option') ): while (have_rows('apresenta_exposicao','option')) : the_row(); ?>
		<div class="conteudo" style="margin-bottom: 0">
		
			<?php if (get_sub_field('portugues')): ?>
				<div class="lingua-pt"><?php echo get_sub_field('portugues'); ?></div>
			<?php endif; ?>
			<?php if (get_sub_field('karaja')): ?>
				<div class="lingua-kr hidden"><?php echo get_sub_field('karaja'); ?></div>
			<?php endif; ?>
		
		</div>
			<?php if (get_sub_field('karaja')): ?>
			<select class="linguas">
			  <option value="pt">Português</option>
			  <option value="kr">Karajá</option>
			</select>
			<?php endif; ?>
		<?php endwhile; endif; ?>
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