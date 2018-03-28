<?php

add_action('init', 'notion_button_init', 99 );
function notion_button_init(){
    
    global $kc;
    $kc->add_map(
        array(
            'notion_button' => array(
                'name' => 'Notion Button',
                'description' => __('A line seperator', 'kingcomposer'),
                'icon' => 'sc-icon sc-icon-button',
                'category' => 'Notion',
                'params' => array(
                    'General' => array(
                      array(
                          'name' => 'button_text',
                          'label' => 'Button Text',
                          'type' => 'text',
                          'admin_label' => true,
                          'value' => __('Click Here', 'vc_extend'),
                      ),
                      array(
                        'name' => 'button_link',
                        'label' => 'Link or URL',
                        'type' => 'link',
                        'value' => 'link|target',
                        'description' => '',
                        'admin_label' => true,
                      ),
                      array(
                          'name' => 'btn_scroll',
                          'label' => 'scroll link to a section?',
                          'type' => 'toggle',
                      ),
                      array(
                          'name' => 'size',
                          'label' => 'Button Size',
                          'type' => 'select',  // USAGE SELECT TYPE
                          'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                              'small-button' => __('Small', 'notion'),
                              'normal-size-button' => __('Normal', 'notion'),
                              'big-button' => __('Big', 'notion'),
                              'huge-button' => __('Huge', 'notion')
                          ),
                          'value' => 'normal-size-button', 
                          'description' => 'Choose the size of the button.',
                      ),
                      array(
                          'name' => 'shape',
                          'label' => 'Button Shape',
                          'type' => 'select',  // USAGE SELECT TYPE
                          'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                              'rouded-edge' => __('Rouded Edge', 'notion'),
                              'square-edge' => __('Square Edge', 'notion'),
                              'side-curved' => __('Side Curved', 'notion'),
                              'circle' => __('Circle', 'notion')
                          ),
                          'value' => 'square-edge', 
                          'description' => 'Choose the shape of the button.',
                      ),
                      array(
                          'name' => 'btn_full_width',
                          'label' => 'Make Full Width',
                          'type' => 'toggle',
                      ),
                      array(
                          'name' => 'enable_lightbox',
                          'label' => 'Enable Lightbox',
                          'type' => 'toggle',
                      ),
                      array(
                        'name' => 'light_box_type',
                        'label' => 'Lightbox Media Type',
                        'type' => 'radio',  
                        'options' => array(    
                          'lt-bx-image' => 'Image',
                          'lt-bx-video' => 'Video',
                        ),
                        'value' => 'lt-bx-image', // remove this if you do not need a default content 
                        'description' => 'Choose Lightbox Media',
                        'relation' => array(
                            'parent'    => 'enable_lightbox',
                            'show_when' => 'yes'
                        )
                      ),
                      array(
                        'name' => 'light_box_image_gallery',
                        'label' => 'Lightbox Images',
                        'type' => 'attach_images',  // USAGE ATTACH_IMAGE TYPE
                        'description' => 'Upload/attach images from media.',
                        'relation' => array(
                            'parent'    => 'light_box_type',
                            'show_when' => 'lt-bx-image'
                        )
                      ),
                      array(
                          'name' => 'light_box_video_url',
                          'label' => 'Youtube or Vimeo Video URL',
                          'type' => 'text',
                          'description' => 'For videos use the simple url of the video, such as: http://www.vimeo.com/your_video_id, or https://www.youtube.com/watch?v=your_video_id',
                          'relation' => array(
                              'parent'    => 'light_box_type',
                              'show_when' => 'lt-bx-video'
                          )
                      ),
                      array(
                          'name' => 'enable_icon',
                          'label' => 'Show Icon',
                          'type' => 'toggle',
                      ),
                      array(
                          'name' => 'icon',
                          'label' => 'Button Icon',
                          'type' => 'icon_picker',  // USAGE ICON_PICKER TYPE
                          'description' => 'choose the icon',
                          'admin_label' => true,
                          'relation' => array(
                              'parent'    => 'enable_icon',
                              'show_when' => 'yes'
                          )
                      ),
                      array(
                          'name' => 'icon_align',
                          'label' => 'Icon Alignment',
                          'type' => 'select',  // USAGE SELECT TYPE
                          'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                              'icon-on-left' => __('Left of the Text', 'notion'),
                              'icon-on-right' => __('Right of the Text', 'notion')
                          ),
                          'value' => 'icon-on-left', 
                          'description' => 'Choose the size of the Icon.',
                          'relation' => array(
                              'parent'    => 'enable_icon',
                              'show_when' => 'yes'
                          )

                      ),
                      array(
                          "label" => __("Icon Font Size", 'notion'),
                          "name" => "icon_font_size",
                          'type' => 'select',  
                          'options' => notion_get_font_size(),
                          "description" => __("Specify the font size of the icon.", 'notion'),
                          'relation' => array(
                              'parent'    => 'enable_icon',
                              'show_when' => 'yes'
                          )
                      ),
                      array(
                            "label" => __("Left Spacing", 'notion'),
                            "name" => "spacing",
                            "value" => __("0px", 'notion'),
                            'type' => 'number_slider',  // USAGE RADIO TYPE
                            'options' => array(    // REQUIRED
                              'min' => 0,
                              'max' => 120,
                              'unit' => 'px',
                              'step' => 1,
                              'show_input' => true
                            ),
                            "description" => __("Add Space to left of the button.", 'notion')
                      ),
                      array(
                          'name' => 'class',
                          'label' => 'Extra Class',
                          'type' => 'text',
                      ),
                    ),
                    'Typography' => array(
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
                          'type' => 'select',
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
                          'name' => 'transform_properties',
                          'type' => 'css',
                          'options' => array(
                            array(
                              'screens' => 'any',
                              'Transform Properties' => array(
                                array(
                                  'property' => 'text-transform',
                                  'label' => 'Text Transform',
                                ),
                              ),
                              
                            ),
                          ),
                      ),
                    ),
                    'Idle Style' => array(
                      array(
                          'name' => 'bg_color',
                          'label' => 'Background Color',
                          'type' => 'color_param',
                          'options' => notion_get_color_palette(),
                          'description' => 'Choose background color for the button',
                      ),
                      array(
                          'name' => 'txt_color',
                          'label' => 'Text Color',
                          'type' => 'color_param',
                          'options' => notion_get_color_palette(),
                          'description' => 'Choose text color for the button',
                      ),
                      array(
                          'name' => 'enable_border_transparent',
                          'label' => 'Make Border Transparent',
                          'type' => 'toggle',
                      ),
                      array(
                          'name' => 'border_color',
                          'label' => 'Border Color',
                          'type' => 'color_param',
                          'options' => notion_get_color_palette(),
                          'description' => 'Choose border color for the button',
                          'relation' => array(
                              'parent'    => 'enable_border_transparent',
                              'hide_when' => 'yes'
                          )
                      ),
                      array(
                          'name' => 'shadow',
                          'label' => 'Shadow',
                          'type' => 'select',  // USAGE SELECT TYPE
                          'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                              'no-shadow' => __('None', 'notion'),
                              'shadow-bit' => __('Bit', 'notion'),
                              'shadow-little' => __('Little', 'notion'),
                              'shadow-more' => __('More', 'notion'),
                              'shadow-plenty' => __('Plenty', 'notion')
                          ),
                          'value' => 'no-shadow', 
                          'description' => 'Choose the shadow for the button.',
                      ),
                    ),
                    'Hover Style' => array(
                      array(
                          'name' => 'hover_style',
                          'label' => 'Choose Hover Style',
                          'type' => 'select',  // USAGE SELECT TYPE
                          'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                              'simple-hover-style' => __('Simple', 'notion'),
                              'hover-sft-style' => __('Sweep From Top', 'notion'),
                              'hover-sfb-style' => __('Sweep From Bottom', 'notion'),
                              'hover-sfl-style' => __('Sweep From Left', 'notion'),
                              'hover-sfr-style' => __('Sweep From Right', 'notion'),
                              'hover-sv-style' => __('Sweep Vertically', 'notion'),
                              'hover-sh-style' => __('Sweep Horizotally', 'notion'),
                          ),
                          'value' => 'simple-hover-style', 
                          'description' => 'Choose the Hover style for the button.',
                      ),
                      array(
                          'name' => 'bg_color_hover',
                          'label' => 'Background Color',
                          'type' => 'color_param',
                          'options' => notion_get_color_palette(),
                          'description' => 'Choose background color for the button',
                      ),
                      array(
                          'name' => 'txt_color_hover',
                          'label' => 'Text Color',
                          'type' => 'color_param',
                          'options' => notion_get_color_palette(),
                          'description' => 'Choose text color for the button',
                      ),
                      array(
                          'name' => 'enable_hover_border_transparent',
                          'label' => 'Make Border Transparent',
                          'type' => 'toggle',
                      ),
                      array(
                          'name' => 'border_color_hover',
                          'label' => 'Border Color',
                          'type' => 'color_param',
                          'options' => notion_get_color_palette(),
                          'description' => 'Choose border color for the button',
                          'relation' => array(
                              'parent'    => 'enable_hover_border_transparent',
                              'hide_when' => 'yes'
                          )
                      ),
                      
                    ),
                    
                    
                )
            )
        )
    );
} 
// Register Before After Shortcode
function render_notion_button($atts, $content = null){
    extract( shortcode_atts( array(
        'button_text' => '',
        'button_link' => '',
        'btn_scroll' => '',
        'size' => 'normal-size-button',
        'shape' => 'square-edge',
        'btn_full_width' => '',
        'enable_lightbox' => '',
        'light_box_type' => '',
        'light_box_image_gallery' => '',
        'light_box_video_url' => '',
        'enable_icon' => '',
        'icon' => '',
        'icon_align' => 'icon-on-left',
        'icon_font_size' => '',
        'spacing' => '0px',
        'class' => '',
        'font_family' => '',
        'font_size' => '',
        'letter_spacing' => '',
        'font_wt' => '',
        'bg_color' => '',
        'txt_color' => '',
        'enable_border_transparent' => '',
        'border_color' => '',
        'shadow' => '',
        'bg_color_hover' => '',
        'txt_color_hover' => '',
        'border_color_hover' => '',
        'hover_style' => 'simple-hover-style',
        'enable_hover_border_transparent' => ''

        
        
    ), $atts) );

    
    $master_class = apply_filters( 'kc-el-class', $atts );

    
    $href = '';
    $target = '';

    if($button_link != 'http://'){
      $link_attrs = explode('|', $button_link);
      $href = $link_attrs[0];
      $target = $link_attrs[2];

    }

    $button_class = $class.' '.$size.' '.$shape.' '.$font_family.' '.$font_size.' '.$letter_spacing.' font-weight-'.$font_wt.' '.$bg_color.'-bg '.$txt_color.' '.$shadow.' '.$txt_color_hover.'-on-hover '.$hover_style;

    if($enable_border_transparent != 'yes')
      $button_class .= ' '.$border_color.'-border';
    else
      $button_class .= ' transparent-border';

    if($enable_hover_border_transparent != 'yes')
      $button_class .= ' '.$border_color_hover.'-border-on-hover';
    else
      $button_class .= ' transparent-border-on-hover';

    $em_class = $bg_color_hover.'-bg';

    if($btn_scroll == 'yes')
      $button_class .= ' scroll-link';

    if($btn_full_width == 'yes')
      $button_class .= ' full-width-button';

    $left_icon_markup = '';
    $right_icon_markup = '';
    if($enable_icon == 'yes'){
      $icon_class = $icon.' '.$icon_font_size;

      if($icon_align == 'icon-on-left')
        $left_icon_markup = '<i class="button-icon '.esc_attr($icon_class).'"></i>';
      else
        $right_icon_markup = '<i class="button-icon '.esc_attr($icon_class).'"></i>';

    }


    // LIGHTBOX SETTINGS

    $lightbox_pre_markup = '';
    $lightbox_post_markup = '';

    $data_src = '';

    if($enable_lightbox == 'yes'){

      $lightbox_post_markup = '</span>';

      if($light_box_type == 'lt-bx-image'){
        $lightbox_pre_markup = '<span class="image-lightbox">';
        $button_class .= ' image-selector';

        if($light_box_image_gallery != ''){
            

            $image_ids = explode( ',', $light_box_image_gallery );
            $count = 0;
            $img_links = '';

            foreach($image_ids as $image_id){
              $img_full = wp_get_attachment_image_src( $image_id, 'full' );
              if($count == 0){
                $href = $img_full[0];
              }else {
                $img_links .= '<a href="'.$img_full[0].'" class="image-selector"><span class="thumb-image"></span></a>';
              }

              
              $count++;
            }

          $lightbox_post_markup = '<span class="hidden d-none">'.$img_links.'</span></span>';

        }
      }

      if($light_box_type == 'lt-bx-video'){
        $lightbox_pre_markup = '<span class="video-lightbox">';
        $button_class .= ' video-selector video';
        $href = $light_box_video_url;
        $data_src = 'data-src="'.$light_box_video_url.'"';
        
      }

    }


    
    

    $output = $lightbox_pre_markup.'<a href="'.esc_url($href).'" '.$data_src.' target="'.esc_attr($target).'" class="notion-button ease '.esc_attr($button_class).' '.str_replace('kc-elm', ' ', implode(' ', $master_class)).'" style="margin-left: '.esc_attr($spacing).';">
                '.$left_icon_markup.'<span>'.esc_html($button_text).'</span>'.$right_icon_markup.'
              <dfn><em class="'.esc_attr($em_class).'"></em></dfn></a>'.$lightbox_post_markup;	  
    
    return $output;
}

add_shortcode('notion_button', 'render_notion_button'); 
