<?php
$accordions = new PuzzleSection;
$accordions->set_group_name('Accordions')
    ->set_group_name_slug('accordions')
    ->set_single_name('Accordion')
    ->set_multiple(true)
    ->set_admin_column_classes('xs-span12')
    ->set_order(30)
    ->set_markup_attr(array(
        'headline'          => array(
            'name'          => 'Headline',
            'input_type'    => 'text',
            'save_as'       => 'h4'
        ),
        'content'           => array(
            'name'          => 'Content',
            'input_type'    => 'textarea',
            'rows'          => 5,
            'save_as'       => 'content'
        )
    ))
    ->set_options(array(
        'headline'          => array(
            'name'          => 'Headline',
            'width'         => 'xs-span12 sm-span6',
            'input_type'    => 'text',
            'save_as'       => 'h2'
        ),
        'id'                => array(
            'name'          => 'Section ID',
            'width'         => 'xs-span12 sm-span6',
            'tip'           => '<strong>Use this for linking directly to a section. Lowercase letters, numbers, dashes, and underscores only.</strong> If left blank, the Section ID will be the headline lowercase with words separated by dashes (symbols will be deleted). If both the Section ID and headline are blank, the Section ID will be "section-n" where "n" is the place that the section is in on the page (e.g. the 4th section on the page will be "section-4").',
            'input_type'    => 'text'
        ),
        'background_color'        => array(
            'name'          => 'Background Color',
            'width'         => 'xs-span12 sm-span4',
            'input_type'    => 'select',
            'options'       => array(
                'White'             => 'white-background',
                'Light blue'        => 'light-blue-background',
                'Blue'              => 'blue-background',
                'Orange'            => 'orange-background'
            )
        ),
        'padding_top'       => array(
            'name'          => 'Top Padding',
            'width'         => 'xs-span12 sm-span4',
            'input_type'    => 'select',
            'options'       => array(
                'Large'     => 'large',
                'Normal'    => 'normal',
                'None'      => 'no'
            ),
            'selected'      => 'normal'
        ),
        'padding_bottom'    => array(
            'name'          => 'Bottom Padding',
            'width'         => 'xs-span12 sm-span4',
            'input_type'    => 'select',
            'options'       => array(
                'Large'     => 'large',
                'Normal'    => 'normal',
                'None'      => 'no'
            ),
            'selected'      => 'normal'
        ),
        'main_content'      => array(
            'name'          => 'Main Content',
            'input_type'    => 'textarea',
            'rows'          => 10,
            'save_as'       => 'content'
        )
    ));

$puzzle_pieces = new PuzzlePieces;
$puzzle_pieces->add_section($accordions);
?>