<?php 
/*
Plugin Name: Share Buttons & Analytics By Soclever Social
Plugin URI: https://www.socleversocial.com/
Description: A simple and easy to use plugin that enables you to add share buttons to all of your posts and/or pages and get detailed report on our Soclever dashbaord.

Version: 1.0.1
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
        update_option('scss_button_style','1');
        update_option('scss_share_autho','1');
        update_option('scss_domain',''); 
        
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

 
if((isset($_POST['save_share_1']) && $_POST['save_share_1']=='Save' ) || (isset($_POST['save_share_2']) && $_POST['save_share_2']=='Save' ) || (isset($_POST['save_share_3']) && $_POST['save_share_3']=='Save' ) )
{
    
update_option('scss_display_position',stripslashes($_POST['scss_display_position']));
$social_buttons=""; $orders="";
$sorting_arry=$_POST['short_order'];
foreach($_POST['share_button'] as $key=>$val)
{
    $new_sorting_arr[$key]=$_POST['short_order'][$key];
}
asort($new_sorting_arr);
foreach($new_sorting_arr as $key=>$val)
{
    if(isset($_POST['share_button'][$key]))
    {
    $social_buttons .=",".$_POST['share_button'][$key];
    $orders .=",".$new_sorting_arr[$key];
    }
}

update_option('scss_button_orders',$orders);
update_option('scss_selected_buttons',$social_buttons);
update_option('scss_counter_type',$_POST['counter_type']);
update_option('scss_gap',$_POST['gap']);
update_option('scss_icon_size',$_POST['icon_size']);
update_option('scss_display_style',$_POST['display_style']);
update_option('scss_button_style',$_POST['button_style']);
update_option('scss_share_autho',$_POST['scss_share_autho']);

$js_written=file_get_contents('https://www.socleversocial.com/dashboard/write_js.php?site_id='.mysql_real_escape_string(get_option('scss_site_id')).'&save=Save&autho_share='.get_option('scss_share_autho').'');
      if($js_written=='1')
      {
        header("location:admin.php?page=soclever_share");
        exit;
        
           
      }

}
if(isset($_POST['submit_share']) && $_POST['submit_share']=='Submit' )
{
   
    
    $res_ponse_str=file_get_contents('https://www.socleversocial.com/dashboard/wp_activate.php?site_id='.mysql_real_escape_string($_POST['client_id']).'&api_key='.mysql_real_escape_string($_POST['api_key']).'&api_secret='.mysql_real_escape_string($_POST['api_secret']).'');
    $res_ponse=explode("~~",$res_ponse_str);
    if(mysql_real_escape_string($_POST['api_key'])==$res_ponse[0] && mysql_real_escape_string($_POST['api_secret'])==$res_ponse[1] && $res_ponse[0]!='0')
    {
        echo "<h2>Thanks for authentication. Redirecting now to setting page...</h2>";
        /*echo"<br/><h3>Preview</h3><br/>";
        echo htmlspecialchars_decode($res_ponse[2]);*/
        update_option("scss_valid_domain",'1');
        update_option("scss_site_id",mysql_real_escape_string($_POST['client_id']));
        update_option("scss_api_key",mysql_real_escape_string($_POST['api_key']));
        update_option("scss_api_secret",mysql_real_escape_string($_POST['api_secret']));
        update_option("scss_domain",mysql_real_escape_string($_POST['scss_domain']));
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
 wp_register_style( 'scss-style', plugins_url('scss_css/scss-style.css?ver='.time().'', __FILE__) );
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
    
