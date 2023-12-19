<?php 
	
get_header(); ?>
	<div class="container">
		<div class="row justify-content-between">

			<div class="">
			<?php 
			
			if( have_posts() ):
				
				while( have_posts() ): the_post(); ?>
					
					<h1>Contact Us</h1>
					
					<small>Posted on: <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?>, in <?php the_category(); ?></small>
					
					<p><?php the_content(); ?></p>
					
					<hr>

                    <form id="contact_form" class="d-flex flex-column mt-2">
                        <div class="form-group w-100">
                            <label for="name" class="sr-only w-25">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                        </div>

                        <div class="form-group w-100">
                            <label for="email" class="sr-only">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                        </div>
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>


				
				<?php endwhile;
				
			endif;
					
			?>
			</div>
			<div class="">
					<?php get_sidebar(); ?>
				</div>
		</div>
	</div>



<script>
    jQuery(document).ready(function($) {
        $('#contact_form').submit(function(event){
            event.preventDefault();
            var link = "<?php echo admin_url('admin-ajax.php'); ?>";
			var form=jQuery("#contact_form").serialize();
			console.log("data----------->",form);
            var formData = new FormData;
			formData.append('action', 'contact_us');
			formData.append('contact_us',form)

			console.log("Formdata------->",formData.get('contact_us'))
            $.ajax({
                url: link,
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
				success: function(response){
    if (response.success) {
        alert("Form submitted successfully!");
    } else {
        alert("Error submitting form.");
    }
},

            });
        });
    });
</script>

<?php get_footer(); ?>