<?php
function cs_format_share_url($url,$source)
{
    
  $name = "scsource";                       
$value = $source;                          
 

$separator = "?";
if (strpos($url,"?")!==false)
  $separator = "&";
 

$insertPosition = strlen($url); 
if (strpos($url,"#")!==false)
  $insertPosition = strpos($url,"#");
 

$newUrl = substr_replace($url,"$separator$name=$value",$insertPosition,0);
   
 return $newUrl;   
}


function scsss_display($content)
{
    
      
   $sscc_share_content_position=get_option('scss_display_position');
        		
	$content_new = "";
                
                
                
                
               
      $fileContent="";
      $iwidth=explode("x",get_option('scss_icon_size'));
      $button_style=get_option('scss_button_style');
      $display_style=get_option('scss_display_style');
      $gap=get_option('scss_gap');
      $counter_type=get_option('scss_counter_type');
      $share_button=explode(",",get_option('scss_selected_buttons'));
      
      $js_code ='<script type="text/javascript" src="https://www.socleversocial.com/dashboard/client_share_js/client_'.get_option('scss_site_id').'_share_noautho.js?v='.time().'"></script>'.PHP_EOL.
'<script>'.PHP_EOL.
    'csauthosharebarjs.init([\''.get_option('scss_api_key').'\', \''.get_option('scss_site_id').'\',\''.get_option('scss_api_secret').'\',\''.get_option('scss_domain').'\']);'.PHP_EOL.
    'csauthosharebarjs.validateCsApi();'.PHP_EOL.
    '</script>'.PHP_EOL;
      
      
    if(get_option('scss_share_autho')=='1')
    {
     
     $cspageURL = 'http';
     if($_SERVER["HTTPS"] == "on") {$cspageURL .= "s";}
         $cspageURL .= "://";
         if ($_SERVER["SERVER_PORT"] != "80") {
         $cspageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
         } else {
         $cspageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
          }
       $url=$cspageURL;   
       $cspageTitle=get_the_title();        
       $title=$cspageTitle;
      
     $js_code .=    PHP_EOL;
     
     
    $vartical_top=$counter_position="";
    $main_div='height:'.$iwidth[0].'px';
    if($counter_type=='0' || $counter_type=='1')
    {
 
    $counter_position='.arrow_box:after, .arrow_box:before { top: 100%; left: 50%; border: solid transparent; content: " "; height: 0; width: 0; position: absolute; pointer-events: none; } .arrow_box:after { border-color: rgba(255, 255, 255, 0); border-top-color: #fff; border-width: 6px; margin-left: -6px; } .arrow_box:before { border-color: rgba(204, 204, 203, 0); border-top-color: #cccccb; border-width: 7px; margin-left: -7px; }';
    if($counter_type=='0')
    {
        $main_div='float:left;margin-top:0px;margin-left:8px;height:'.$iwidth[0].'px;margin-right:8px;';
        
        $counter_position='.arrow_box:after, .arrow_box:before { right: 100%; top: 50%; border: solid transparent; content: " "; height: 0; width: 0; position: absolute; pointer-events: none; } .arrow_box:after { border-color: rgba(255, 255, 255, 0); border-right-color: #fff; border-width: 6px; margin-top: -6px; } .arrow_box:before { border-color: rgba(204, 204, 203, 0); border-right-color: #cccccb; border-width: 7px; margin-top: -7px; }';
    }
    $js_code .='<style>'.PHP_EOL.
                '.arrow_box { width: '.($iwidth[0]-5).'px; margin-bottom:8px;'.$main_div.' border-radius: 1px; position: relative; background: #fff; border: 1px solid #cccccb; }'.$counter_position.''.PHP_EOL.    
                '</style>'.PHP_EOL;
    }
    $useragent=$_SERVER['HTTP_USER_AGENT'];
    $mobile_Display="display:none;";
    $comon_counter_start='<div class="arrow_box" ><div style="color:#000;font-weight:bold;position: relative;width: 100%;text-align: center;'.$counter_top_margin.'">';
    $comon_counter_start_18='<div class="arrow_box" style="display:none;"><div style="color:#000;font-weight:bold;position: relative;width: 100%;text-align: center;'.$counter_top_margin.'">';
    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
    {
        
        $mobile_Display="display:inline-block;";
        $comon_counter_start_18='<div class="arrow_box"><div style="color:#000;font-weight:bold;position: relative;width: 100%;text-align: center;'.$counter_top_margin.'">';
    }    
    $share_button_label=array("2"=>"facebook","4"=>"google_plus","7"=>"linkedin","13"=>"twitter","17"=>"pinterest","18"=>"whatsapp","19"=>"stumbleupon","20"=>"reddit");
    
    $src_arr=array();
    
    if($button_style=='custom')
    {
        
             $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.(get_option('scss_custom_facebook')!=''?get_option('scss_custom_facebook'):plugins_url('scss_css/',__FILE__).'square/facebook_square.png').'"';
      
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.(get_option('scss_custom_google_plus')!=''?get_option('scss_custom_google_plus'):plugins_url('scss_css/',__FILE__).'square/google_plus_square.png').'"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\''.(get_option('scss_custom_linkedin')!=''?get_option('scss_custom_linkedin'):plugins_url('scss_css/',__FILE__).'square/linkedin_square.png').'\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.(get_option('scss_custom_twitter')!=''?get_option('scss_custom_twitter'):plugins_url('scss_css/',__FILE__).'square/twitter_square.png').'"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.(get_option('scss_custom_pinterest')!=''?get_option('scss_custom_pinterest'):plugins_url('scss_css/',__FILE__).'square/pinterest_square.png').'"';
            $src_style18='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;'.$mobile_Display.'" src="'.(get_option('scss_custom_whatsapp')!=''?get_option('scss_custom_whatsapp'):plugins_url('scss_css/',__FILE__).'square/whatsapp_square.png').'"';
            $src_style19='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.(get_option('scss_custom_stumbleupon')!=''?get_option('scss_custom_stumbleupon'):plugins_url('scss_css/',__FILE__).'square/stumbleupon_square.png').'"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.(get_option('scss_custom_reddit')!=''?get_option('scss_custom_reddit'):plugins_url('scss_css/',__FILE__).'square/reddit_square.png').'"';
            $src_style21='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.(get_option('scss_custom_tumblr')!=''?get_option('scss_custom_tumblr'):plugins_url('scss_css/',__FILE__).'square/tumblr_square.png').'"';  
    }
    else
    {
    
        if($button_style=='1')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'square/facebook_square.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'square/google_plus_square.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\''.plugins_url('scss_css/',__FILE__).'square/linkedin_square.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'square/twitter_square.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'square/pinterest_square.png"';
            $src_style18='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;'.$mobile_Display.'" src="'.plugins_url('scss_css/',__FILE__).'square/whatsapp_square.png"';
            $src_style19='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'square/stumbleupon_square.png"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'square/reddit_square.png"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'square/tumblr_square.png"';
            
        }
        else if($button_style=='2')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded/facebook_rounded.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded/google_rounded.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\''.plugins_url('scss_css/',__FILE__).'rounded/linkedin_rounded.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded/twitter_rounded.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded/pinterest_rounded.png"';
            $src_style18='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;'.$mobile_Display.'" src="'.plugins_url('scss_css/',__FILE__).'rounded/whatsapp.png"';
            $src_style19='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded/stumbleupon_rounded.png"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded/reddit_rounded.png"';
            $src_style21='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded/tumblr_rounded.png"';
        }
       else if($button_style=='3')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey/facebook_grey.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey/google_grey.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\''.plugins_url('scss_css/',__FILE__).'grey/linkedin_grey.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey/twitter_grey.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey/pinterest_grey.png"';
            $src_style18='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;'.$mobile_Display.'" src="'.plugins_url('scss_css/',__FILE__).'grey/whatsapp_grey.png"';
            $src_style19='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey/stumbleupon_grey.png"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey/reddit_grey.png"';
            $src_style21='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey/tumblr_grey.png"';
        }
        else if($button_style=='4')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey_circle/facebook_grey_circle.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey_circle/google_plus_grey_circle.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\''.plugins_url('scss_css/',__FILE__).'grey_circle/linkedin_grey_circle.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey_circle/twitter_grey_circle.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey_circle/pinterest_grey_circle.png"';
            $src_style18='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;'.$mobile_Display.'" src="'.plugins_url('scss_css/',__FILE__).'grey_circle/whatsapp_grey_circle.png"';
            $src_style19='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey_circle/stumbleupon_grey_circle.png"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey_circle/reddit_grey_circle.png"';
            $src_style21='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'grey_circle/tumblr_grey_circle.png"';
        }
        else if($button_style=='5')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'flower/facebook_flower.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'flower/google_flower.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\''.plugins_url('scss_css/',__FILE__).'flower/linkedin_flower.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'flower/twitter_flower.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'flower/pinterest_flower.png"';
            $src_style18='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;'.$mobile_Display.'" src="'.plugins_url('scss_css/',__FILE__).'square/whatsapp_square.png"';
            $src_style19='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'flower/stumbleupon_flower.png"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'flower/reddit_flower.png"';
            $src_style21='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'flower/tumblr_flower.png"';
        }
        else if($button_style=='6')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'glossy/facebook_glossy.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'glossy/google_glossy.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\''.plugins_url('scss_css/',__FILE__).'glossy/linkedin_glossy.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'glossy/twitter_glossy.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'glossy/pinterest_glossy.png"';
            $src_style18='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;'.$mobile_Display.'" src="'.plugins_url('scss_css/',__FILE__).'square/whatsapp_square.png"';
            $src_style19='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'glossy/stumbleupon_glossy.png"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'glossy/reddit_glossy.png"';
            $src_style21='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'glossy/tumblr_glossy.png"';
        }
         else if($button_style=='7')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'leaf/facebook_leaf.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'leaf/google_leaf.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\''.plugins_url('scss_css/',__FILE__).'leaf/linkedin_leaf.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'leaf/twitter_leaf.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'leaf/pinterest_leaf.png"';
            $src_style18='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;'.$mobile_Display.'" src="'.plugins_url('scss_css/',__FILE__).'square/whatsapp_square.png"';
            $src_style19='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'leaf/stumbleupon_leaf.png"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'leaf/reddit_leaf.png"';
            $src_style21='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'leaf/tumblr_leaf.png"';
        }
         else if($button_style=='8')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'polygon/facebook_polygon.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'polygon/google_polygon.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\''.plugins_url('scss_css/',__FILE__).'polygon/linkedin_polygon.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'polygon/twitter_polygon.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'polygon/pinterest_polygon.png"';
            $src_style18='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;'.$mobile_Display.'" src="'.plugins_url('scss_css/',__FILE__).'square/whatsapp_square.png"';
            $src_style19='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'polygon/stumbleupon_polygon.png"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'polygon/reddit_polygon.png"';
            $src_style21='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'polygon/tumblr_polygon.png"';
        }
        else if($button_style=='9')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rectangular/facebook_rectangular.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rectangular/google_rectangular.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\''.plugins_url('scss_css/',__FILE__).'rectangular/linkedin_rectangular.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rectangular/twitter_rectangular.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rectangular/pinterest_rectangular.png"';
            $src_style18='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;'.$mobile_Display.'" src="'.plugins_url('scss_css/',__FILE__).'square/whatsapp_square.png"';
            $src_style19='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rectangular/stumbleupon_rectangular.png"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rectangular/reddit_rectangular.png"';
            $src_style21='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rectangular/tumblr_rectangular.png"';
        }
        else if($button_style=='10')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded_corners/facebook_rounded_corners.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded_corners/google_rounded_corners.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\''.plugins_url('scss_css/',__FILE__).'rounded_corners/linkedin_rounded_corners.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded_corners/twitter_rounded_corners.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded_corners/pinterest_rounded_corners.png"';
            $src_style18='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;'.$mobile_Display.'" src="'.plugins_url('scss_css/',__FILE__).'square/whatsapp_square.png"';
            $src_style19='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded_corners/stumbleupon_rounded_corners.png"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded_corners/reddit_rounded_corners.png"';
            $src_style21='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'rounded_corners/tumblr_rounded_corners.png"';
        }
        else if($button_style=='11')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'waterdrop/facebook_waterdrop.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'waterdrop/google_waterdrop.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\''.plugins_url('scss_css/',__FILE__).'waterdrop/linkedin_waterdrop.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'waterdrop/twitter_waterdrop.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'waterdrop/pinterest_waterdrop.png"';
            $src_style18='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;'.$mobile_Display.'" src="'.plugins_url('scss_css/',__FILE__).'square/whatsapp_square.png"';
            $src_style19='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'waterdrop/stumbleupon_waterdrop.png"';
            $src_style20='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'waterdrop/reddit_waterdrop.png"';
            $src_style21='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="'.plugins_url('scss_css/',__FILE__).'waterdrop/tumblr_waterdrop.png"';
        }
        
        }
        
        if($display_style=='1')
        {
            $gap_string='<div style=\'float:left;height:'.$gap.'px;\'>&nbsp;</div>';
        }
        else
        {
            $gap_string='<div style=\'float:left;width:'.$gap.'px;\'>&nbsp;</div>';
        }
      
        
    if($counter_type=='0' || $counter_type=='1')
    {
         
         
      $counter_top_margin='';
    if($counter_type=='0')
    {
        $counter_top_margin='margin-top:'.intval($iwidth[0]/4).'px;';
     }
    $other_count=get_csscurl("https://www.socleversocial.com/dashboard/get_other_counts.php?site_id=".sanitize_text_field(get_option('scss_site_id'))."&url=".$url."");
    $row_count=explode("~",$other_count);
    $comon_counter_end='</div></div>';
    $count2=$count4=$count7=$count13=$count17=$count18=$count19=$count20="";
    $count2r=$count2=''.$comon_counter_start.''.intval($row_count[4]).''.$comon_counter_end.'';
    $count4r=$count4=''.$comon_counter_start.''.intval($row_count[6]).''.$comon_counter_end.'';
    $count7r=$count7=''.$comon_counter_start.''.intval($row_count[5]).''.$comon_counter_end.'';
    $count13r=$count13=''.$comon_counter_start.''.intval($row_count[7]).''.$comon_counter_end.'';
    $count17r=$count17=''.$comon_counter_start.''.intval($row_count[8]).''.$comon_counter_end.'';
    $count18r=$count18=''.$comon_counter_start_18.''.intval($row_count[0]).''.$comon_counter_end.'';
    $count19r=$count19=''.$comon_counter_start.''.intval($row_count[1]).''.$comon_counter_end.'';
    $count20r=$count20=''.$comon_counter_start.''.intval($row_count[2]).''.$comon_counter_end.'';
    $count21r=$count21=''.$comon_counter_start.''.intval($row_count[3]).''.$comon_counter_end.'';
    }
    if($counter_type=='0')
    {
        $count2=$count4=$count7=$count13=$count17=$count18=$count19=$count20="";
    } 
    else
    {
        $count2r=$count4r=$count7r=$count13r=$count17r=$count18r=$count19r=$count20r="";
    }   
    $user_ID = get_current_user_id();
       
    $share_arr[2]='<div style="float:left;">'.$count2.'<img '.$src_style2.' onclick="share_on_cs(\'1\',\''.sanitize_text_field($user_ID).'\');window.open(\'http://www.facebook.com/sharer.php?u='.urlencode(cs_format_share_url($url,'1')).'&t='.urlencode($title).'\',\'_new\');"  alt="Share on Facebook"  ></div>'.$count2r.''.$gap_string.'';         
    $share_arr[4]='<div style=\'float:left;\'>'.$count4.'<img  '.$src_style4.' onclick="share_on_cs(\'3\',\''.sanitize_text_field($user_ID).'\');window.open(\'https://plus.google.com/share?url='.urlencode(cs_format_share_url($url,'3')).'&title='.urlencode($title).'\',\'_new\');"   alt="Share on Google+"></div>'.$count4r.''.$gap_string.'';        
    $share_arr[7]='<div style=\'float:left;\'>'.$count7.'<img '.$src_style7.' onclick="share_on_cs(\'2\',\''.sanitize_text_field($user_ID).'\');window.open(\'https://www.linkedin.com/cws/share?url='.urlencode(cs_format_share_url($url,'2')).'&title='.urlencode($title).'\',\'_new\');" alt="Share on LinkedIN" ></div>'.$count7r.''.$gap_string.'';        
    $share_arr[13]='<div style=\'float:left;\'>'.$count13.'<img  '.$src_style13.' onclick="share_on_cs(\'4\',\''.sanitize_text_field($user_ID).'\');window.open(\'http://twitter.com/share?url='.urlencode(cs_format_share_url($url,'4')).'&text='.urlencode($title).'\',\'_new\');"  alt="Share on Twitter"></div>'.$count13r.''.$gap_string.'';
    $share_arr[17]='<div style=\'float:left;\'>'.$count17.'<img  '.$src_style17.' onclick="share_on_cs(\'5\',\''.sanitize_text_field($user_ID).'\');"   alt="Pin It"></div>'.$count17r.''.$gap_string.'';
    $share_arr[18]='<div style=\'float:left;\'>'.$count18.'<img  '.$src_style18.' onclick="share_on_cs(\'6\',\''.sanitize_text_field($user_ID).'\');"   alt="Share on Whatsapp"></div>'.$count18r.''.$gap_string.'';
    $share_arr[19]='<div style=\'float:left;\'>'.$count19.'<img  '.$src_style19.' onclick="share_on_cs(\'7\',\''.sanitize_text_field($user_ID).'\');window.open(\'http://www.stumbleupon.com/submit?url='.urlencode(cs_format_share_url($url,'7')).'&title='.urlencode($title).'\',\'_new\');"   alt="Share on StumbleUpon"></div>'.$count19r.''.$gap_string.'';
    $share_arr[20]='<div style=\'float:left;\'>'.$count20.'<img  '.$src_style20.' onclick="share_on_cs(\'8\',\''.sanitize_text_field($user_ID).'\');window.open(\'http://www.reddit.com/submit?url='.urlencode(cs_format_share_url($url,'8')).'&title='.urlencode($title).'\',\'_new\');"   alt="Share on Reddit"></div>'.$count20r.''.$gap_string.'';
    $share_arr[21]='<div style=\'float:left;\'>'.$count21.'<img  '.$src_style21.' onclick="share_on_cs(\'9\',\''.sanitize_text_field($user_ID).'\');window.open(\'http://www.tumblr.com/share/link?url='.urlencode(cs_format_share_url($url,'9')).'&name='.urlencode($title).'&description='.urlencode($csDescription).'\',\'_new\');"   alt="Share on Reddit"></div>'.$count21r.''.$gap_string.'';
    
    
    $start_div='<div id="scssdiv" style="clear:both;wdth:100%;height:100%;display:inline-block;z-index:999;">';
    $end_div='</div>';
