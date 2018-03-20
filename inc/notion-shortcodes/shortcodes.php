<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if(!function_exists('is_plugin_active')){
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

//add a css that works for admin side. Which menas workd on the KC editor page
function notion_core_shortcode_icon() {

    wp_enqueue_style('notion_core_shortcode_icon_css', plugins_url( 'css/icon.css' , __FILE__ ) );
    wp_enqueue_style('notion_core_shortcode_admin_css', plugins_url( 'css/admin.css' , __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'notion_core_shortcode_icon' );


//add a css that works only if not an admin. which means works on front end page
function notion_core_shortcode_style() {
    wp_enqueue_style('notion_core_shortcode_main_css', plugins_url( 'css/main.css' , __FILE__ ) );
}
  if (!is_admin())
  {
      add_action( 'wp_enqueue_scripts', 'notion_core_shortcode_style' );
  }


//remove the <p> tag
remove_filter( 'the_content', 'wpautop' );
$br = false;
add_filter( 'the_content', function( $content ) use ( $br ) {
    return wpautop( $content, $br );
}, 10 );





// ADD SHORTCODES HERE

if ( is_plugin_active( 'kingcomposer/kingcomposer.php' ) ){

    require_once ('shortcodes/text-block.php');
    require_once ('shortcodes/Liner.php');

}




// Check If King Composer is activate
function notion_core_user_required_plugin() {
    if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'kingcomposer/kingcomposer.php' ) ) {
        add_action( 'admin_notices', 'notion_core_user_required_plugin_notice' );

        deactivate_plugins( plugin_basename( __FILE__ ) );

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }

}
add_action( 'admin_init', 'notion_core_user_required_plugin' );

function notion_core_user_required_plugin_notice(){
    ?><div class="error"><p>Error! you need to install or activate the <a href="https://wordpress.org/plugins/kingcomposer/">King Composer</a> plugin to run this plugin.</p></div><?php
}


add_action('init', 'color_param_init', 99 );
function color_param_init(){

    global $kc;
    $kc->add_param_type( 'color_param' , 'setup_color_param' );
}

function setup_color_param(){
?>
    <select class="custom-colors kc-param" name="{{data.name}}">
    <# if( data.options ){
        for( var n in data.options ){
            
            if( typeof data.options[n] == 'array' || typeof data.options[n] == 'object' ){
                #><optgroup label="{{n}}"><#
                for( var m in data.options[n] ){
                    #><option<#
                    if( m == data.value ){ #> selected<# }
                    #> value="{{m}}">{{data.options[n][m]}}</option><#
                }
                #></optgroup><#

            }else{
                var color_segments = n.split('|');
                var color_title = color_segments[0];
                var color_id = color_segments[1];
                #><option<#
                

                if( color_id == data.value ){ #> selected<# }
                

                #> value="{{color_id}}" data-title="{{color_title}}">{{data.options[n]}}</option><#
            }
        }
    } #>
    </select>
    <?php
}

