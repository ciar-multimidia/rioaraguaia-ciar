<section class="container" id="conteudo-interno">
	<header>
		<?php if (is_single()): ?>
			<mark>Tema: <?php the_category(', '); ?></mark>
		<?php endif ?>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	</header>

	<article>
		<?php the_content(); ?>

		<?php $mtl = get_field('arquivo_mtl'); $obj = get_field('arquivo_obj'); $jpg = get_field('arquivo_jpg'); if ($mtl && $obj && $jpg) : 
			echo do_shortcode('[3D width="100%" height="600" material="'.$mtl.'" model="'.$obj.'" background="#FAF9EC" camera="4,4,4"]');
		endif; ?>
		
	</article>

	<footer></footer>

	<?php if (is_single()): ?>
		<div class="fb-comentarios"><div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="2"></div></div>
	<?php endif; ?>
</section>