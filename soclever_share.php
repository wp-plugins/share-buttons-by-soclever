<?php 
/*
Plugin Name: Share Buttons & Analytics By Soclever Social
Plugin URI: https://www.socleversocial.com/
Description: A simple and easy to use plugin that enables you to add share buttons to all of your posts and/or pages and get detailed report on our Soclever dashbaord.

Version: 1.0.3
Author: Soclever Team
Author URI: https://www.socleversocial.com/
Author Email:info@socleversocial.com
*/

if ( ! defined('ABSPATH')) exit;

register_activation_hook(__FILE__, 'scss_activation');
register_uninstall_hook(__FILE__, 'scss_uninstall');
require_once( plugin_dir_path( __FILE__ ) . 'scss_show.php');
function scss_activation(){
		update_option('scss_no_autho_url','https://www.socleversocial.com/dashboard/'); //update plugin version.       
        update_option('scss_display_position','top');
        update_option('scss_valid_domain','0');
        update_option('scss_site_id','0');
        update_option('scss_api_key','0');
        update_option('scss_api_secret','0');
        update_option('scss_selected_buttons','');
        update_option('scss_button_orders','');
        update_option('scss_counter_type','2');
        update_option('scss_gap','1');
        update_option('scss_icon_size','30x30');
        update_option('scss_display_style','0');
        update_option('scss_button_style','2');
        update_option('scss_share_autho','1');
        update_option('scss_domain',''); 
        update_option('scss_show_homepage','1');
        update_option('scss_show_post','0');
        update_option('scss_show_page','0');
        update_option('scss_show_category','0');
        update_option('scss_show_excerpts','0');
        $share_button_title=array("2"=>"Facebook","4"=>"Google+","7"=>"LinkedIN","13"=>"Twitter","17"=>"Pinterest","18"=>"WhatsApp","19"=>"StumbleUpon","20"=>"Reddit","21"=>"Tumblr");
        foreach($share_button_title as $key=>$val)
        {
            $val=($val=='Google+')?'google_plus':$val;
            update_option('scss_custom_'.strtolower($val).'','');    
        }
        
        
                    
	}


function scss_uninstall()
	{
		
		delete_option( 'scss_no_autho_url' );         
        delete_option( 'scss_display_position');
        delete_option( 'scss_valid_domain');
		delete_option('scss_site_id');
        delete_option('scss_api_key');
        delete_option('scss_api_secret');
        delete_option('scss_selected_buttons');
        delete_option('scss_button_orders');
        delete_option('scss_counter_type');
        delete_option('scss_gap');
        delete_option('scss_icon_size');
        delete_option('scss_display_style');
        delete_option('scss_button_style');
        delete_option('scss_domain');
        delete_option('scss_share_autho');
        delete_option('scss_show_homepage');
        delete_option('scss_show_post');
        delete_option('scss_show_page');
        delete_option('scss_show_category');
        delete_option('scss_show_excerpts');
         $share_button_title=array("2"=>"Facebook","4"=>"Google+","7"=>"LinkedIN","13"=>"Twitter","17"=>"Pinterest","18"=>"WhatsApp","19"=>"StumbleUpon","20"=>"Reddit","21"=>"Tumblr");
        foreach($share_button_title as $key=>$val)
        {
            $val=($val=='Google+')?'google_plus':$val;
            delete_option('scss_custom_'.strtolower($val).'');    
        }
        
	}
    
    function scss_admin_scripts() {
	
        wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui');
        
	}
    
    function scss_admin_styles() {
	
		// admin styles
		wp_enqueue_style('thickbox');
		wp_enqueue_style('wp-color-picker');
		
	}
    
    if (isset($_GET['page']) && $_GET['page'] == 'soclever_share') {
	
		// add the registered scripts
		add_action('admin_print_styles', 'scss_admin_styles');
		add_action('admin_print_scripts', 'scss_admin_scripts');
	}

add_action( 'admin_menu', 'cs_share_menu' );

function cs_share_menu(){
    add_menu_page( 'Share Buttons By SoClever', 'Share Buttons By SoClever', 'manage_options', 'soclever_share', 'scsshare_html_page', plugins_url( 'scss_css/sc_share.png', __FILE__ ), 81.1); 
}

    
    add_action('wp_head', 'scss_image_set');

