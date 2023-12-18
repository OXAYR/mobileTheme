<?php
get_header( );
?>

<div class="col-xs-12 col-sm-8">

		<?php
         $currentPage = (get_query_var('paged')) ? get_query_var('paged') : 1 ; 
$args = array ('posts_per_page'=>2, 'paged' => $currentPage);
        query_posts( $args );
		
		if( have_posts() ):
			
			while( have_posts() ): the_post(); ?>
				
				<?php get_template_part('content',get_post_format()); ?>
			
			<?php endwhile;
			
		endif;
				
		?>
	
	</div>
    <div class="col-xs-12 col-sm-4">
		<?php get_sidebar(); ?>
	</div>

<?php get_footer( ) ?>