if($display_style=='1' || $display_style=='2' )
{
    
    $left_right=($display_style=='2')?'right:0;':'left:0;';
    $multiplier_div=($counter_type=='0')?'2':'1';
    $add_extra=($counter_type=='0')?'20':'0';
    $start_div='<div id="scssdiv" style="width:'.intval(($iwidth[0]*$multiplier_div)+$add_extra).'px;position:fixed;top:30%;'.$left_right.'display:inline-block;height:100%;z-index:999;">';
    $end_div='</div>';
}

    
    $js_code .=    PHP_EOL;
    $js_code .=$start_div;
        foreach($share_button as $key=>$val)
        {
            
               $js_code .=$share_arr[$val];
        }
        $js_code .=$end_div;
$show_content=0;
	if($show_content=='0' && (!is_home()  && is_page() && get_option('scss_show_page') == '1') )
    {
        $show_content=1;
    }
    else if($show_content=='0' && (is_single() && get_option('scss_show_post')== '1') )
    {
        $show_content=1;
    }	
    else if($show_content=='0' && (is_category() && get_option('scss_show_category') == '1'))
    {
        $show_content=1;
    }
    else if($show_content=='0' && (is_archive() && get_option('scss_show_category') == '1'))
    {
        $show_content=1;
    }		
    else if( $show_content=='0' && ( is_home() && get_option('scss_show_homepage') == '1'))
    {
        $show_content=1;
    }
    
    
	 //var_dump((is_category() && get_option('scss_show_category') == '1')."==".(is_archive() && get_option('scss_show_category') == '1')."==".( is_home() && get_option('scss_show_homepage') == '1'));
     

     if ($show_content=='1')
      {
        
        
        

        
        
        
        if($sscc_share_content_position=='top')
					{
						$content_new .=$js_code;
						$content_new .=$content;
					}
				elseif($sscc_share_content_position=='bottom')
					{	
						$content_new .=$content;
						$content_new .=$js_code;
						
					}
			         elseif($sscc_share_content_position=='both')
					{	
					    $content_new .=$js_code;
						$content_new .=$content;
						$content_new .=$js_code;
						
					}
                    return $content_new;
     
        }
        else
        {
           
            return $content;
        }
        
     }
     	
		
	}

add_filter('the_content', 'scsss_display');

if(get_option('scss_show_excerpts')=='1')
 {
		
		
		add_filter( 'the_excerpt', 'scsss_display');
}

?>