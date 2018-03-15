<?php get_header(); 

if (have_posts()) : while (have_posts()) : the_post(); 
	
	get_template_part('content');

endwhile; else : endif; 

get_footer(); ?>