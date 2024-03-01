<?php 
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
 

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if( mysqli_connect_error()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$GLOBALS['conn'] = $conn;

mysqli_set_charset($conn, 'utf8');
mysqli_query($conn,'set names utf8');
 
$table_prefix =  "swk_";
 

function get_Post_Info($inputdata) {

    
    $conn = $GLOBALS['conn']; 
    $table_prefix =  "swk_";

	$sql = "SELECT ID FROM `".$table_prefix."posts` WHERE `post_title`='".$inputdata."'";
 
    $query = mysqli_query($conn, $sql);

    $data = mysqli_fetch_array($query);
    
    return $data[0];
	 
}

function insert_Trp_Original_Strings($inputdata) {
    
    $conn = $GLOBALS['conn']; 
    $table_prefix =  "swk_";

	$sql = "INSERT INTO `".$table_prefix."trp_original_strings` (`original`) 
           VALUES ('".addslashes($inputdata)."') ";
 
    $query = mysqli_query($conn, $sql);
 
    $data = mysqli_insert_id($conn);

    return $data;
	 
}

function insert_Trp_Original_Meta($inputdata1,$inputdata2,$inputdata3) {
    
    $conn = $GLOBALS['conn']; 
    $table_prefix =  "swk_";

	$sql = "INSERT INTO `".$table_prefix."trp_original_meta` (`original_id`,`meta_key`,`meta_value`) 
           VALUES ('".$inputdata1."','".$inputdata2."','".$inputdata3."') ";
 
    $query = mysqli_query($conn, $sql);
 
    $data = mysqli_insert_id($conn);

    return $data;
	 
}


function insert_Trp_Dictionary($inputdata1,$inputdata2,$inputdata3,$tabledata) {
    
    $conn = $GLOBALS['conn']; 
    $table_prefix =  "swk_";
    
    $exp_array=array('youtube','linkedin','facebook','twitter');
    if (in_array(strtolower($inputdata1), $exp_array)) {  $inputdata2 = $inputdata1; } 

	$sql = "INSERT INTO `".$table_prefix.$tabledata."` (`original`,`translated`,`status`,`block_type`,`original_id`) 
           VALUES ('".addslashes($inputdata1)."','".addslashes($inputdata2)."',2,0,'".$inputdata3."') ";
 
    $query = mysqli_query($conn, $sql);
 
    $data = mysqli_insert_id($conn);

    return $data;
	 
}

function searchForId($id, $array) {
    foreach ($array as $key => $val) {
        if ($val['uid'] === $id) {
            return $key;
        }
    }
    return null;
 }

 function extract_tags( $html, $tag, $selfclosing = null, $return_the_entire_tag = false, $charset = 'ISO-8859-1' ){
     
    if ( is_array($tag) ){
        $tag = implode('|', $tag);
    }
     
    //If the user didn't specify if $tag is a self-closing tag we try to auto-detect it
    //by checking against a list of known self-closing tags.
    $selfclosing_tags = array( 'area', 'base', 'basefont', 'br', 'hr', 'input', 'img', 'link', 'meta', 'col', 'param' );
    if ( is_null($selfclosing) ){
        $selfclosing = in_array( $tag, $selfclosing_tags );
    }
     
    //The regexp is different for normal and self-closing tags because I can't figure out 
    //how to make a sufficiently robust unified one.
    if ( $selfclosing ){
        $tag_pattern = 
            '@<(?P<tag>'.$tag.')           # <tag
            (?P<attributes>\s[^>]+)?       # attributes, if any
            \s*/?>                   # /> or just >, being lenient here 
            @xsi';
    } else {
        $tag_pattern = 
            '@<(?P<tag>'.$tag.')           # <tag
            (?P<attributes>\s[^>]+)?       # attributes, if any
            \s*>                 # >
            (?P<contents>.*?)         # tag contents
            </(?P=tag)>               # the closing </tag>
            @xsi';
    }
     
    $attribute_pattern = 
        '@
        (?P<name>\w+)                         # attribute name
        \s*=\s*
        (
            (?P<quote>[\"\'])(?P<value_quoted>.*?)(?P=quote)    # a quoted value
            |                           # or
            (?P<value_unquoted>[^\s"\']+?)(?:\s+|$)           # an unquoted value (terminated by whitespace or EOF) 
        )
        @xsi';
 
    //Find all tags 
    if ( !preg_match_all($tag_pattern, $html, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE ) ){
        //Return an empty array if we didn't find anything
        return array();
    }
     
    $tags = array();
    foreach ($matches as $match){
         
        //Parse tag attributes, if any
        $attributes = array();
        if ( !empty($match['attributes'][0]) ){ 
             
            if ( preg_match_all( $attribute_pattern, $match['attributes'][0], $attribute_data, PREG_SET_ORDER ) ){
                //Turn the attribute data into a name->value array
                foreach($attribute_data as $attr){
                    if( !empty($attr['value_quoted']) ){
                        $value = $attr['value_quoted'];
                    } else if( !empty($attr['value_unquoted']) ){
                        $value = $attr['value_unquoted'];
                    } else {
                        $value = '';
                    }
                     
                    //Passing the value through html_entity_decode is handy when you want
                    //to extract link URLs or something like that. You might want to remove
                    //or modify this call if it doesn't fit your situation.
                    $value = html_entity_decode( $value, ENT_QUOTES, $charset );
                     
                    $attributes[$attr['name']] = $value;
                }
            }
             
        }
         
        $tag = array(
            'tag_name' => $match['tag'][0],
            'offset' => $match[0][1], 
            'contents' => !empty($match['contents'])?$match['contents'][0]:'', //empty for self-closing tags
            'attributes' => $attributes, 
        );
        if ( $return_the_entire_tag ){
            $tag['full_tag'] = $match[0][0];            
        }
          
        $tags[] = $tag;
    }
     
    return $tags;
}
 					

 function extract_page($text){

            $en_text_array = array();
            $html_array = array();
            $html = $text;
            $nodes = extract_tags( $html, 'p|li|div' );
            $nodes = array_filter($nodes);
            foreach($nodes as $link){
                if($link['contents']!='&nbsp;'){
                    $html_array[] = $link['contents'];
                }            
            }
            /*
            echo "<hr/>";
            print_r($html_array);
            echo "<hr/>";
            */
            $new_html_array = array();
            for ($i = 0; $i < sizeof($html_array); $i++) {    
                $new_html = $html_array[$i];
                $new_nodes = explode("<br />&nbsp;<br />",$new_html);               
                $new_nodes = array_filter($new_nodes);
                foreach($new_nodes as $new_link){
                    if($new_link!='&nbsp;'){
                        $new_html_array[] = $new_link;
                    }            
                }
            }
            /*
            echo "<hr/>";
            print_r($new_html_array);
            echo "<hr/>";
            */
            
            $last_html_array = array();
            for ($j = 0; $j < sizeof($new_html_array); $j++) {      
                $last_html = $new_html_array[$j];
                $last_nodes = explode("<br />",$last_html);               
                $last_nodes = array_filter($last_nodes);
                foreach($last_nodes as $last_link){
                    if($last_link!='&nbsp;'){
                        $last_html_array[] = $last_link;
                    }            
                }
            }
            /*
            echo "<hr/>";
            print_r($last_html_array);
            echo "<hr/>";
            */

            
            $final_html_array = array();
            for ($k = 0; $k < sizeof($last_html_array); $k++) {      
                $final_html = $last_html_array[$k];
                $final_nodes = extract_tags( $final_html, 'a' );
                $final_nodes = array_filter($final_nodes);
                if(count($final_nodes)>0){
                    foreach($final_nodes as $final_link){
                        if($final_link['contents']!='&nbsp;'){
                            $final_html_exp = explode($final_link['contents'],strip_tags($final_html));    
                            if($final_html_exp[0]){
                                if(strip_tags($final_html_exp[0])!='&nbsp;'){
                                    $final_html_array[] = strip_tags($final_html_exp[0]);
                                }
                            }
                            if(strip_tags($final_link['contents'])!='&nbsp;'){
                                 $final_html_array[] = strip_tags($final_link['contents']);
                             }
                            if($final_html_exp[1]){
                                if(strip_tags($final_html_exp[1])!='&nbsp;'){
                                $final_html_array[] = strip_tags($final_html_exp[1]);
                                }
                            }
                        }       
                    }     

                } else {
                    if(strip_tags($final_html)!='&nbsp;'){
                    $final_html_array[] = strip_tags($final_html);
                    }
                }
            }
            
            //echo "<hr/>";
            //print_r($final_html_array);
            //echo "<hr/>";
            for ($k = 0; $k < sizeof($final_html_array); $k++) {   
            //echo $k." > ".$final_html_array[$k]."<hr/>";
            //echo trim($final_html_array[$k],"&nbsp;");
            //$final_html_arrayTrimValue = trim($final_html_array[$k],"&nbsp;");
            //$final_html_arrayTrimValue = trim($final_html_array[$k]);
            $final_html_arrayTrimValue = trim(html_entity_decode($final_html_array[$k]), " \t\n\r\0\x0B\xC2\xA0");
            $final_html_arrayTrimValue = htmlentities($final_html_arrayTrimValue);
            //$final_html_arrayValue = str_replace('&rdquo','&rdquo;',$final_html_arrayTrimValue);
            $final_html_arrayValue = $final_html_arrayTrimValue;
            $final_html_arrayValue = str_replace('’','&rsquo;',$final_html_arrayValue);
            $final_html_arrayValue = str_replace("'","&#8217;",$final_html_arrayValue);
            $final_html_arrayValue = str_replace('&quot;','&#8221;',$final_html_arrayValue);
            //$en_text_array[] = trim($final_html_array[$k],"&nbsp;");
            if(trim($final_html_arrayValue)!="") { 
                echo "<hr/>|".$final_html_arrayValue."|<hr/>";
                $en_text_array[] = $final_html_arrayValue;
            }
            
            //echo "<br/>";
            }
            //echo "<hr/>";   
                
    return $en_text_array;        
 }


 /* Process Start Here */

    $en_Full_Array = array();
    $en_Array = array();
    /*
    $CSVfp = fopen("gxo-europe-news.csv", "r");
    $CSVfp = fopen("gxo_sample_news.csv", "r");
    */
    $CSVfp = fopen("gxo-europe-news.csv", "r");
    
    if($CSVfp !== FALSE) {
    $i=0;
    while(! feof($CSVfp)) {
    $data = fgetcsv($CSVfp, 1000, ",");
    if($data[0]!='id'){
      
        $en_Full_Array[$data[0]][$i]['id'] = $data[0];
        $en_Full_Array[$data[0]][$i]['locale'] = $data[1];
        $en_Full_Array[$data[0]][$i]['title'] = $data[3];
        $en_Full_Array[$data[0]][$i]['article'] = $data[6];
        $i++;            
        if($data[1]=='en') {
            $en_Array[] = $data[0];
        }
    }
    
    }
    }
    fclose($CSVfp);
  
    /*
    $lc=0;
    foreach($en_Array as $en_Array_Value){
        $firstKey = array_key_first($en_Full_Array[$en_Array_Value]);
    //Load the HTML page
    $html = $en_Full_Array[$en_Array_Value][$firstKey]['article'];;

    //echo "<hr/>".$html."<hr/>";
    }
    echo "<hr/>".$html."<hr/>";
    
    $nodes = extract_tags( $html, 'p' );
    foreach($nodes as $link){
        $html_value = $link['contents'];
        $explode_array = explode("<br />&nbsp;<br />",$html_value);
        echo "<hr/>";
        print_r($explode_array);
        echo "<hr/>";
    }
    */
  

    
    $lc=0;
    foreach($en_Array as $en_Array_Value){
        $firstKey = array_key_first($en_Full_Array[$en_Array_Value]);

        echo "<hr/>";
        echo "TITLE: ";
        echo $title=$en_Full_Array[$en_Array_Value][$firstKey]['title'];
        echo "<hr/>";
        
        $postID = get_Post_Info($title);
        echo "<hr/>";
        echo "POSTID: ".$postID;
        echo "<hr/>";
        $text=$en_Full_Array[$en_Array_Value][$firstKey]['article'];
        if($postID){
            //echo "<hr/>";
            //echo $text;
            //echo "<hr/>";

            /*
            $en_text_array = array();
            $html_array = array();
            $html = $text;
            $nodes = extract_tags( $html, 'p' );
            $nodes = array_filter($nodes);
            foreach($nodes as $link){
                if($link['contents']!='&nbsp;'){
                    $html_array[] = $link['contents'];
                }            
            } 

            $new_html_array = array();
            for ($i = 0; $i < sizeof($html_array); $i++) {    
                $new_html = $html_array[$i];
                $new_nodes = explode("<br />&nbsp;<br />",$new_html);               
                $new_nodes = array_filter($new_nodes);
                foreach($new_nodes as $new_link){
                    if($new_link!='&nbsp;'){
                        $new_html_array[] = $new_link;
                    }            
                }
            }
             
            $last_html_array = array();
            for ($j = 0; $j < sizeof($new_html_array); $j++) {      
                $last_html = $new_html_array[$j];
                $last_nodes = explode("<br />",$last_html);               
                $last_nodes = array_filter($last_nodes);
                foreach($last_nodes as $last_link){
                    if($last_link!='&nbsp;'){
                        $last_html_array[] = $last_link;
                    }            
                }
            }
             
            $final_html_array = array();
            for ($k = 0; $k < sizeof($last_html_array); $k++) {      
                $final_html = $last_html_array[$k];
                $final_nodes = extract_tags( $final_html, 'a' );
                $final_nodes = array_filter($final_nodes);
                if(count($final_nodes)>0){
                    foreach($final_nodes as $final_link){
                        if($final_link['contents']!='&nbsp;'){
                            $final_html_exp = explode($final_link['contents'],strip_tags($final_html));    
                            if($final_html_exp[0]){
                                if(strip_tags($final_html_exp[0])!='&nbsp;'){
                                    $final_html_array[] = strip_tags($final_html_exp[0]);
                                }
                            }
                            if(strip_tags($final_link['contents'])!='&nbsp;'){
                                 $final_html_array[] = strip_tags($final_link['contents']);
                             }
                            if($final_html_exp[1]){
                                if(strip_tags($final_html_exp[1])!='&nbsp;'){
                                $final_html_array[] = strip_tags($final_html_exp[1]);
                                }
                            }
                        }       
                    }     

                } else {
                    if(strip_tags($final_html)!='&nbsp;'){
                    $final_html_array[] = strip_tags($final_html);
                    }
                }
            }
            
            echo "<hr/>";
            for ($k = 0; $k < sizeof($final_html_array); $k++) {   
            echo $k." > ";
            echo trim($final_html_array[$k],"&nbsp;");
            $en_text_array[] = trim($final_html_array[$k],"&nbsp;");
            echo "<br/>";
            }
            echo "<hr/>";   
            */    

            /* START ENGLISH */
            $enArrayValue = extract_page($text);

            echo "<hr/>";
            //print_r($enArrayValue);
            //echo "<hr/>";
            echo " : EN :".count($enArrayValue);
            echo "<hr/>";
            /* END ENGLISH */

            /* START FR LANG */
            $LangKey = array_search('fr', array_column($en_Full_Array[$en_Array_Value], 'locale'));
            echo "<hr/>";
            $LangKey=$LangKey+$lc;
            //echo  $LangKey;
            //echo " : FR :";
            $text_FR=$en_Full_Array[$en_Array_Value][$LangKey]['article'];
            $frArrayValue = extract_page($text_FR);

            echo "<hr/>";
            //print_r($frArrayValue);
            //echo "<hr/>";
            echo " : FR :".count($frArrayValue);
            echo "<hr/>";
            /* END FR LANG */

            /* START NL LANG */
            $LangKey = array_search('nl', array_column($en_Full_Array[$en_Array_Value], 'locale'));
            echo "<hr/>";
            $LangKey=$LangKey+$lc;
            //echo  $LangKey;
            //echo " : NL :";
            $text_NL=$en_Full_Array[$en_Array_Value][$LangKey]['article'];
            $nlArrayValue = extract_page($text_NL);

            echo "<hr/>";
            //print_r($nlArrayValue);
            //echo "<hr/>";
            echo " : NL :".count($nlArrayValue);
            echo "<hr/>";
            /* END NL LANG */
   
            /* INSERT PROCESS - START * /

            $html_array = $enArrayValue;
            echo "<hr/>";
            $ci = 0;
            foreach($html_array as $html_array_value) {
            $link_value = $html_array_value;
 
                echo "<hr/>";
                echo "CONTENT: ";
                echo $text= strip_tags($link_value);
                echo "<hr/>";   

                echo $text= trim(strip_tags($link_value), "&nbsp;");
                echo "<hr/>";   
                
                    $originalID = insert_Trp_Original_Strings($text);  
                    if($originalID){
                        $metaKey = 'post_parent_id';
                        $metaID = insert_Trp_Original_Meta($originalID,$metaKey,$postID);
                            
                            
                            if($metaID){
                                $tableName = "trp_dictionary_en_us_fr_fr";
        
                                echo "<hr/>";
                                echo " : FR :";
                                echo "<hr/>";
                                echo $textNew = $frArrayValue[$ci];
                                echo "<hr/>";
                                $TransID = insert_Trp_Dictionary($text,$textNew,$originalID,$tableName);
                                echo " : FR TransID::".$TransID;
                                echo "<hr/>";
                            }
                             
                            if($metaID){
                                $tableName = "trp_dictionary_en_us_nl_nl";
       
                                echo "<hr/>";
                                echo " : NL :";
                                echo "<hr/>";
                                echo $textNew = $nlArrayValue[$ci];
                                echo "<hr/>";
                                $TransID = insert_Trp_Dictionary($text,$textNew,$originalID,$tableName);
                                echo " : NL TransID::".$TransID;
                                echo "<hr/>";
                            }
                            
                        }
                 
        $ci++;    
        }
        echo "<hr/>";

            /* INSERT PROCESS - END */
        }
    $lc=$lc+9;      
    }
       
    
?>