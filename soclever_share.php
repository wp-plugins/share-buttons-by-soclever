<?php 
/*
Plugin Name: Share Buttons & Analytics By Soclever Social
Plugin URI: https://www.socleversocial.com/
Description: A simple and easy to use plugin that enables you to add share buttons to all of your posts and/or pages and get detailed report on our Soclever dashbaord.

Version: 1.1.0
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
        update_option('scss_module_loaded','0');
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
        delete_option('scss_module_loaded');
         $share_button_title=array("2"=>"Facebook","4"=>"Google+","7"=>"LinkedIN","13"=>"Twitter","17"=>"Pinterest","18"=>"WhatsApp","19"=>"StumbleUpon","20"=>"Reddit","21"=>"Tumblr");
        foreach($share_button_title as $key=>$val)
        {
            $val=($val=='Google+')?'google_plus':$val;
            delete_option('scss_custom_'.strtolower($val).'');    
        }
        
	}
    
  
  function soclever_share_setup($links, $file)
{
	static $soclever_social_share_plugin = null;

	if (is_null ($soclever_social_share_plugin))
	{
		$soclever_social_share_plugin = plugin_basename (__FILE__);
	}

	if ($file == $soclever_social_share_plugin)
	{
		$settings_link = '<a href="admin.php?page=soclever_share">' . __ ('Setup', 'soclever_share') . '</a>';
		array_unshift ($links, $settings_link);
	}
	return $links;
}
add_filter ('plugin_action_links', 'soclever_share_setup', 10, 2);


  function get_csscurl($url)
{
    
if(get_option('scss_module_loaded')=='1')
{
 return file_get_contents($url);    
}
else
{        
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);  
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);    
curl_setopt($ch, CURLOPT_SSLVERSION,3);
$result_response = curl_exec($ch);
$actual_return=$result_response;
curl_close($ch);
return $actual_return;
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
    add_menu_page( 'Share Buttons By SoClever', 'Share Buttons By SoClever', 'manage_options', 'soclever_share', 'scsshare_html_page', plugins_url( 'scss_css/sc_share.png', __FILE__ ), 81); 
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

$js_written=get_csscurl('https://www.socleversocial.com/dashboard/wp_write_noauthosharejs.php?site_id='.sanitize_text_field(get_option('scss_site_id')).'&save=Save&autho_share=1');
      if($js_written=='1')
      {
        header("location:admin.php?page=soclever_share");
        exit;
        
           
      }

}


if(isset($_POST['submit_share']) && sanitize_text_field($_POST['submit_share'])=='Submit' )
{
   
    
    $res_ponse_str=file_get_contents('https://www.socleversocial.com/dashboard/wp_activate.php?site_id='.sanitize_text_field($_POST['client_id']).'&api_key='.sanitize_text_field($_POST['api_key']).'&api_secret='.sanitize_text_field($_POST['api_secret']).'');
    
    
    if(!$res_ponse_str)
    {
        $res_ponse_str=get_csscurl('https://www.socleversocial.com/dashboard/wp_activate.php?site_id='.sanitize_text_field($_POST['client_id']).'&api_key='.sanitize_text_field($_POST['api_key']).'&api_secret='.sanitize_text_field($_POST['api_secret']).'');
    }
    else
    {
        update_option('scss_module_loaded','1');
    }
   
    if(!$res_ponse_str)
    {
      echo "<h3>Please check your php.ini's setting for FSOCKOPEN or CURL</h2>";
      wp_die();  
    }
    else
    {
        if(get_option('scss_module_loaded')=='0')
        {
        update_option('scss_module_loaded','2');
        }
    }
    
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

<header>
	<div class="main">
    	<div class="logo">
        	<a href="https://www.socleversocial.com/" target="_blank"><img src="<?php echo plugins_url('scss_css/logo.png', __FILE__); ?>" alt="SoClever Social" /></a>
        </div>
    </div>
</header>
<section>
	<div class="main">
 <div class="sect-left" style="margin-top: 15px;">
 	<nav>
    <?php if(get_option('scss_valid_domain')=='0') { ?>
            	<ul>
                	<li class="active" style="width: 100%;background-repeat: repeat;" ><a>Your SoClever API Setting</a></li>                    
                </ul>
     <?php } else { ?>
     	<ul>
                	
                    <li class="active" style="width: 100%;background-repeat: repeat;"><a>SoClever Social Sharing Setting</a></li>
                </ul>
     <?php } ?>
                
            </nav>


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
function show_sub_activate(tab_id)
{
    for(var i=6;i<=8;i++)
    {
        
        if(i==tab_id)
        {
            document.getElementById("tabli"+tab_id).className="active";
        
        document.getElementById("tab"+tab_id).style.display="inline-block";
        
        }
        else
        {
            document.getElementById("tabli"+i).className="";
            document.getElementById("tab"+i).style.display="none";
        }
    }
}
</script>

<div style="clear: both;">&nbsp;</div>  
<nav>
<ul>
                	<li id="tabli6" class="active" style="width:20%;"><a href="javascript:void(0);" onclick="show_sub_activate('6');">Basic</a></li>
                    <li id="tabli7"  style="width:20%;"><a href="javascript:void(0);" onclick="show_sub_activate('7');">Style</a></li>
                    <li  id="tabli8" style="width:20%;"><a href="javascript:void(0);" onclick="show_sub_activate('8');">Counter</a></li>                    
                </ul>
</nav>                
  
<form class="login-form mt-lg" action="" method="post" name="authosharefrm" enctype="multipart/form-data">

<div class="box1" style="margin-top:-10px;">
     <div id="tab6">
      
      
       
      <table class="table" style="margin:20px;font-size:1em;">
	  <tr>
      <td>
      <div class="main-bx1">
               	<label>Select Networks</label>
                </div>
      </td>
      </tr>
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
                                        <div class="btn">
            <input type="submit" id="button" name="save_share_1"  value="Save"  />
               	  
                </div>
                                    </td>
                     </tr>
                     
        </table>                        
     </div>


     <div id="tab7" style="display: none;">
	  
      <?php
      $button_style_arr=array(" Rounded Color","Transparent Grey","Rounded Black","Flower","Glossy","Leaf","Polygon","Rectangular","Rounded Corners","Waterdrop");
       ?>
       <div class="main-bx1" style="float: none;">
               	<p>Select Your Style</p>
                <?php foreach($button_style_arr as $key=>$val) { ?>
                <div class="lbls radio-danger">
               		 <input type="radio" name="button_style"  id="button_style_<?php echo intval($key+3); ?>" onclick="show_custom_images()" value="<?php echo intval($key+2); ?>"<?php if($button_style==intval($key+2)) { echo ' checked="checked"'; };?> />
            	<label for="button_style_<?php echo intval($key+3); ?>" class="css-label radGroup2"><?php echo $val; ?></label>
                </div>
                <?php } ?>
                <div class="lbls radio-danger">
               		 <input type="radio" name="button_style"  id="scss_image_set" onclick="show_custom_images()" value="custom"<?php if($button_style=="custom") { echo ' checked="checked"'; };?> />
            	<label for="scss_image_set" class="css-label radGroup2">Custom Images</label>
                </div>
                 </div>
              
              
	  <div class="main-bx1" style="float: none;">
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
      </div>
      <div class="main-bx1" style="float: none;">
               	<p>Button Size</p>
       <?php $button_size_arr=array("30x30","32x32","40x40","50x50","60x60","70x70","85x85","100x100");
       
       foreach($button_size_arr as $key=>$val)
       {
       
        ?>   
        
        <div class="lbls radio-danger">
               		 <input type="radio" name="icon_size"  id="icon_size_<?php echo intval($key+1); ?>" value="<?php echo $val; ?>"<?php if($icon_size==$val) { echo ' checked="checked"'; };?> />
            	<label for="icon_size_<?php echo intval($key+1); ?>" class="css-label radGroup2"><?php echo $val; ?></label>
                </div>
                
       
        <?php } ?>     
       </div>
       <div class="main-bx1" style="float: none;">
               	<p>Display Style</p>
                
                <div class="lbls radio-danger">
               		 <input type="radio" name="display_style"  id="display_style_1"  value="0"<?php if($display_style=='0') { echo ' checked="checked"'; };?> />
            	<label for="display_style_1" class="css-label radGroup2">Horizontal</label>
                </div>
                
                <div class="lbls radio-danger">
               		 <input type="radio" name="display_style"  id="display_style_2"  value="1"<?php if($display_style=='1') { echo ' checked="checked"'; };?> />
            	<label for="display_style_2" class="css-label radGroup2">Vertical (Left)</label>
                </div>
                 <div class="lbls radio-danger">
               		 <input type="radio" name="display_style"  id="display_style_3"  value="2"<?php if($display_style=='2') { echo ' checked="checked"'; };?> />
            	<label for="display_style_3" class="css-label radGroup2">Vertical (Right)</label>
               </div>
        
      
      </div>
       <div class="main-bx1" style="float: none;">
               	<p>Padding Gap</p>
                
                <select name="gap" id="gap" >
                                    <?php for($i=0;$i<=20;$i++) { ?>
                                    <option value="<?php echo $i; ?>" <?php echo ($i==$gap)?"selected":"";?> ><?php echo $i; ?></option>
                                    <?php } ?>
                                    </select>px
                                    
                
       </div>
       
       
                                  
                                    <div class="btn">
            <input type="submit" id="button" name="save_share_2"  value="Save"  />
               	  
                </div>
       <div style="clear: both;">&nbsp;&nbsp;</div>
       
       
       
                     
                                                                  
      
     </div>
        

     <div style="tab8" style="display: none;">
	 
      
      <div class="main-bx1" style="float: none;">
               	<p>Counter Display</p>
                
                <div class="lbls radio-danger">
               		 <input type="radio" name="counter_type"  id="counter_type_1"  value="0"<?php if($counter_type=='0') { echo ' checked="checked"'; };?> />
            	<label for="counter_type_1" class="css-label radGroup2">Horizontal</label>
                </div>
                
                <div class="lbls radio-danger">
               		 <input type="radio" name="counter_type"  id="counter_type_2"  value="1"<?php if($counter_type=='1') { echo ' checked="checked"'; };?> />
            	<label for="counter_type_2" class="css-label radGroup2">Vertical</label>
                </div>
                 <div class="lbls radio-danger">
               		 <input type="radio" name="counter_type"  id="counter_type_3"  value="2"<?php if($counter_type=='2') { echo ' checked="checked"'; };?> />
            	<label for="counter_type_3" class="css-label radGroup2">No Counter</label>
               </div>
        
      
      </div>
	                                    <div class="btn">
            <input type="submit" id="button" name="save_share_3"  value="Save"  />
               	  
                </div>
                                  <div style="clear: both;">&nbsp;&nbsp;</div>  
      
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



<div id="tab1">
            <div class="box1 blue_bg api_step">
            	<h2 class="bov-title">
                	Step 1 - Create a SocleverSocial.com account
                </h2>              
              <div class="main-bx1">
               	<p>To get started, register your <span>Soclever Social account</span> and find your <span>API key</span> in the site settings. If you already have an account please log in.</p>
                <p><a href="https://www.socleversocial.com/register/?wpd=<?php echo base64_encode(get_site_url()); ?>" target="_blank" class="butn green">Get your FREE API Key</a>
                <a href="https://www.socleversocial.com/dashboard/" target="_blank" class="butn blue">Login</a></p>
                
              </div>
            </div>
           <form method="post" action="">
  <?php wp_nonce_field('update-options'); ?>
            <div class="box1 blue_bg api_step">
            	<h2 class="bov-title">
                	Step 2 - Enter your API Settings
                </h2>
                
              <div class="main-bx1">
               	<label>Client ID</label>
                <input type="text" placeholder="" name="client_id" class="input-txt">
                </div>
                <div class="main-bx1">
               	<label>API Key</label>
                <input type="text" placeholder="" name="api_key" class="input-txt">
                </div>
                <div class="main-bx1">
               	<label>API Secret</label>
                <input type="text" placeholder="" name="api_secret" class="input-txt">
                </div>
                <div class="main-bx1">
               	<label>Valid Domain</label>
                <input type="text" placeholder="" name="scss_domain" class="input-txt">
                </div>
               
                <div class="btn">
            <input type="submit" id="button" name="submit_share"  value="Submit"  />
               	  
                </div>
           	</div>
            </form>
            </div>

  
    
    
<?php    
}
 ?>
 <div class="box1 blue_bg">
            	<h2 class="bov-title">
                	Configuration
                </h2>
                <div class="main-bx1">
                	<p>1. <a class="sky" href="https://www.socleversocial.com/dashboard/" target="_blank">Login</a> to your SoClever account. Or <a class="sky" href="https://www.socleversocial.com/register/?wpd=<?php echo base64_encode(get_site_url()); ?>" target="_blank" >Register</a></span> for free account to generate API Keys.</p>
                    <p>2. Go to Site Settings . Your API key, API secret and site ID will be displayed on this page.</p>
                    <p>3. Configure your API details on API settings tab on your magento Admin Panel.</p>
                    <p>4. To be able to enable Social Login for your site, please create Social Apps on social networks. For more information on how to create Apps for your website please visit our help section on Social Network Set Up.</p>
                    <p>5. Please configure your Social Apps API details on SoClever Authorization page.</p>
                    <p>6. Once you configure Authorization Page, social network buttons will be unlocked to use at Login Settings Page. Please select social networks you want to use for social login and save settings.</p>
                    <p>7. Refresh your admin panel to configure button size, padding gap and buttons style.</p>
                    <p>8. Feel free to contact us for any assistance you may require.</p>
                </div>
                
           	</div>
            </div>
            <div class="sect-right">
        	<div class="orange">
            	<h2 class="sub-tit"><span>Support & FAQ</span></h2>
                <div class="orange">            	
                <div class="org-sub">
                <p><a href="http://developers.socleversocial.com/how-to-get-api-key-and-secret/" target="_blank">How to get Soclever API key and secret?</a></p>                
                <p><a href="https://www.socleversocial.com/about-us/" target="_blank">About Soclever</a></p>                
                <p><a href="http://developers.socleversocial.com/wordpress-social-sharing-buttons-instructions/" target="_blank">Wordpress Social Sharing Buttons instructions</a></p>                
                </div>
            </div>
            
            </div>
            
            
            <div class="reviews">
            	<h2><img src="<?php echo plugins_url('scss_css/review_heading_icon.png', __FILE__); ?>" alt="" /> We Love Reviews</h2>
                <div class="review_con">
                	<p><img src="<?php echo plugins_url('scss_css/review_star_img.png', __FILE__); ?>" alt=""/></p>
                    <p>Please click here to leave a review. </p>
                    <p><a href="https://wordpress.org/support/view/plugin-reviews/share-buttons-by-soclever" target="_blank">Rate Us</a></p>
                </div>
            </div>
        </div>
       
        
    </div>
</section>

<?php } ?>