<section class="container" id="conteudo-interno">
	<header>
		<?php if (is_singular('post')): ?>
			<mark>Eixo <?php the_category(' e '); ?></mark>
		<?php endif; ?>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	</header>

	<article>
		<?php if (is_singular('colaboradoresufg')): ?>
			<?php if (has_post_thumbnail()): ?>
				<div class="foto-colab">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php the_content(''); ?>

		<?php if (is_singular('post')): ?>
			<?php $mtl = get_field('arquivo_mtl'); $obj = get_field('arquivo_obj'); $jpg = get_field('arquivo_jpg'); if ($mtl && $obj && $jpg) : 
				echo do_shortcode('[3D width="100%" height="600" material="'.$mtl.'" model="'.$obj.'" background="#FAF9EC" camera="4,4,4"]');
			endif; ?>
		<?php endif; ?>
		
	</article>

	<footer class="clear"></footer>

	<?php if (is_singular('post')): ?>
		<div class="fb-comentarios"><div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="2"></div></div>
	<?php endif; ?>
</section>