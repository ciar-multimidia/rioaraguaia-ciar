<?php /* Template Name: Ficha Técnica */ ?>
<?php get_header(); ?>

<section class="container fichatecnica">
	<h1 align="center"><?php the_title(); ?></h1>
	<p align="center">
		GOVERNO FEDERAL <br>
		REPÚBLICA FEDERATIVA DO BRASIL <br>
		Ministério da Educação <br>
		Coordenação de Aperfeiçoamento  de Pessoal de Nível Superior <br>
		Universidade Federal de Goiás		
	</p>

	<div class="conteudo">
		<h2>Apresentação</h2>
		<article>
			<?php the_content(); ?>
		</article>
	</div>

	<hr>

	<div class="conteudo">
		<article>
			<?php echo get_field('ficha_conteudo','option'); ?>
		</article>
	</div>

</section>


<?php get_footer(); ?>