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
                'admin_view'  => 'text',
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
                                'unit' => ' ',
                                'step' => 100,
                                'show_input' => true
                              ),
                              "description" => __("Specify the font weight.", 'notion')
                        ),
                        array(
                            'name' => 'text_properties',
                            'type' => 'css',
                            'options' => array(
                              array(
                                'screens' => 'any',
                                'Text Properties' => array(
                                  array(
                                    'property' => 'text-align',
                                    'label' => 'Text Align',
                                    'selector' => '.text-block-element'
                                  ),
                                  array(
                                    'property' => 'text-transform',
                                    'label' => 'Text Transform',
                                    'selector' => '.text-block-element'
                                  ),
                                  array(
                                    'property' => 'font-style',
                                    'label' => 'Text Style',
                                    'selector' => '.text-block-element'
                                  ),
                                  array(
                                    'property' => 'text-decoration',
                                    'label' => 'Text Decoration',
                                    'selector' => '.text-block-inner'
                                  )
                                ),
                                
                              ),
                            ),
                        ),
                        
                        
                    ),
                    'styling' => array(
                        array(
                            'name' => 'enable_bg',
                            'label' => 'Enable Background',
                            'type' => 'toggle',
                        ),
                    
                        array(
                          'name' => 'bg_color',
                          'label' => 'Background Color',
                          'type' => 'color_param',
                          'options' => notion_get_color_palette(),
                          'description' => 'Choose the background color',
                          'relation' => array(
                              'parent'    => 'enable_bg',
                              'show_when' => 'yes'
                          )
                        ),
                        array(
                            'name'      => 'css_custom',
                            'type'      => 'css',
                            'options'   => array(
                                array(
                                    'screens' => 'any, 1024, 999, 767, 479',
                                    //Background group
                                    // 'Background' => array(
                                    //   array('property' => 'background', 'label' => 'Background', 'selector' => '.text-block-inner'),
                                    // ),
                                    'Box'    => array(
                                        array('property' => 'border', 'label' => 'Border', 'selector' => '.text-block-inner'),
                                        array('property' => 'padding', 'label' => 'Padding', 'selector' => '.text-block-inner'),
                                        array('property' => 'margin', 'label' => 'Margin', 'selector' => '.text-block-inner'),
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
        'font_color' => '',
        'font_size' => '',
        'font_family' => '',
        'line_height' => '',
        'letter_spacing' => '',
        'font_wt' => '',
        'animate' => '',
        'bg_color' => '',
        'enable_bg' => 'no',

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

    $bg_class = '';
    if($enable_bg == 'yes')
      $bg_class = $bg_color.'-bg';

    $output= '<div class="notion-text-block '.implode(' ', $master_class).'"><'.$semantic.' class="text-block-element font-weight-'.$font_wt.' '.$letter_spacing.' '.$line_height.' '.$font_color.' '.$font_size.' '.$font_family.'"><span class="text-block-inner '.esc_attr($bg_class).'">'.$content.'</span></'.$semantic.'></div>';


    return $output;
}

add_shortcode('notion_text_block', 'render_notion_text_block');
