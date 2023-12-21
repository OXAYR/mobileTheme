<?php

$show_name = true;
$show_dimensions = true;
$show_ram = true;
$show_rom = true;
$show_front_camera = true;
$show_back_camera = true;
$show_price = true;
$show_image = true;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $show_name = isset($_POST['show_name']);
    $show_dimensions = isset($_POST['show_dimensions']);
    $show_ram = isset($_POST['show_ram']);
    $show_rom = isset($_POST['show_rom']);
    $show_front_camera = isset($_POST['show_front_camera']);
    $show_back_camera = isset($_POST['show_back_camera']);
    $show_price = isset($_POST['show_price']);
    $show_image = isset($_POST['show_image']);
}

get_header();
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <form method="post" id="featureForm">
                <label><input type="checkbox" name="show_dimensions" <?php echo $show_dimensions ? 'checked' : ''; ?>> Show Dimensions</label><br>
                <label><input type="checkbox" name="show_ram" <?php echo $show_ram ? 'checked' : ''; ?>> Show RAM</label><br>
                <label><input type="checkbox" name="show_rom" <?php echo $show_rom ? 'checked' : ''; ?>> Show ROM</label><br>
                <label><input type="checkbox" name="show_front_camera" <?php echo $show_front_camera ? 'checked' : ''; ?>> Show Front Camera</label><br>
                <label><input type="checkbox" name="show_back_camera" <?php echo $show_back_camera ? 'checked' : ''; ?>> Show Back Camera</label><br>
                <input type="submit" value="Submit">
            </form>
            <?php
            echo do_shortcode(
                "[mobile_form 
                    show_name={$show_name} 
                    show_dimensions={$show_dimensions} 
                    show_ram={$show_ram} 
                    show_rom={$show_rom} 
                    show_front_camera={$show_front_camera} 
                    show_back_camera={$show_back_camera} 
                    show_price={$show_price} 
                    show_image={$show_image}
                ]"
            );
            ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>