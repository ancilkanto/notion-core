<?php



add_action('init', 'notion_text_block_init', 99 );
function notion_text_block_init(){


    global $kc;
    $kc->add_map(
        array(
            'notion_text_block' => array(
                'name' => 'Notion Text Block',
                'description' => __('', 'kingcomposer'),
                'icon' => 'sc-icon sc-icon-text-block',
                'category' => 'Notion',
                'preview_editable' => true,
                'is_container' => true,// this line works for the editor section. If it is not here. Content html editor will not work.
                'pop_height' => 600,
                'params' => array(
                    'General' => array( //if we did't give this option. The KC will generate an default General option
                      array(
                          'name' => 'content',
                          'label' => 'Content',
                          'type' => 'textarea_html',
                          'value' => base64_encode('Sample Text'),
                          'admin_label' => true,
                      ),
                      array(
                          'name' => 'semantic',
                          'label' => 'Element Semantic',
                          'type' => 'select',  // USAGE SELECT TYPE
                          'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                              'h1' => __('H1', 'notion'),
                              'h2' => __('H2', 'notion'),
                              'h3' => __('H3', 'notion'),
                              'h4' => __('H4', 'notion'),
                              'h5' => __('H5', 'notion'),
                              'h6' => __('H6', 'notion'),
                              'p' => __('Paragraph', 'notion'),
                              'div' => __('DIV', 'notion')
                          ),
                          'value' => 'p', // remove this if you do not need a default content 
                          'description' => 'Choose the HTML element semantic.',
                      ),
                      array(
                          'name' => 'font_color',
                          'label' => 'Color',
                          'type' => 'color_param',
                          'options' => notion_get_color_palette(),
                          'description' => 'Choose the text color',
                      ),
                      array(
                          'name' => 'text_align',
                          'label' => 'Text Align',
                          'type' => 'select',  // USAGE SELECT TYPE
                          'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                              'text-left' => __('Left', 'notion'),
                              'text-center' => __('Center', 'notion'),
                              'text-right' => __('Right', 'notion'),
                              'text-justify' => __('Justify', 'notion')
                          ),
                          'value' => 'left', // remove this if you do not need a default content 
                          'description' => 'Choose the text alignment.',
                      ),
                      array(
                          'name' => 'class',
                          'label' => 'Extra Class',
                          'type' => 'text',
                      )
                    ),
                    'typography' => array(
                        array(
                            'name' => 'font_family',
                            'label' => 'Font',
                            'type' => 'select',  // USAGE SELECT TYPE
                            'options' => notion_get_fonts_group(),
                            'value' => 'font1', // remove this if you do not need a default content 
                            'description' => 'Choose the font.',
                        ),
                        array(
                            "label" => __("Font Size", 'notion'),
                            "name" => "font_size",
                            "value" => __("14px", 'notion'),
                            'type' => 'select',  // USAGE RADIO TYPE
                            'options' => notion_get_font_size(),
                            "description" => __("Specify the font size.", 'notion')
                        ),
                        array(
                              "label" => __("Letter Spacing", 'notion'),
                              "name" => "letter_spacing",
                              'type' => 'select',  // USAGE RADIO TYPE
                              'options' => notion_get_letter_spacings(),
                              "description" => __("Specify the letter spacing.", 'notion')
                        ),
                        array(
                              "label" => __("Line Height", 'notion'),
                              "name" => "line_height",
                              'type' => 'select',  // USAGE RADIO TYPE
                              'options' => notion_get_line_heights(),
                              "description" => __("Specify the line height.", 'notion')
                        ),
                        array(
                              "label" => __("Font Weight", 'notion'),
                              "name" => "font_wt",
                              "value" => __("400", 'notion'),
                              'type' => 'number_slider',  // USAGE RADIO TYPE
                              'options' => array(    // REQUIRED
                                'min' => 100,
                                'max' => 900,
                                'unit' => '',
                                'step' => 100,
                                'show_input' => true
                              ),
                              "description" => __("Specify the font weight.", 'notion')
                        ),
                        array(
                            'name' => 'font_case',
                            'label' => 'Text Transform',
                            'type' => 'select',  // USAGE SELECT TYPE
                            'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                                '' => __('Normal', 'notion'),
                                'uppercase' => __('Uppercase', 'notion'),
                                'lowercase' => __('Lowercase', 'notion')
                            ),
                            'value' => '', // remove this if you do not need a default content 
                            'description' => 'Choose the text case.',
                        ),
                        
                    ),
                    'styling' => array(
                        array(
                            'name'      => 'css_custom',
                            'type'      => 'css',
                            'options'   => array(
                                array(
                                    'Box'    => array(
                                        array('property' => 'background', 'label' => 'Background'),
                                        array('property' => 'border', 'label' => 'Border'),
                                        array('property' => 'padding', 'label' => 'Padding'),
                                        array('property' => 'margin', 'label' => 'Margin'),
                                    )
                                )
                            )
                        )
                    ),
                    'animate' => array(
                        array(
                            'name'    => 'animate',
                            'type'    => 'animate'
                        )
                    ),
                )
            )
        )
    );
}
// Register Before After Shortcode
function render_notion_text_block($atts, $content = null){
    extract( shortcode_atts( array(
        'semantic' => 'p',
        'text_align' => 'text-left',
        'font_color' => '',
        'font_size' => '',
        'font_family' => '',
        'font_case' => '',
        'line_height' => '',
        'letter_spacing' => '',
        'font_wt' => '',
        'class' => '',
        'css_custom' => '',
        'animate' => ''


    ), $atts) );

    $master_class = apply_filters( 'kc-el-class', $atts );

    $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));

    

    $output= '<'.$semantic.' class="notion-text-block '.$text_align.' font-weight-'.$font_wt.' '.$letter_spacing.' '.$line_height.' '.$font_color.' '.$font_size.' '.$font_family.' '.$font_case.' '.$class.'"><span class="'.implode(' ', $master_class).'">'.$content.'</span></'.$semantic.'>';


    return $output;
}

add_shortcode('notion_text_block', 'render_notion_text_block');
