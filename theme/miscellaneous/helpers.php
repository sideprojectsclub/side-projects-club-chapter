<?php

/*
 * Puzzle
 * Helper functions
 */

// Generates favicon code
//
// Returns a string of favicons separated by new lines
function favicons() {
    $favicons = array();
    
    $apple_sizes = array(57, 114, 72, 144, 60, 120, 76, 152);
    $standard_sizes = array(196, 96, 32, 16, 128);
    $ms_sizes = array(
        'TileImage'         => array(144, 144),
        'square70x70logo'   => array(70, 70),
        'square150x150logo' => array(150, 150),
        'wide310x150logo'   => array(310, 150),
        'square310x310logo' => array(310, 310)
    );
    
    foreach ($apple_sizes as $size) {
        $dimensions = $size . 'x' . $size;
        $favicons[] = '<link rel="apple-touch-icon-precomposed" sizes="' . $dimensions . '" href="' . get_template_directory_uri() . '/assets/images/favicons/apple-touch-icon-' . $dimensions . '.png" />';
    }
    
    foreach ($standard_sizes as $size) {
        $dimensions = $size . 'x' . $size;
        $favicons[] = '<link rel="icon" type="image/png" href="' . get_template_directory_uri() . '/assets/images/favicons/favicon-' . $dimensions . '.png" sizes="' . $dimensions . '" />';
    }
    
    $favicons[] = '<meta name="application-name" content="&nbsp;"/>';
    $favicons[] = '<meta name="msapplication-TileColor" content="#FFFFFF" />';
    
    foreach ($ms_sizes as $name => $size) {
        $dimensions = $size[0] . 'x' . $size[1];
        $favicons[] = '<meta name="msapplication-' . $name . '" content="' . get_template_directory_uri() . '/assets/images/favicons/mstile-' . $dimensions . '.png" />';
    }
    
    return join("\n    ", $favicons);
}

// Inserts an inline SVG with a padding trick on the container to fix the size
// in IE and Edge. SVGs do not scale properly in these browsers.
//
// $svg_location - string, location of the SVG file
//
// Echos the SVG wrapped in a container
function insert_svg($svg_location) {
    ob_start();
    
    // Get the SVG code
    require($svg_location);
    $svg = ob_get_clean();
    $svg = simplexml_load_string($svg);
    
    // Parse the viewBox value
    // e.g. "10 20 100 200"
    $viewBox = (string) $svg->attributes()->viewBox;
    
    // Convert the $viewBox string into an array of the dimensions
    preg_match_all('/\d+/', $viewBox, $dimensions);
    
    // Determine the width and height from the applicable dimensions
    // in the $dimensions array
    //
    // e.g. An svg with a viewBox of "10 20 110 200" would be
    // 100 wide (110 - 10) and 180 tall (200 - 20).
    $width = $dimensions[0][2] - $dimensions[0][0];
    $height = $dimensions[0][3] - $dimensions[0][1];
    
    // Calculate the aspect ratio; round up to the nearest 10,000th place
    // e.g. An SVG that is 100 x 180 has an aspect ratio of 0.556
    $aspect_ratio = ceil($height / $width * 10000) / 10000;
    
    // Echo the SVG wrapped in a container with a padding-bottom trick to fix
    // the size in IE and Edge.
    // e.g. A 100 x 180 SVG would be in a container with
    // "padding-bottom: 55.6%;"
    echo '<div class="vector-container" style="padding-bottom: ' . $aspect_ratio * 100 . '%;">';
    include($svg_location);
    echo '</div>';
}

// Determines classes for a section. Can be edited on a theme-by-theme basis.
//
// $page_section - array of data pertaining to the section
//
// Returns a string of classes for a section
function section_classes($page_section) {
    $puzzle_options_data = $page_section['options'];
    
    $section_classes  = $page_section['type'] . '-section';
    $section_classes .= (!empty($puzzle_options_data['background_color']) ? ' ' . $puzzle_options_data['background_color'] : '');
    $section_classes .= (!empty($puzzle_options_data['padding_top']) ? ' ' . $puzzle_options_data['padding_top'] . '-padding-top' : '');
    $section_classes .= (!empty($puzzle_options_data['padding_bottom']) ? ' ' . $puzzle_options_data['padding_bottom'] . '-padding-bottom' : '');
    
    if (!empty($puzzle_options_data['align_items']) && $puzzle_options_data['align_items'] == 'center') {
        $section_classes .= ' align-center';
    } else {
        $section_classes .= ' align-top';
    }
    
    return $section_classes;
}

// Determines the ID for a section. Can be edited on a theme-by-theme basis.
//
// $s - integer, the section number we are on
// $page_section - array of data pertaining to the section
//
// Returns a string of the ID for a section
function section_id($s, $page_section) {
    $puzzle_options_data = $page_section['options'];
    
    $section_id = 'section-' . ($s + 1);
    if (!empty($puzzle_options_data['id'])) {
        $section_id = to_slug($puzzle_options_data['id']);
    } else if (!empty($puzzle_options_data['headline'])) {
        $section_id = to_slug($puzzle_options_data['headline']);
    }
    
    return $section_id;
}
?>