function scss_image_set()
	{
	  	$scss_image = '';
			
		if ( is_singular() ) 
			{
				$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

if($post_thumbnail_url=='')
                {

                    $post_thumbnail_url=get_header_image();

                }
                
                $scss_image .= '<meta property="scss_image" content="'.$post_thumbnail_url.'" />';
				$scss_image .= '<meta property="og:image" content="'.$post_thumbnail_url.'" />';
                $scss_image .= '<script type="text/javascript" /> var scss_share_image="'.$post_thumbnail_url.'"</script>';
			} 
		else 
			{

			}
			
		echo $scss_image;
	}


function getAvailablescss($strSelectedscss) {

	
	$htmlAvailableListscss = '';
	$arrSelectedscss = '';
	
	
	$arrSelectedscss = explode(',', $strSelectedscss);
	
	
	$arrAllAvailablescss = array('Facebook','Google+','LinkedIN','Twitter','Pinterest','WhatsApp','StumbleUpon','Reddit','Tumblr');
	
	// explode saved include list and add to a new array
	$arrAvailablescss = array_diff($arrAllAvailablescss, $arrSelectedscss);
	
	// check if array is not empty
	if ($arrSelectedscss != '') {
	
		// for each included button
		foreach ($arrAvailablescss as $strAvailablescss) {
		
			// add a list item for each available option
			$htmlAvailableListscss .= '<li id="' . $strAvailablescss . '">' . $strAvailablescss . '</li>';
		}
	}
	
	// return html list options
	return $htmlAvailableListscss;
}

function getSelectedscss($strSelectedscss) {
    
    

	// variables
	$htmlSelectedListscss = '';
	$arrSelectedscss = '';

	
	if ($strSelectedscss != '') {
	
		
		$arrSelectedscss = explode(',', $strSelectedscss);
		
		// check if array is not empty
		if ($arrSelectedscss != '') {
		
			
			foreach ($arrSelectedscss as $strSelectedscss) {
			
                if($strSelectedscss!='')    
				{
				$htmlSelectedListscss .= '<li id="' . $strSelectedscss . '">' . $strSelectedscss. '</li>';
                }
			}
		}
	}
	
	// return html list options
	return $htmlSelectedListscss;
}

 
if((isset($_POST['save_share_1']) && sanitize_text_field($_POST['save_share_1'])=='Save' ) || (isset($_POST['save_share_2']) && sanitize_text_field($_POST['save_share_2'])=='Save' ) || (isset($_POST['save_share_3']) && sanitize_text_field($_POST['save_share_3'])=='Save' ) )
{
 
 
    
    
update_option('scss_display_position',stripslashes(sanitize_text_field($_POST['scss_display_position'])));
$social_buttons=""; $orders="";

$share_button_title=array("2"=>"Facebook","4"=>"Google+","7"=>"LinkedIN","13"=>"Twitter","17"=>"Pinterest","18"=>"WhatsApp","19"=>"StumbleUpon","20"=>"Reddit","21"=>"Tumblr");

foreach($share_button_title as $key=>$val)
{
    $val=($val=='Google+')?'google_plus':$val;
    if($_POST['scss_custom_'.strtolower($val).'']!='')
    {
        
        update_option('scss_custom_'.strtolower($val).'',$_POST['scss_custom_'.strtolower($val).'']);
    }
}
$selected_buttons_new=array();
if(sanitize_text_field($_POST['scss_selected_buttons'])!='')
{
    $selected_buttons_new=explode(",",sanitize_text_field($_POST['scss_selected_buttons']));
}

//print_r($selected_buttons_new);

if(count($selected_buttons_new) > 0)
{
    foreach($selected_buttons_new as $key=>$val)
    {
        
        $social_buttons .=",".sanitize_text_field(array_search($val,$share_button_title));
    }
}

update_option('scss_selected_buttons',$social_buttons);
update_option('scss_counter_type',sanitize_text_field($_POST['counter_type']));
update_option('scss_gap',sanitize_text_field($_POST['gap']));
update_option('scss_icon_size',sanitize_text_field($_POST['icon_size']));
update_option('scss_display_style',sanitize_text_field($_POST['display_style']));
update_option('scss_button_style',sanitize_text_field($_POST['button_style']));

update_option('scss_show_homepage',sanitize_text_field($_POST['scss_show_homepage']));
        update_option('scss_show_post',sanitize_text_field($_POST['scss_show_post']));
        update_option('scss_show_page',sanitize_text_field($_POST['scss_show_page']));
        update_option('scss_show_category',sanitize_text_field($_POST['scss_show_category']));
        update_option('scss_show_excerpts',sanitize_text_field($_POST['scss_show_excerpts']));
        
        
update_option('scss_share_autho','1');

$js_written=file_get_contents('https://www.socleversocial.com/dashboard/wp_write_noauthosharejs.php?site_id='.sanitize_text_field(get_option('scss_site_id')).'&save=Save&autho_share=1');
      if($js_written=='1')
      {
        header("location:admin.php?page=soclever_share");
        exit;
        
           
      }

}


