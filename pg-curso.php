<?php /* Template Name: Sobre o Curso */ ?>
<?php get_header(); ?>

<section class="container descpagina arealingua">
	<h1><?php the_title(); ?></h1>
	<h2>Patrimônio cultural em Goiás: olhares da arqueologia subaquática e colaborativa</h2>
	<?php if( have_rows('curso_descricao','option') ): while (have_rows('curso_descricao','option')) : the_row(); ?>
	<div class="conteudo">
		
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

	<!-- <div align="center"><a href="#" class="button">Acesso ao Moodle</a></div> -->
</section>


<?php if( have_rows('curso_modulo','option') ): ?>
<section class="moduloscurso">
	<?php while (have_rows('curso_modulo','option')) : the_row(); ?>
	<div>
		<div class="container">
			<div class="ilustracao">
				<div class="detalhe"></div>
				<?php if (get_sub_field('ilustracao') == 'Imagem'): ?>
					<div class="imagem" style="background-image: url('<?php echo get_sub_field('imagem'); ?>');"></div>
				<?php elseif (get_sub_field('ilustracao') == 'Vídeo'): ?>
					<div class="video"><?php echo video_youtube(get_sub_field('video')); ?></div>
				<?php endif; ?>				
				<div class="detalhe"></div>
			</div>
			<div class="conteudo arealingua">
				<?php if (get_sub_field('nome')): ?><h3 class="verde"><?php echo get_sub_field('nome'); ?></h3><?php endif; ?>
				<h5>
					Módulo <?php if (get_sub_field('tipo') == 'Presencial'): echo 'presencial'; elseif (get_sub_field('tipo') == 'Online'): echo 'online'; endif;  ?> 
					<?php if (get_sub_field('horas')): ?>- <?php echo get_sub_field('horas'); ?>h <?php endif; ?>
					<?php if (get_sub_field('vagas')): ?>| <?php echo get_sub_field('vagas'); ?> vagas <?php endif; ?>
					<?php if( have_rows('data') ): echo '| '; while (have_rows('data')) : the_row(); ?>
						De <?php echo get_sub_field('inicio'); ?> a <?php echo get_sub_field('termino'); ?>
					<?php endwhile; endif; ?>
				</h5>

				<?php if( have_rows('descricao') ): while (have_rows('descricao')) : the_row(); ?>
					<?php if (get_sub_field('karaja')): ?>
					<select class="linguas">
					  <option value="pt">Português</option>
					  <option value="kr">Karajá</option>
					</select>		
					<?php endif; ?>		

				<div class="txt">
				
					<?php if (get_sub_field('portugues')): ?>
						<div class="lingua-pt"><?php echo get_sub_field('portugues'); ?></div>
					<?php endif; ?>
					<?php if (get_sub_field('karaja')): ?>
						<div class="lingua-kr hidden"><?php echo get_sub_field('karaja'); ?></div>
					<?php endif; ?>
				
				</div>
				<?php endwhile; endif; ?>

				<div class="infos">
					<?php
					$professores = get_sub_field('professores');
					$tutores = get_sub_field('tutores');

					global $post; // required
					$argsprofs = array('post_type' => 'colaboradoresufg', 'post__in' => $professores);
					$argstutores = array('post_type' => 'colaboradoresufg', 'post__in' => $tutores);

					$id_profs = get_posts($argsprofs);
					$id_tutores = get_posts($argstutores);?>
					
					<p><span>Professor(es):</span> 
					<?php foreach($id_profs as $post) : setup_postdata($post); ?>
						<a href="<?php the_permalink(); ?>" target="blank"><?php the_title(); ?></a>
					<?php endforeach; ?></p>

					<p><span>Tutor:</span> 
					<?php foreach($id_tutores as $post) : setup_postdata($post); ?>
						<a href="<?php the_permalink(); ?>" target="blank"><?php the_title(); ?></a>
					<?php endforeach; ?></p>

					<?php if (get_sub_field('local')): ?><p><span>Local:</span> <?php echo get_sub_field('local'); ?></p><?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
</section>
<?php endif; ?>

<?php get_footer(); ?>