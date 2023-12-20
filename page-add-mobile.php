<?php
get_header( );
?>

<div class="container">
    <div class="row">

        <div class="col-xs-12 col-sm-8">
            <?php echo do_shortcode("[mobile_form]"); ?>
        </div>
            <div class="col-xs-12 col-sm-4">
                <?php get_sidebar(); ?>
            </div>
    </div>
</div>

<?php get_footer( ) ?>