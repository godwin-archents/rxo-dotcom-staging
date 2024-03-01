<?php 
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.phpx' );
 

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

	$sql = "SELECT ID FROM `".$table_prefix."posts` WHERE `post_title`='".$inputdata."'";
 
    $query = mysqli_query($conn, $sql);

    $data = mysqli_fetch_array($query);
    
    return $data[0];
	 
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

function insert_Trp_Dictionary_Slug($inputdata1,$inputdata2,$inputdata3,$tabledata,$metakey,$postIDvalue) {
    
    $conn = $GLOBALS['conn']; 
    $table_prefix =  "wp_";

    $inputdata1 = mysqli_real_escape_string($conn, $inputdata1);
    $inputdata2 = mysqli_real_escape_string($conn, $inputdata2);
    $inputdata3 = mysqli_real_escape_string($conn, $inputdata3);

	$sql = "INSERT INTO `".$table_prefix.$tabledata."` (`original`,`translated`,`status`,`block_type`,`original_id`) 
           VALUES ('".addslashes($inputdata1)."','".addslashes($inputdata2)."',2,0,'".$inputdata3."') ";
 
    $query = mysqli_query($conn, $sql);
 
    $data = mysqli_insert_id($conn);

    $metatablename = "postmeta";

    $ssql = "INSERT INTO `".$table_prefix.$metatablename."` (`post_id`,`meta_key`,`meta_value`) 
    VALUES ('".addslashes($postIDvalue)."','".addslashes($metakey)."','".addslashes($inputdata2)."') ";

    $squery = mysqli_query($conn, $ssql);

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
        $en_Full_Array[$data[0]][$i]['slug'] = $data[5];
        $i++;            
        if($data[1]=='en') {
            $en_Array[] = $data[0];
        }
    }
    
    }
    }
    fclose($CSVfp);

    //print_r($en_Full_Array);
  
    echo "VERSION: 22";
  
/* * /    
    $lc=0;
    foreach($en_Array as $en_Array_Value){
        $firstKey = array_key_first($en_Full_Array[$en_Array_Value]);

        echo "<hr/>";
        echo "TITLE: ";
        echo $title=$en_Full_Array[$en_Array_Value][$firstKey]['title'];
        echo "<hr/>";
        $rc=1;

        $LangKey = array_search('es', array_column($en_Full_Array[$en_Array_Value], 'locale'));
        if($LangKey>0){
            echo " : LangKey :";
            echo  $LangKey=$LangKey;
            echo " : Key :";
            echo  $LangKey=$LangKey+$lc;
            echo " : ES :";
            echo $textNew=$en_Full_Array[$en_Array_Value][$LangKey]['title'];
            $rc++;
            echo " <br/> ";
        }

        
        $LangKey = array_search('fr', array_column($en_Full_Array[$en_Array_Value], 'locale'));
        if($LangKey>0){
            echo " : LangKey :";
            echo  $LangKey=$LangKey;
            echo " : Key :";
            echo  $LangKey=$LangKey+$lc;
            echo " : FR :";
            echo $textNew=$en_Full_Array[$en_Array_Value][$LangKey]['title'];
            $rc++;
            echo " <br/> ";
        }

        
        $LangKey = array_search('it', array_column($en_Full_Array[$en_Array_Value], 'locale'));
        if($LangKey>0){
            echo " : LangKey :";
            echo  $LangKey=$LangKey;
            echo " : Key :";
            echo  $LangKey=$LangKey+$lc;
            echo " : ES :";
            echo $textNew=$en_Full_Array[$en_Array_Value][$LangKey]['title'];
            $rc++;
            echo " <br/> ";
        }
      
        $lc=$lc+$rc;   
    }
/* */

/* */
    $lc=0;
    foreach($en_Array as $en_Array_Value){
        
        $firstKey = array_key_first($en_Full_Array[$en_Array_Value]);

        echo "<hr/>";
        echo $title=$en_Full_Array[$en_Array_Value][$firstKey]['title'];
        echo "<hr/>";
        
        $postID = get_Post_Info($title);
        if($postID){            
        echo "<hr/>";
        echo "TITLE: ";
        echo $text=$en_Full_Array[$en_Array_Value][$firstKey]['title'];
        echo "<hr/>";   
        $originalID = insert_Trp_Original_Strings($text);
        echo "originalID: ";
        echo $originalID;
        echo "<hr/>";   
        
            $rc=1;
            
            if($originalID){
                $metaKey = 'post_parent_id';
                $metaID = insert_Trp_Original_Meta($originalID,$metaKey,$postID);
                
                
                echo "<hr/>";
                echo " : LINE :";
                echo  $lc;
                echo "<hr/>";
               
                if($metaID){
                    $tableName = "trp_dictionary_en_us_es_mx";

                    $LangKey = array_search('es', array_column($en_Full_Array[$en_Array_Value], 'locale'));
                    
                    if($LangKey>0){
                    echo "<hr/>";
                    echo  $LangKey;
                    echo " : KEY :";
                    echo  $LangKey=$LangKey+$lc;
                    echo " : ES :";
                    echo $textNew=$en_Full_Array[$en_Array_Value][$LangKey]['title'];
                    $TransID = insert_Trp_Dictionary($text,$textNew,$originalID,$tableName);
                    echo " : ES TransID::".$TransID;
                    echo "<hr/>";
                    
                    $rc++;
                    }
                }
                if($metaID){
                    $tableName = "trp_dictionary_en_us_fr_ca";

                    $LangKey = array_search('fr', array_column($en_Full_Array[$en_Array_Value], 'locale'));

                    if($LangKey>0){
                    echo "<hr/>";
                    echo  $LangKey=$LangKey+$lc;
                    echo " : FR :";
                    echo $textNew=$en_Full_Array[$en_Array_Value][$LangKey]['title'];
                    $TransID = insert_Trp_Dictionary($text,$textNew,$originalID,$tableName);
                    echo " : FR TransID::".$TransID;
                    echo "<hr/>";
                    
                    $rc++;
                    }
                }
                if($metaID){
                    $tableName = "trp_dictionary_en_us_it_it";

                    $LangKey = array_search('it', array_column($en_Full_Array[$en_Array_Value], 'locale'));
                    
                    if($LangKey>0){
                    echo "<hr/>";
                    echo  $LangKey=$LangKey+$lc;
                    echo " : IT :";
                    echo $textNew=$en_Full_Array[$en_Array_Value][$LangKey]['title'];
                    $TransID = insert_Trp_Dictionary($text,$textNew,$originalID,$tableName);
                    echo " : IT TransID::".$TransID;
                    echo "<hr/>";
                    
                    $rc++;
                    }
                }
                 
            }
        }
    //$lc=$lc+9;      

    $lc=$lc+$rc;      
    }
/* */
    
?>