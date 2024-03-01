<?php 
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
 

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if( mysqli_connect_error()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$GLOBALS['conn'] = $conn;

mysqli_set_charset($conn, 'utf8');
mysqli_query($conn,'set names utf8');
 
$table_prefix =  "wp_";
 

function get_Post_Info($inputdata) {

    
    $conn = $GLOBALS['conn']; 
    $table_prefix =  "wp_";

    $inputdata = mysqli_real_escape_string($conn, $inputdata);

	$sql = "SELECT ID,post_content FROM `".$table_prefix."posts` WHERE `post_title`='".$inputdata."'";
 
    $query = mysqli_query($conn, $sql);

    $data = mysqli_fetch_array($query);
    
    return $data;
	 
}

function insert_Trp_Original_Strings($inputdata) {
    
    $conn = $GLOBALS['conn']; 
    $table_prefix =  "wp_";

    $inputdata = mysqli_real_escape_string($conn, $inputdata);

	$sql = "INSERT INTO `".$table_prefix."trp_original_strings` (`original`) 
           VALUES ('".addslashes($inputdata)."') ";
 
    $query = mysqli_query($conn, $sql);
 
    $data = mysqli_insert_id($conn);

    return $data;
	 
}

function insert_Trp_Original_Meta($inputdata1,$inputdata2,$inputdata3) {
    
    $conn = $GLOBALS['conn']; 
    $table_prefix =  "wp_";

    $inputdata1 = mysqli_real_escape_string($conn, $inputdata1);
    $inputdata2 = mysqli_real_escape_string($conn, $inputdata2);
    $inputdata3 = mysqli_real_escape_string($conn, $inputdata3);

	$sql = "INSERT INTO `".$table_prefix."trp_original_meta` (`original_id`,`meta_key`,`meta_value`) 
           VALUES ('".$inputdata1."','".$inputdata2."','".$inputdata3."') ";
 
    $query = mysqli_query($conn, $sql);
 
    $data = mysqli_insert_id($conn);

    return $data;
	 
}


function insert_Trp_Dictionary($inputdata1,$inputdata2,$inputdata3,$tabledata) {
    
    $conn = $GLOBALS['conn']; 
    $table_prefix =  "wp_";

    $inputdata1 = mysqli_real_escape_string($conn, $inputdata1);
    $inputdata2 = mysqli_real_escape_string($conn, $inputdata2);
    $inputdata3 = mysqli_real_escape_string($conn, $inputdata3);

	$sql = "INSERT INTO `".$table_prefix.$tabledata."` (`original`,`translated`,`status`,`block_type`,`original_id`) 
           VALUES ('".addslashes($inputdata1)."','".addslashes($inputdata2)."',2,0,'".$inputdata3."') ";
 
    $query = mysqli_query($conn, $sql);
 
    $data = mysqli_insert_id($conn);

    return $data;
	 
}


function update_Trp_Content($postID,$postContent) {
    
    $conn = $GLOBALS['conn']; 
    $table_prefix =  "wp_";
    $tabledata = "posts";

    $postContent = mysqli_real_escape_string($conn, $postContent); 
 
    $sql = "UPDATE `".$table_prefix.$tabledata."` SET `post_content` = '".$postContent."' WHERE `ID` = '".$postID."' ";

    $query = mysqli_query($conn, $sql);
 
    //$data = mysqli_insert_id($conn);

    return $sql;
	 
}

function searchForId($id, $array) {
    foreach ($array as $key => $val) {
        if ($val['uid'] === $id) {
            return $key;
        }
    }
    return null;
 }
 					

 
 /* Process Start Here */

    $en_Full_Array = array();
    $en_Array = array();
    $CSVfp = fopen("xpo_news_archive.csv", "r");
    
    if($CSVfp !== FALSE) {
    $i=0;
    while(! feof($CSVfp)) {
    //$data = fgetcsv($CSVfp, 1000, ",");
    $data = fgetcsv($CSVfp, null, ",");
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

    //print_r($en_Full_Array);
  
    echo "VERSION: 09";
  
/* * /    
    $lc=0;
    foreach($en_Array as $en_Array_Value){
        $firstKey = array_key_first($en_Full_Array[$en_Array_Value]);
  
        $title=$en_Full_Array[$en_Array_Value][$firstKey]['title'];

        $postData = get_Post_Info($title);
       
        $EN_textNew='[trp_language language="en_US"]'.$en_Full_Array[$en_Array_Value][$firstKey]['article'].'[/trp_language]';
         
        $rc=1;

        $LangKey = array_search('es', array_column($en_Full_Array[$en_Array_Value], 'locale'));
        if($LangKey>0){ 
            $LangKey=$LangKey+$lc;
            $ES_textNew='[trp_language language="es_MX"]'.$en_Full_Array[$en_Array_Value][$LangKey]['article'].'[/trp_language]';
            $rc++;
        } else {
            $ES_textNew='[trp_language language="es_MX"]'.$en_Full_Array[$en_Array_Value][$firstKey]['article'].'[/trp_language]';
        }

        
        $LangKey = array_search('fr', array_column($en_Full_Array[$en_Array_Value], 'locale'));
        if($LangKey>0){
            $LangKey=$LangKey+$lc;
            $FR_textNew='[trp_language language="fr_CA"]'.$en_Full_Array[$en_Array_Value][$LangKey]['article'].'[/trp_language]';
            $rc++; 
        } else {
            $FR_textNew='[trp_language language="fr_CA"]'.$en_Full_Array[$en_Array_Value][$firstKey]['article'].'[/trp_language]';
        }

        
        $LangKey = array_search('it', array_column($en_Full_Array[$en_Array_Value], 'locale'));
        if($LangKey>0){
            $LangKey=$LangKey+$lc;
            $IT_textNew='[trp_language language="it_IT"]'.$en_Full_Array[$en_Array_Value][$LangKey]['article'].'[/trp_language]';
            $rc++; 
        } else {
            $IT_textNew='[trp_language language="it_IT"]'.$en_Full_Array[$en_Array_Value][$firstKey]['article'].'[/trp_language]';
        }

        echo "<hr/>";
        echo "TITLE: ";
        echo $title=$en_Full_Array[$en_Array_Value][$firstKey]['title'];
        echo "<br/>";
        echo "POST ID: ";
        echo $postData[0];
        echo "<br/>";
        echo "POST CONTENT: ";
        echo $postFullData = $EN_textNew.$ES_textNew.$FR_textNew.$IT_textNew;
        echo "<hr/>";
  
      
        $lc=$lc+$rc;
            
    }

/* */

/* */
        $lc=0;
        foreach($en_Array as $en_Array_Value){
            $firstKey = array_key_first($en_Full_Array[$en_Array_Value]);

            $title=$en_Full_Array[$en_Array_Value][$firstKey]['title'];

            $postData = get_Post_Info($title);
        
            $EN_textNew='[trp_language language="en_US"]'.$en_Full_Array[$en_Array_Value][$firstKey]['article'].'[/trp_language]';
            
            $rc=1;

            $LangKey = array_search('es', array_column($en_Full_Array[$en_Array_Value], 'locale'));
            if($LangKey>0){ 
                $LangKey=$LangKey+$lc;
                $ES_textNew='[trp_language language="es_MX"]'.$en_Full_Array[$en_Array_Value][$LangKey]['article'].'[/trp_language]';
                $rc++;
            } else {
                $ES_textNew='[trp_language language="es_MX"]'.$en_Full_Array[$en_Array_Value][$firstKey]['article'].'[/trp_language]';
            }

            
            $LangKey = array_search('fr', array_column($en_Full_Array[$en_Array_Value], 'locale'));
            if($LangKey>0){
                $LangKey=$LangKey+$lc;
                $FR_textNew='[trp_language language="fr_CA"]'.$en_Full_Array[$en_Array_Value][$LangKey]['article'].'[/trp_language]';
                $rc++; 
            } else {
                $FR_textNew='[trp_language language="fr_CA"]'.$en_Full_Array[$en_Array_Value][$firstKey]['article'].'[/trp_language]';
            }

            
            $LangKey = array_search('it', array_column($en_Full_Array[$en_Array_Value], 'locale'));
            if($LangKey>0){
                $LangKey=$LangKey+$lc;
                $IT_textNew='[trp_language language="it_IT"]'.$en_Full_Array[$en_Array_Value][$LangKey]['article'].'[/trp_language]';
                $rc++; 
            } else {
                $IT_textNew='[trp_language language="it_IT"]'.$en_Full_Array[$en_Array_Value][$firstKey]['article'].'[/trp_language]';
            }

            echo "<hr/>";
            echo "TITLE: ";
            echo $title=$en_Full_Array[$en_Array_Value][$firstKey]['title'];
            echo "<br/>";
            echo "POST ID: ";
            echo $postID=$postData[0];
            echo "<br/>";
            echo "POST CONTENT: ";
            echo $postContent = $EN_textNew.$ES_textNew.$FR_textNew.$IT_textNew;
            echo "<br/>";
 
            $TransID = update_Trp_Content($postID,$postContent);
            echo " : TransID::".$TransID;
            echo "<hr/>";
            $lc=$lc+$rc;
                
        }
/* */
    
?>