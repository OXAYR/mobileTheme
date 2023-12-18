<div
 class="content"><h1><?php the_title();?></h1>
        <div class="thumbnail-image"><?php echo the_post_thumbnail('thumbnail'); ?></div>
        <small>Posted on <?php the_time('F j, Y'); ?> at <?php the_time('g:i a');?> in the <?php the_category();?></small>
        <p><?php the_content();?></p>
        <hr></hr>
        </div>