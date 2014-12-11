<?php
function get_plusones($url)  {
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode($url).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
$curl_results = curl_exec ($curl);
curl_close ($curl);
$json = json_decode($curl_results, true);
return isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
}

function scsss_display($content)
{
      
  	            $sscc_share_content_position=get_option('scss_display_position');
       		
				$content_new = "";
                $gplus_app_id=file_get_contents('https://www.socleversocial.com/dashboard/wp_js.php?action=get_gp&site_id='.esc_sql(get_option('scss_site_id')).'&api_key='.esc_sql(get_option('scss_api_key')).'&api_secret='.esc_sql(get_option('scss_api_secret')).'');
                
                //$js_code=file_get_contents('https://www.socleversocial.com/dashboard/wp_js.php?site_id='.esc_sql(get_option('scss_site_id')).'&api_key='.esc_sql(get_option('scss_api_key')).'&api_secret='.esc_sql(get_option('scss_api_secret')).'');
                
               
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
        if($button_style=='1')
        {
            /*$src_style2='src="\'+sitepath+\'img/social_icon/'.$icon_size.'/'.$icon_size.'_facebook.png"';
            $src_style4="src=\"'+sitepath+'img/social_icon/".$icon_size."/".$icon_size."_google_plus.png\"";
            $src_style7='src=\'"+sitepath+"img/social_icon/'.$icon_size.'/'.$icon_size.'_linkedin.png\'';
            $src_style13="src=\"'+sitepath+'img/social_icon/".$icon_size."/".$icon_size."_twitter.png\"";*/
            
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/facebook_square.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/google_plus_square.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\'https://www.socleversocial.com/dashboard/img/social_icon/rounded/linkedin_square.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/twitter_square.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/pinterest_square.png"';
            
        }
        else if($button_style=='2')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/facebook.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/google_plus.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\'https://www.socleversocial.com/dashboard/img/social_icon/rounded/linkedin.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/twitter.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/pinterest.png"';
        }
       else if($button_style=='3')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/facebook_grey.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/google_plus_grey.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\'https://www.socleversocial.com/dashboard/img/social_icon/rounded/linkedin_grey.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/twitter_grey.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/pinterest_grey.png"';
        }
        else if($button_style=='4')
        {
            $src_style2='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/facebook_grey_circle.png"';
            $src_style4='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/google_plus_grey_circle.png"';
            $src_style7='style=\'width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;\' src=\'https://www.socleversocial.com/dashboard/img/social_icon/rounded/linkedin_grey_circle.png\'';
            $src_style13='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/twitter_grey_circle.png"';
            $src_style17='style="width:'.$iwidth[0].'px;height:'.$iwidth[0].'px;cursor:pointer;" src="https://www.socleversocial.com/dashboard/img/social_icon/rounded/pinterest_grey_circle.png"';
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
         $url=get_permalink(get_the_ID());
         $fb=json_decode(file_get_contents("http://graph.facebook.com/?id=".$url.""));
         $tw=json_decode(file_get_contents("http://cdn.api.twitter.com/1/urls/count.json?url=".$url.""));
         $li=json_decode(file_get_contents("http://www.linkedin.com/countserv/count/share?url=".$url."&format=json"));         
         $pin_count=file_get_contents("http://api.pinterest.com/v1/urls/count.json?url=".$url."");

         $str=substr(substr($pin_count,0,-1),13);
         $pin_arr=json_decode($str);
        
         
        
         
            $args = array(
	            'method' => 'POST',
	            'headers' => array(
	                // setup content type to JSON 
	                'Content-Type' => 'application/json'
	            ),
	            // setup POST options to Google API
	            'body' => json_encode(array(
	                'method' => 'pos.plusones.get',
	                'id' => 'p',
	                'method' => 'pos.plusones.get',
	                'jsonrpc' => '2.0',
	                'key' => 'p',
	                'apiVersion' => 'v1',
	                'params' => array(
	                    'nolog'=>true,
	                    'id'=>$url,
	                    'source'=>'widget',
	                    'userId'=>'@viewer',
	                    'groupId'=>'@self'
	                ) 
	             )),
	             // disable checking SSL sertificates               
	            'sslverify'=>false
	        );
        
        $json_string = wp_remote_post("https://clients6.google.com/rpc", $args);
        $json = json_decode($json_string['body'], true);                    
	        // return count of Google +1 for requsted URL
	        $count = intval( $json['result']['metadata']['globalCounts']['count'] );
      $fb_shares="FB Shares=".$fb->shares."==Googleplus==".$count."==Twitter=".$tw->count."===Linked==".$li->count."==Pinterest==".$pin_arr->count;
      $counter_top_margin='';
    if($counter_type=='0')
    {
        $counter_top_margin='margin-top:'.intval($iwidth[0]/4).'px;';
     }   
    $comon_counter_start='<div class="arrow_box"><div style="color:#000;font-weight:bold;position: relative;width: 100%;text-align: center;'.$counter_top_margin.'">';
    $comon_counter_end='</div></div>';
    $count2=$count4=$count7=$count13=$count17="";
    $count2r=$count2=''.$comon_counter_start.''.intval($fb->shares).''.$comon_counter_end.'';
    $count4r=$count4=''.$comon_counter_start.''.intval($count).''.$comon_counter_end.'';
    $count7r=$count7=''.$comon_counter_start.''.intval($tw->count).''.$comon_counter_end.'';
    $count13r=$count13=''.$comon_counter_start.''.intval($li->count).''.$comon_counter_end.'';
    $count17r=$count17=''.$comon_counter_start.''.intval($pin_arr->count).''.$comon_counter_end.'';
    }
    if($counter_type=='0')
    {
        $count2=$count4=$count7=$count13=$count17="";
    } 
    else
    {
        $count2r=$count4r=$count7r=$count13r=$count17r="";
    }   
    if(get_option('scss_share_autho')=='1')
    {
    $share_arr[2]='<div style="float:left;">'.$count2.'<img '.$src_style2.' onclick="share_on_cs(\'1\');"  alt="Share on Facebook"  ></div>'.$count2r.''.$gap_string.'';         
    $share_arr[4]='<div style=\'float:left;\'>'.$count4.'<img  '.$src_style4.' onclick="share_on_cs(\'3\');"   alt="Share on Google+"></div>'.$count4r.''.$gap_string.'';        
    $share_arr[7]='<div style=\'float:left;\'>'.$count7.'<img '.$src_style7.' onclick="share_on_cs(\'2\');" alt="Share on LinkedIN" ></div>'.$count7r.''.$gap_string.'';        
    $share_arr[13]='<div style=\'float:left;\'>'.$count13.'<img  '.$src_style13.' onclick="share_on_cs(\'4\');"  alt="Share on Twitter"></div>'.$count13r.''.$gap_string.'';
    $share_arr[17]='<div style=\'float:left;\'>'.$count17.'<img  '.$src_style17.' onclick="share_on_cs(\'5\');"   alt="Pin It"></div>'.$count17r.''.$gap_string.'';
    }
    else
    {
        $share_arr[2]='<div style="float:left;"><img '.$src_style2.' onclick="csfblogin()"   ></div>'.$gap_string.'';         
         //$share_arr[4]='<div style="float:left;"><img  '.$src_style4.' onclick="gapi.auth.signIn({\'clientid\' : \''.$gplus_app_id.'\',\'callback\': signinCallback,\'cookiepolicy\':\'single_host_origin\',\'approvalprompt\':\'force\',\'access_type\':\'online\'});"  alt="Share on Google"></div>'.$gap_string.'';
         $share_arr[4]='<div style="float:left;"><img  '.$src_style4.' onclick=track_pi_share(document.URL,\'4\')  alt="Share on Google"></div>'.$gap_string.'';        
         $share_arr[7]='<div style="float:left;"><img '.$src_style7.' id=\'cslinkedin\' onclick=\'OnLinkedInFrameworkLoad();\'></div>'.$gap_string.'';        
         $share_arr[13]='<div style="float:left;"><img  '.$src_style13.' onclick=window.open(\'https://www.socleversocial.com/dashboard/to/redirect.php?site_id='.get_option('scss_site_id').'&is_share=1&su=\'+encodeURIComponent(document.URL)+\'&sm=\'+encodeURIComponent(document.title),"Share","width=500,height=300")  alt="Share on Twitter"></div>'.$gap_string.'';
         $share_arr[17]='<div style="float:left;"><img  '.$src_style17.' onclick=track_pi_share(document.URL,\'5\')  alt="Pin It"></div>';
         
    }
    $start_div='<div id="scssdiv" style="clear:both;display:inline-block;">';
    $end_div='</div>';
if(get_option('scss_display_style')=='1' || get_option('scss_display_style')=='2' )
{
    
    $left_right=(get_option('scss_display_style')=='2')?'right:0;':'left:0;';
    $multiplier_div=($counter_type=='0')?'2':'1';
    $add_extra=($counter_type=='0')?'20':'0';
    $start_div='<div id="scssdiv" style="width:'.intval(($iwidth[0]*$multiplier_div)+$add_extra).'px;position:fixed;top:30%;'.$left_right.'display:inline-block;height:100%;">';
    $end_div='</div>';
}

    
    $js_code .=    PHP_EOL;
    $js_code .=$start_div;
        foreach($share_button as $key=>$val)
        {
            
               $js_code .=$share_arr[$val];
        }
        $js_code .=$end_div;

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
						
	     
         
             $fb_shares="";
           
	    return $content_new;
		
		
	}

add_filter('the_content', 'scsss_display');
?>