if(isset($_POST['submit_share']) && sanitize_text_field($_POST['submit_share'])=='Submit' )
{
   
    
    $res_ponse_str=file_get_contents('https://www.socleversocial.com/dashboard/wp_activate.php?site_id='.sanitize_text_field($_POST['client_id']).'&api_key='.sanitize_text_field($_POST['api_key']).'&api_secret='.sanitize_text_field($_POST['api_secret']).'');
    $res_ponse=explode("~~",$res_ponse_str);
    if(sanitize_text_field($_POST['api_key'])==$res_ponse[0] && sanitize_text_field($_POST['api_secret'])==$res_ponse[1] && $res_ponse[0]!='0')
    {
        echo "<h2>Thanks for authentication. Redirecting now to setting page...</h2>";
        /*echo"<br/><h3>Preview</h3><br/>";
        echo htmlspecialchars_decode($res_ponse[2]);*/
        update_option("scss_valid_domain",'1');
        update_option("scss_site_id",sanitize_text_field($_POST['client_id']));
        update_option("scss_api_key",sanitize_text_field($_POST['api_key']));
        update_option("scss_api_secret",sanitize_text_field($_POST['api_secret']));
        update_option("scss_domain",sanitize_text_field($_POST['scss_domain']));
        ?>
        <script type="text/javascript">
         setTimeout(function(){ window.location='admin.php?page=soclever_share'; }, 3000);
         </script>
        <?php
        exit;
    }
    else
    {
       
        echo"<h2 margin='40px;width:90%;'>Authentication failed.If you have already account then please contact us at support@socleversocial.com.If you haven't socleversocial.com account then <a href='https://www.socleversocial.com/pricing/ target='_blank'>Register</a> your account</h2>";
        ?>
        <script type="text/javascript">
         setTimeout(function(){ window.location='options-general.php?page=soclever_share'; }, 3000);
         </script>
        <?php
        exit;
    }
   
}



function scsshare_html_page() {
 wp_register_style( 'scss-style', plugins_url('scss_css/scss-style.css?t='.time().'', __FILE__) );
 wp_enqueue_style( 'scss-style' );
   
?>

<header class="scss-clearfix">
    <h1>
	<a href="https://www.socleversocial.com/" target="_blank">
        <img src="https://www.socleversocial.com/dashboard/img/logo.png" alt="SoClever Social" />
	</a>
    </h1>

    <h2>
       Get access to your Free reports on Soclever Dashboard
    </h2>
</header>



<?php
if(get_option('scss_valid_domain')=='1')
{
    $selected_buttons=explode(",",get_option('scss_selected_buttons'));
    $selectedButtons='';
    
$all_social_buttons=array("2","4","7","13","17","18","19","20");    
if(is_array($selected_buttons) && get_option('scss_selected_buttons')!='')
{
  $share_button=array_unique(array_merge($selected_buttons,$all_social_buttons), SORT_REGULAR);
    



}
else
{
    $share_button=array("2","4","7","13","17","18","19","20");
}
$share_button_title=array("2"=>"Facebook","4"=>"Google+","7"=>"LinkedIN","13"=>"Twitter","17"=>"Pinterest","18"=>"WhatsApp","19"=>"StumbleUpon","20"=>"Reddit","21"=>"Tumblr");
foreach($selected_buttons as $selected)
{
    $selectedButtons .=$share_button_title[$selected].",";
}
$counter_type=get_option('scss_counter_type');
$short_order=array("1","2","3","4","5","6","7","8");
$gap=get_option('scss_gap');
$icon_size=get_option('scss_icon_size');
$display_style=get_option('scss_display_style');
$button_style=get_option('scss_button_style');
$width_arr=explode("x",$icon_size);
$div_width="width:".$width_arr[0]."px;";   
$gap_string="margin-top:".$gap."px;";
 
$float_string="float:right;";
 
 wp_register_script( 'scss_tabb', plugins_url('scss_js/tabbed.js', __FILE__));
 wp_enqueue_script( 'scss_tabb' );
    
?>
<?php
// jQuery
wp_enqueue_script('jquery');
wp_enqueue_media();
?>

<script type="text/javascript">

jQuery(document).ready(function() {

	//------- INCLUDE LIST ----------//

	// add drag and sort functions to include table
	jQuery(function() {
		jQuery( "#scsssort1, #scsssort2" ).sortable({
			connectWith: ".connectedSortable"
		}).disableSelection();
	  });
	 
	// extract and add include list to hidden field
	jQuery('#scss_selected_buttons').val(jQuery('#scsssort2 li').map(function() {
	// For each <li> in the list, return its inner text and let .map()
	//  build an array of those values.
	return jQuery(this).attr('id');
	}).get());
	  
	// after a change, extract and add include list to hidden field
	jQuery('.scss-include-list').mouseout(function() {
		jQuery('#scss_selected_buttons').val(jQuery('#scsssort2 li').map(function() {
		// For each <li> in the list, return its inner text and let .map()
		//  build an array of those values.
		return jQuery(this).attr('id');
		}).get());
	});
	  
    
    jQuery('.customUpload').click(function(e) {
        var strInputID = jQuery(this).data('scss-input');
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',            
            multiple: false
        }).open()
        .on('select', function(e){
            
            var uploaded_image = image.state().get('selection').first();
            var image_url = uploaded_image.toJSON().url;            
            jQuery('#' + strInputID).val(image_url);
        });
    });

});