$all_social_buttons=array("2","4","7","13","17");    
if(is_array($selected_buttons) && get_option('scss_selected_buttons')!='')
{
  $share_button=array_unique(array_merge($selected_buttons,$all_social_buttons), SORT_REGULAR);
    



}
else
{
    $share_button=array("2","4","7","13","17");
}
$share_button_title=array("2"=>"Facebook","4"=>"Google+","7"=>"LinkedIN","13"=>"Twitter","17"=>"Pinterest");
$counter_type=get_option('scss_counter_type');
$short_order=array("1","2","3","4","5");
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
<form class="login-form mt-lg" action="" method="post" name="authosharefrm" enctype="multipart/form-data">
<div class="tabber" style="width: 95% !important;">
     <div class="tabbertab">
	  <h2>Basic</h2>
      <table class="table" style="margin:20px;font-size:1em;">
	  <tr><th align="left">Select buttons & Display Sort Order</th></tr>
                                <tr>
                                    <td style="border: medium none;">
                                        <div style="text-align: right; border-bottom: 1px solid; margin-bottom: 5px;width: 180px;">
                                            <a href="javascript:void(0);" onclick="call_check_uncheck_all('all')">All</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="call_check_uncheck_all('none')">None</a>
                                        </div>
                                        <div id="social_list_div" style="width: 100%;">
                                            <?php $i=0;
                                            
                                            if(count($share_button)>0)
                                            {
                                                foreach($share_button as $key => $val)
                                                {
                                                    if($share_button_title[$val]!='')
                                                    {
                                                    $i++;
                                                     $odr=$i;
                                                     $left_margin="20%";
                                                     switch($val)
                                                     {
                                                        case '2':
                                                        $left_margin="18%";
                                                        break;
                                                        case '4':
                                                        $left_margin="21%";
                                                        break;
                                                        case '13':
                                                        $left_margin="24%";
                                                        break;
                                                        
                                                     }
                                                    ?>
                                                    <div style="margin-bottom: 5px;">
                                                        <input type="checkbox" name="share_button[<?php echo $i;?>]" id="share_button_<?php echo $i;?>" value="<?php echo $val;?>"  <?php if(is_array($selected_buttons) && in_array($val,$selected_buttons)) { ?> checked="checked"  <?php } ?> />&nbsp;&nbsp;<?php echo $share_button_title[$val];?>
                                                        <input type="text" style="width: 20px;margin-left:<?php echo $left_margin; ?>;"  name="short_order[<?php echo $odr;?>]" id="short_order_<?php echo $odr;?>" value="<?php echo $odr;?>" /> 
                                                    </div>
                                                    <?php 
                                                    }
                                                }
                                            }
                                             ?>
                                        </div>
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
                     <tr><th align="left">Share with authentication?</th></tr>
                                <tr>
                                    <td style="border: medium none;">
                                    <div><input type="radio" name="scss_share_autho" id="scss_share_autho_2" value="1"<?php if(get_option('scss_share_autho')=="1") { echo ' checked="checked"'; };?>  />&nbsp;&nbsp;No</div>
                                        <div><input type="radio" name="scss_share_autho" id="scss_share_autho_1" value="0"<?php if(get_option('scss_share_autho')=="0") { echo ' checked="checked"'; };?> />&nbsp;&nbsp;Yes</div>
                                        
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
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_2" value="1"<?php if($button_style=="1") { echo ' checked="checked"'; };?>  /><div style="margin-top: -26px;margin-left:20px;">&nbsp;&nbsp;<img src="https://www.socleversocial.com/dashboard/images/preview/style201.png" style="width:140px;" alt="Square Icons" title="Square Icons" /></div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_3" value="2"<?php if($button_style=="2") { echo ' checked="checked"'; };?>  /><div style="margin-top: -24px;margin-left:20px;">&nbsp;&nbsp;<img src="https://www.socleversocial.com/dashboard/images/preview/style202.png" style="width:140px;" alt="Rounded Icons" title="Rounded Icons" /></div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_4" value="3"<?php if($button_style=="3") { echo ' checked="checked"'; };?>  /><div style="margin-top: -20px;margin-left:20px;">&nbsp;&nbsp;<img src="https://www.socleversocial.com/dashboard/images/preview/style203.png" style="width:140px;" alt="Square Grey Icons" title="Square Grey Icons" /></div></div>
                                        <div><input type="radio" name="button_style" style="margin-top: 10px;" id="button_style_5" value="4"<?php if($button_style=="4") { echo ' checked="checked"'; };?>  /><div style="margin-top: -20px;margin-left:20px;">&nbsp;&nbsp;<img src="https://www.socleversocial.com/dashboard/images/preview/style204.png" style="width:140px;" alt="Rounded Grey Icons" title="Rounded Grey Icons"  /></div></div>
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