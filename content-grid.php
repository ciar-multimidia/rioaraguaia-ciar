<div class="item-grid">
	<?php if (! is_archive()): ?><mark>Tema: <?php the_category(', '); ?></mark><?php endif; ?>
	<div class="thumb" <?php if(has_post_thumbnail($post->ID)): ?>style="background-image: url('<?php thumb_url('medium'); ?>');"<?php endif; ?>>
		<img src="<?php thumb_url('medium'); ?>" class="hidden">
	</div>
	<h5><?php the_title(); ?></h5>
	<a href="<?php the_permalink(); ?>" class="link"></a>
</div>