function show_custom_images()
{
    if(document.authosharefrm.button_style.value=='custom')
    {
        document.getElementById("scss-custom-images").style.display="inline-block";
    }
    else
    {
        document.getElementById("scss-custom-images").style.display="none";
    }
}
</script>

    
<form class="login-form mt-lg" action="" method="post" name="authosharefrm" enctype="multipart/form-data">
<div class="tabber" style="width: 95% !important;">
     <div class="tabbertab">
	  <h2>Basic</h2>
      
       
      <table class="table" style="margin:20px;font-size:1em;">
	  <tr><th align="left">Select buttons</th></tr>
                                <tr>
                                    <td style="border: medium none;">
                                        
                                        <?php 
                                        
                                        
                        				$htmlShareButtonsForm .= '<table class="form-table">';
                        					$htmlShareButtonsForm .= '<tr valign="top">';                        						
                        						$htmlShareButtonsForm .= '<td class="scss-include-list available">';
                        							$htmlShareButtonsForm .= '<span class="include-heading">Available</span>';
                        							$htmlShareButtonsForm .= '<center><ul id="scsssort1" class="connectedSortable">';
                        							 $htmlShareButtonsForm .= getAvailablescss($selectedButtons);
                        							$htmlShareButtonsForm .= '</ul></center>';
                        						$htmlShareButtonsForm .= '</td>';
                        						$htmlShareButtonsForm .= '<td class="scss-include-list chosen">';
                        							$htmlShareButtonsForm .= '<span class="include-heading">Selected</span>';
                        							$htmlShareButtonsForm .= '<center><ul id="scsssort2" class="connectedSortable">';
                        							$htmlShareButtonsForm .= getSelectedscss($selectedButtons);
                        							$htmlShareButtonsForm .= '</ul></center>';
                        						$htmlShareButtonsForm .= '</td>';
                        					$htmlShareButtonsForm .= '</tr>';
                        				    $htmlShareButtonsForm .= '</table>';
                                            $htmlShareButtonsForm .= '</div>';
                                            $htmlShareButtonsForm .= '<input type="hidden" name="scss_selected_buttons" id="scss_selected_buttons" value="'.$selectedButtons.'" />';
                                            echo $htmlShareButtonsForm;
                                         ?>
                                       
                                        
                                    </td>
                                </tr>
                                
                                <tr>
                    <th align="left">Show on</th>
                    </tr>
                    <tr>                    
                    <td>
                    <input type="checkbox" name="scss_show_homepage" value="1" <?php echo (get_option('scss_show_homepage')=='1')?'checked':''; ?> /><b>Home Page</b><br/>
                    <input type="checkbox" name="scss_show_post" value="1" <?php echo (get_option('scss_show_post')=='1')?'checked':''; ?> /><b>Posts</b><br/>
                    <input type="checkbox" name="scss_show_page" value="1" <?php echo (get_option('scss_show_page')=='1')?'checked':''; ?> /><b>Pages</b><br/>
                    <input type="checkbox" name="scss_show_category" value="1" <?php echo (get_option('scss_show_category')=='1')?'checked':''; ?>  /><b>Categories/Archives</b><br/>
                    <input type="checkbox" name="scss_show_excerpts" value="1" <?php echo (get_option('scss_show_excerpts')=='1')?'checked':''; ?> /><b>Excerpts</b><br/>
                    </td>
                    </tr>      
                                
                                <tr>
                    <th align="left">Display Position</th>
                    </tr>
                    <tr>                    
                    <td>
                    <select name="scss_display_position" id="scss_display_position">
                    <option value="top" <?php if(get_option('scss_display_position')=='top') { echo "selected='selected'"; } ?>>Top</option>
                    <option value="bottom" <?php if(get_option('scss_display_position')=='bottom') { echo "selected='selected'"; } ?>>Bottom</option>
                    <option value="both" <?php if(get_option('scss_display_position')=='both') { echo "selected='selected'"; } ?>>Both</option>
                    </select>
                    </td>
                    </tr>      
                    <tr>
                                    <td>
                                        <div class="clearfix">
                                            <div class="btn-toolbar pull-right">
                                            
                                                <input type="submit" name="save_share_1" class="scssbutton" value="Save" />
                                            </div>
                                        </div>
                                    </td>
                     </tr>
                     
        </table>                        
     </div>


     <div class="tabbertab">
	  <h2>Style</h2>
	  <table class="table" style="margin:20px;font-size:1em;">
      <tr>
      <th align="left">Select Your Style</th></tr>
      <tr>
      <td style="border: medium none;">
                                        <div style="display: none;"><input type="radio" name="button_style" id="button_style_1" value="0"<?php if($button_style=="0") { echo ' checked="checked"'; };?> />&nbsp;&nbsp;<img src="<?php echo SITE_URL;?>img/social_icon/Share_ButtonStyle.gif" alt="Social Share Button Style" /></div>                                        
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_3" onclick="show_custom_images()" value="2"<?php if($button_style=="2") { echo ' checked="checked"'; };?>  /><div style="margin-top: -24px;margin-left:20px;">&nbsp;&nbsp;Rounded Color</div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_4" onclick="show_custom_images()" value="3"<?php if($button_style=="3") { echo ' checked="checked"'; };?>  /><div style="margin-top: -20px;margin-left:20px;">&nbsp;&nbsp;Transparent Grey</div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_5" onclick="show_custom_images()" value="4"<?php if($button_style=="4") { echo ' checked="checked"'; };?>  /><div style="margin-top: -20px;margin-left:20px;">&nbsp;&nbsp;Rounded Black</div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_6" onclick="show_custom_images()" value="5"<?php if($button_style=="5") { echo ' checked="checked"'; };?>  /><div style="margin-top: -24px;margin-left:20px;">&nbsp;&nbsp;Flower</div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_7" onclick="show_custom_images()" value="6"<?php if($button_style=="6") { echo ' checked="checked"'; };?>  /><div style="margin-top: -20px;margin-left:20px;">&nbsp;&nbsp;Glossy</div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_8" onclick="show_custom_images()" value="7"<?php if($button_style=="7") { echo ' checked="checked"'; };?>  /><div style="margin-top: -20px;margin-left:20px;">&nbsp;&nbsp;Leaf</div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_9" onclick="show_custom_images()" value="8"<?php if($button_style=="8") { echo ' checked="checked"'; };?>  /><div style="margin-top: -20px;margin-left:20px;">&nbsp;&nbsp;Polygon</div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_10" onclick="show_custom_images()" value="9"<?php if($button_style=="9") { echo ' checked="checked"'; };?>  /><div style="margin-top: -20px;margin-left:20px;">&nbsp;&nbsp;Rectangular</div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_11" onclick="show_custom_images()" value="10"<?php if($button_style=="10") { echo ' checked="checked"'; };?>  /><div style="margin-top: -20px;margin-left:20px;">&nbsp;&nbsp;Rounded Corners</div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_12" onclick="show_custom_images()" value="11"<?php if($button_style=="11") { echo ' checked="checked"'; };?>  /><div style="margin-top: -20px;margin-left:20px;">&nbsp;&nbsp;Waterdrop</div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="scss_image_set" onclick="show_custom_images()" value="custom"<?php if($button_style=="custom") { echo ' checked="checked"'; };?>  /><div style="margin-top: -20px;margin-left:20px;">&nbsp;&nbsp;<b>Custom Images</b></div></div>
                                        
      </td>
      </tr>
      <tr>
      <td>
      <?php
      
      $htmlShareButtonsForm="";
      $htmlShareButtonsForm .= '<div id="scss-custom-images" ' . ($button_style=='custom'?'style="display: inline-block;"':'style="display:none;"').'>';				
				$htmlShareButtonsForm .= '<table class="form-table">';
                foreach($share_button_title as $key=>$val)
                {
                    $val=($val=='Google+')?'google_plus':$val;
                    $htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>'.$val.':</label></th>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= '<input id="scss_custom_'.strtolower($val).'" type="text" size="50" name="scss_custom_'.strtolower($val).'" value="'.get_option('scss_custom_'.strtolower($val).'').'" />';
						$htmlShareButtonsForm .= '<input id="upload_'.strtolower($val).'_button" data-scss-input="scss_custom_'.strtolower($val).'" class="button customUpload" type="button" value="Upload Image" />';
						$htmlShareButtonsForm .= '</td>';
					$htmlShareButtonsForm .= '</tr>';
                }
					
				$htmlShareButtonsForm .= '</table>';
				$htmlShareButtonsForm .= '</div>';
                echo $htmlShareButtonsForm;
                ?>
      </td>
      </tr>
      <tr><th align="left">Button Size</th></tr>
                                <tr>
                                    <td style="border: medium none;">
                                        <div><input type="radio" name="icon_size" id="icon_size_1" value="30x30"<?php if($icon_size=="30x30") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;30x30</div>
                                        <div><input type="radio" name="icon_size" id="icon_size_2" value="32x32"<?php if($icon_size=="32x32") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;32x32</div>
                                        <div><input type="radio" name="icon_size" id="icon_size_3" value="40x40"<?php if($icon_size=="40x40") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;40x40</div>
                                        <div><input type="radio" name="icon_size" id="icon_size_4" value="50x50"<?php if($icon_size=="50x50") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;50x50</div>
                                        <div><input type="radio" name="icon_size" id="icon_size_5" value="60x60"<?php if($icon_size=="60x60") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;60x60</div>
                                        <div><input type="radio" name="icon_size" id="icon_size_6" value="70x70"<?php if($icon_size=="70x70") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;70x70</div>
                                        <div><input type="radio" name="icon_size" id="icon_size_7" value="85x85"<?php if($icon_size=="85x85") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;85x85</div>
                                        <div><input type="radio" name="icon_size" id="icon_size_8" value="100x100"<?php if($icon_size=="100x100") { echo ' checked="checked"'; };?> />&nbsp;&nbsp;100x100</div>
                                    </td>
        </tr>
        
        <tr><th align="left">Display Style</th></tr>
                                <tr>
                                    <td style="border: medium none;">
                                        <div><input type="radio" name="display_style" id="display_style_1" value="0"<?php if($display_style=="0") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;Horizontal</div>
                                        <div><input type="radio" name="display_style" id="display_style_2" value="1"<?php if($display_style=="1") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;Vertical (Left)</div>
                                        <div><input type="radio" name="display_style" id="display_style_3" value="2"<?php if($display_style=="2") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;Vertical (Right)</div>                                        
                                    </td>
                                </tr>
         <tr><th align="left">Padding Gap</th></tr>
                                <tr>
                                    <td style="border: medium none;">
                                    <select name="gap" id="gap" >
                                    <?php for($i=0;$i<=20;$i++) { ?>
                                    <option value="<?php echo $i; ?>" <?php echo ($i==$gap)?"selected":"";?> ><?php echo $i; ?></option>
                                    <?php } ?>
                                    </select>px
                                         </td>
                                </tr>                       
            <tr>
                                    <td>
                                        <div class="clearfix">
                                            <div class="btn-toolbar pull-right">
                                            
                                                <input type="submit" name="save_share_2" class="scssbutton" value="Save" />
                                            </div>
                                        </div>
                                    </td>
                     </tr>
                                                                  
      </table>
     </div>
        

     <div class="tabbertab">
	  <h2>Counter</h2>
	  <table class="table" style="margin:20px;font-size:1em;">
      <tr><th align="left">Counter Display</th></tr>
                                <tr>
                                    <td style="border: medium none;">
                                        <div><input type="radio" name="counter_type" id="counter_type_1" value="0"<?php if($counter_type=="0") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;Horizontal</div>
                                        <div><input type="radio" name="counter_type" id="counter_type_2" value="1"<?php if($counter_type=="1") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;Vertical</div>
                                        <div><input type="radio" name="counter_type" id="counter_type_3" value="2"<?php if($counter_type=="2") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;No Counter</div>
                                    </td>
                                </tr> 
        <tr>
                                    <td>
                                        <div class="clearfix">
                                            <div class="btn-toolbar pull-right">
                                            
                                                <input type="submit" name="save_share_3" class="scssbutton" value="Save" />
                                            </div>
                                        </div>
                                    </td>
                     </tr>
                                    
      </table>
     </div>

