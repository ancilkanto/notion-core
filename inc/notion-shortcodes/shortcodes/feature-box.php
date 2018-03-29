<?php

add_action('init', 'notion_feature_box_init', 99 );
function notion_feature_box_init(){
    
    global $kc;
    $kc->add_map(
        array(
            'notion_feature_box' => array(
                'name' => 'Notion Feature Box',
                'description' => __('A block with icon, title and description.', 'kingcomposer'),
                'icon' => 'sc-icon sc-icon-feature-box',
                'category' => 'Notion',
                'params' => array(
                    array(
                        'name' => 'color',
                        'label' => 'Color',
                        'type' => 'color_param',
                        'options' => notion_get_color_palette(),
                        'description' => 'Choose the line color',
                    ),
                    array(
                          "label" => __("Width", 'notion'),
                          "name" => "width",
                          "value" => __("50px", 'notion'),
                          'type' => 'number_slider',  // USAGE RADIO TYPE
                          'admin_label' => true,
                          'options' => array(    // REQUIRED
                            'min' => 10,
                            'max' => 400,
                            'unit' => 'px',
                            'step' => 1,
                            'show_input' => true
                          ),
                          "description" => __("Specify the width of the line.", 'notion')
                    ),
                    array(
                          "label" => __("Height", 'notion'),
                          "name" => "height",
                          "value" => __("1px", 'notion'),
                          'type' => 'number_slider',  // USAGE RADIO TYPE
                          'admin_label' => true,
                          'options' => array(    // REQUIRED
                            'min' => 1,
                            'max' => 15,
                            'unit' => 'px',
                            'step' => 1,
                            'show_input' => true
                          ),
                          "description" => __("Specify the height of the line.", 'notion')
                    ),
                    array(
                        'name' => 'line_properties',
                        'type' => 'css',
                        'options' => array(
                          array(
                            'screens' => 'any',
                            'Line Properties' => array(
                              array(
                                'property' => 'text-align',
                                'label' => 'Align',
                              ),
                            ),
                            
                          ),
                        ),
                    ),
                    array(
                        'name' => 'class',
                        'label' => 'Extra Class',
                        'type' => 'text',
                    )
                    
                )
            )
        )
    );
} 
// Register Before After Shortcode
function render_notion_feature_box($atts, $content = null){
    extract( shortcode_atts( array(
        'color' => '',
        'width' => '',
        'height' => '',
        'class' => '',
        
        
    ), $atts) );

    
    $master_class = apply_filters( 'kc-el-class', $atts );

    

    

    $output = '<div class="notion-feature_box '.implode(' ', $master_class).'">
                  <span class="notion-line '.esc_attr($color).'-bg" style="width:'.esc_attr($width).'; height:'.esc_attr($height).';"></span>
                </div>';	  
    
    return $output;
}

add_shortcode('notion_feature_box', 'render_notion_feature_box'); 
