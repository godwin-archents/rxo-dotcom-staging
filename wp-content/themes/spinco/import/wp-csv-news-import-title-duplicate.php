<?php 
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
 

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if( mysqli_connect_error()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$GLOBALS['conn'] = $conn;

mysqli_set_charset($conn, 'utf8');
mysqli_query($conn,'set names utf8');
 
$table_prefix =  "swk_";
 
/*
function get_Post_Info($inputdata) {

    
    $conn = $GLOBALS['conn']; 
    $table_prefix =  "swk_";

	$sql = "SELECT ID FROM `".$table_prefix."posts` WHERE `post_title`='".addslashes($inputdata)."' AND `post_status`='publish'";
    
    $query = mysqli_query($conn, $sql);

    $data = mysqli_fetch_array($query);
    
    return $data[0];
	 
}

function update_Post_Info($inputdata,$postID) {
    
    $conn = $GLOBALS['conn']; 
    $table_prefix =  "swk_";
 
    $sql = "UPDATE `".$table_prefix."posts` SET `post_title` = '".addslashes($inputdata)."' WHERE `ID` = '".$postID."' ";
           
    $query = mysqli_query($conn, $sql);
 
    $data = mysqli_affected_rows($conn);

    return $data;
	 
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

 function replace_first_str($search_str, $replacement_str, $src_str){
    return (false !== ($pos = strpos($src_str, $search_str))) ? substr_replace($src_str, $replacement_str, $pos, strlen($search_str)) : $src_str;
  }

  function replace_last_str($search_str, $replacement_str, $src_str){
    return (false !== ($pos = strrpos($src_str, $search_str))) ? substr_replace($src_str, $replacement_str, $pos, strlen($search_str)) : $src_str;
  }
 					
*/
 
 /* Process Start Here */

    $en_Full_Array = array();
    $en_Array = array();
    $en_shortTitle_Array = array();
    $CSVfp = fopen("gxo-europe-news.csv", "r");
    
    if($CSVfp !== FALSE) {
    $i=0;
    while(! feof($CSVfp)) {
    $data = fgetcsv($CSVfp, 1000, ",");
    if($data[0]!='id'){
      
        $en_Full_Array[$data[0]][$i]['id'] = $data[0];
        $en_Full_Array[$data[0]][$i]['locale'] = $data[1];
        $en_Full_Array[$data[0]][$i]['title'] = $data[3];
        $en_Full_Array[$data[0]][$i]['short_title'] = $data[4];
        $i++;            
        if($data[1]=='en') {
            $en_Array[] = $data[0];
        }
    }
    
    }
    }
    fclose($CSVfp);
  

    $lc=0;
    foreach($en_Array as $en_Array_Value){
  
        $firstKey = array_key_first($en_Full_Array[$en_Array_Value]);
        /*
        echo "<hr/>";
        echo "<hr/>";
        echo $short_title=$en_Full_Array[$en_Array_Value][$firstKey]['short_title'];
        */
        $short_title=$en_Full_Array[$en_Array_Value][$firstKey]['short_title'];
        if (in_array($short_title, $en_shortTitle_Array))
        {
            echo "<hr/>";
            echo "Duplication"." :: ".$short_title;
            echo "<hr/>";
        } 
        
        $en_shortTitle_Array[] = $short_title; 
         
    $lc=$lc+9;      
    }

    echo "<hr/>";
    echo "TOTAL:".count($en_shortTitle_Array);
    echo "<hr/>";
    $en_Unique_shortTitle_Array = array_unique($en_shortTitle_Array);
    echo "UNIQUE:".count(array_unique($en_Unique_shortTitle_Array));
    echo "<hr/>";
     
?>