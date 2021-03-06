<?php

/*
 * Puzzle
 * Config
 */

$puzzle_pieces = new PuzzlePieces;

/* Add shortcode buttons to WYSIWYG editor */
$puzzle_pieces->set_shortcodes(false);

/* Add Icon Library to page builder */
$puzzle_pieces->set_icon_library(false);

/*
 * Set default icon in page builder
 * This will only take effect if the icon library is available.
 */
$puzzle_pieces->set_default_icon('fa fa-star');

/*
 * Add FontAwesome library to Icon Library
 * This will only take effect if ICON_LIBRARY is set to true.
 */
$puzzle_pieces->set_font_awesome_library(false);

/*
 * Add custom icon libraries before and after Font Awesome library
 * Icon library must be available.
 * The Font Awesome library does not have to be available for these to load.
 */
$puzzle_pieces->set_custom_icon_libraries_before(false);
$puzzle_pieces->set_custom_icon_libraries_after(false);

/*
 * Add a "no icon" choice to Icon Library
 * This will only take effect if the icon library is available.
 */
$puzzle_pieces->set_icon_library_choice_none(false);

/* Choose which post types the page builder is available for */
$puzzle_pieces->set_page_builder_post_types(array('page'));

/* Add Owl Carousel */
$puzzle_pieces->set_owl_carousel(true);

/* Require files */

foreach (glob(get_stylesheet_directory() . '/theme/models/*.php') as $filename) {
    include $filename;
}

require_once('customize_theme.php');
require_once(dirname(__FILE__) . '/../miscellaneous/helpers.php');

?>