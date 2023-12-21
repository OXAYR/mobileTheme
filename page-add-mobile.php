<?php


$show_dimensions = true;
$show_ram = true;
$show_rom = true;
$show_front_camera = true;
$show_back_camera = true;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $show_dimensions = isset($_POST['show_dimensions']);
    $show_ram = isset($_POST['show_ram']);
    $show_rom = isset($_POST['show_rom']);
    $show_front_camera = isset($_POST['show_front_camera']);
    $show_back_camera = isset($_POST['show_back_camera']);
}

get_header();
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8">
        <form method="post" id="featureForm" class="mt-3  d-flex flex-row">
    <div class="form-check mx-2">
        <input class="form-check-input" type="checkbox" name="show_dimensions" id="show_dimensions" <?php echo $show_dimensions ? 'checked' : ''; ?>>
        <label class="form-check-label" for="show_dimensions"> Dimensions</label>
    </div>

    <div class="form-check mx-2">
        <input class="form-check-input" type="checkbox" name="show_ram" id="show_ram" <?php echo $show_ram ? 'checked' : ''; ?>>
        <label class="form-check-label" for="show_ram"> RAM</label>
    </div>

    <div class="form-check mx-2">
        <input class="form-check-input" type="checkbox" name="show_rom" id="show_rom" <?php echo $show_rom ? 'checked' : ''; ?>>
        <label class="form-check-label" for="show_rom">ROM</label>
    </div>

    <div class="form-check mx-2">
        <input class="form-check-input" type="checkbox" name="show_front_camera" id="show_front_camera" <?php echo $show_front_camera ? 'checked' : ''; ?>>
        <label class="form-check-label" for="show_front_camera"> Front Camera</label>
    </div>

    <div class="form-check mx-2">
        <input class="form-check-input" type="checkbox" name="show_back_camera" id="show_back_camera" <?php echo $show_back_camera ? 'checked' : ''; ?>>
        <label class="form-check-label" for="show_back_camera"> Back Camera</label>
    </div>

    <button type="submit" class=" btn rounded-end-pill btn-light">+</button>
</form>

            <?php
            echo do_shortcode(
                "[mobile_form 
                    show_dimensions={$show_dimensions} 
                    show_ram={$show_ram} 
                    show_rom={$show_rom} 
                    show_front_camera={$show_front_camera} 
                    show_back_camera={$show_back_camera} 
                ]"
            );
            ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