</div>
</form>
<?php wp_nonce_field('update-options'); ?>
<script type="text/javascript">


    function call_check_uncheck_all(chk)
    {
       var totalsocials="<?php echo count($share_button); ?>";
        if(chk!="N/A")
        {
            for(i=1;i<=totalsocials;i++)
            {
                if(chk=="all") {
                    document.getElementById('share_button_'+i).checked=true;
                }
                else if(chk=="none") {
                    document.getElementById('share_button_'+i).checked=false;
                }
            }
        }
       
    }
    
    
</script>


<?php } else { ?>  

<table id="cssteps">
        <thead>
            <tr valign="top">
                <th>
                <h1>Step 1 - Create a SocleverSocial.com account</h1>
                <p>To get started, register your Soclever Social account and find your API key in the site settings. If you already have an account please log in. </p>
                </th>
            </tr>
        </thead>
        <tbody>           
        </tbody>
        <tfoot>
            <tr valign="top">
                <td>
                    <a href="https://www.socleversocial.com/register/?wpd=<?php echo base64_encode(get_site_url()); ?>" target="_blank" class="scssbutton">Register</a> 
                    <a href="https://www.socleversocial.com/dashboard/" target="_blank" class="scssbutton">Login</a></p>
                </td>
            </tr>
            <tr valign="top" align="left">
                <th>
                <h1>Step 2 - Enter your API Settings</h1>                
                </th>
            </tr>
            <tr>
            <td>
                <form method="post" action="">
  <?php wp_nonce_field('update-options'); ?>
<table width="55%">
<tr valign="middle">
<th width="20%" scope="row">Client ID</th>
<td>
<input type="text" name="client_id" id="client_id" width="10" />
 
</td>
</tr>
<tr valign="middle">
<th width="20%" scope="row">API Key</th>
<td>
<input type="text" name="api_key" id="api_key"  width="40"/>
 
</td>
</tr>
<tr valign="middle">
<th width="20%" scope="row">API Secret</th>
<td>
<input type="text" name="api_secret" id="api_secret"  width="40"/>
 
</td>
</tr>
<tr valign="middle">
<th width="20%" scope="row">Valid Domain</th>
<td>
<input type="text" name="scss_domain" id="scss_domain"  width="100"/> 
 
</td>
</tr>
<tr valign="middle">
<td>&nbsp;</td>
<td>
<input type="submit" name="submit_share" class="scssbutton" id="submit_share"  value="Submit"/>
 
</td>
</tr>
</table>
  </form>
  
            
            </td>
            </tr>
        </tfoot>
    </table>

  
    
    
<?php    
}
 ?>
<div style="background: none repeat scroll 0 0 #fff;border: 1px solid #eee;margin-bottom: 30px;width:95%;">
					<h4 style=" border-bottom: 1px solid #eee;margin-bottom: 10px;padding: 10px 0;text-align: center;">Help</h4>
					<div style="padding: 10px 10px 30px 0px;">
						<a style="display:block;margin-left:10px;" href="http://developers.socleversocial.com/wordpress-social-sharing-buttons-instructions/" target="_blank">
							Plug in Configuration and Troubleshooting</a>
						<a style="display:block;margin-left:10px;" href="http://developers.socleversocial.com/how-to-get-api-key-and-secret/" target="_blank">
							How to get Soclever API key and secret?</a>
						<a style="display:block;margin-left:10px;" href="http://developers.socleversocial.com/" target="_blank">
							Social Network Apps Set Up</a>
						<a style="display:block;margin-left:10px;" href="https://www.socleversocial.com/about-us/" target="_blank">
							About Soclever</a>	
					</div>
				</div>

 <?php } ?>