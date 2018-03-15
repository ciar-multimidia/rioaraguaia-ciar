<?php get_header(); ?>

	<div class="container duascolunas">
		<div>
			<h1 class="nome-item">Exposição virtual
				<?php if(isset($_GET['author_name'])) : $curauth = get_userdatabylogin($author_name); else : $curauth = get_userdata(intval($author)); endif;?>
				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				<?php /* If this is a category archive */ if (is_category()) { ?>
				 <span><?php echo single_cat_title(); ?></span>
				<?php /* If this is a tag archive */ } elseif (is_tag()) { ?>
				<span><?php echo single_tag_title(); ?></span>
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				 <span<?php the_time('j \d\e F \d\e Y'); ?></span>
				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				 <span<?php the_time('F \d\e Y'); ?></span>
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				 <span<?php the_time('Y'); ?></span>
				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				 <span>Publicações de <?php echo $curauth->display_name; ?></span>
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				 <span>Arquivos do site</span>
				<?php } ?>
			</h1>

			<p><?php echo category_description(); ?></p>
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