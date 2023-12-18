<?php 
	
/*
	Template Name: Page No Title
*/
	
get_header(); ?>
	<div class="container">
		<div class="row justify-content-between">

			<div class="">
			<?php 
			
			if( have_posts() ):
				
				while( have_posts() ): the_post(); ?>
					
					<h1>Title</h1>
					
					<small>Posted on: <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?>, in <?php the_category(); ?></small>
					
					<p><?php the_content(); ?></p>
					
					<hr>
				
				<?php endwhile;
				
			endif;
					
			?>
			</div>
			<div class="">
					<?php get_sidebar(); ?>
				</div>
		</div>
	</div>

<?php get_footer(); ?>