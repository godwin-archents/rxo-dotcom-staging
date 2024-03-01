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
        $en_Full_Array[$data[0]][$i]['blurb'] = $data[7];
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

        echo "<hr/>";
        echo "TITLE: ";
        echo $title=$en_Full_Array[$en_Array_Value][$firstKey]['title'];
        echo "<hr/>";
        
        $postID = get_Post_Info($title);
        if($postID){
        echo "<hr/>";
        echo "BLURB: ";
        echo $text=$en_Full_Array[$en_Array_Value][$firstKey]['blurb'];
        echo "<hr/>";     
        $originalID = insert_Trp_Original_Strings($text);
            if($originalID){
                $metaKey = 'post_parent_id';
                $metaID = insert_Trp_Original_Meta($originalID,$metaKey,$postID);
                    if($metaID){
                        $tableName = "trp_dictionary_en_us_de_de";

                        $LangKey = array_search('pt', array_column($en_Full_Array[$en_Array_Value], 'locale'));
                        echo "<hr/>";
                        echo  $LangKey=$LangKey+$lc;
                        echo " : DE :";
                        echo $textNew=$en_Full_Array[$en_Array_Value][$LangKey]['blurb'];
                        $TransID = insert_Trp_Dictionary($text,$textNew,$originalID,$tableName);
                        echo " : DE TransID::".$TransID;
                        echo "<hr/>";
                    }
                    if($metaID){
                        $tableName = "trp_dictionary_en_us_es_es";

                        $LangKey = array_search('es', array_column($en_Full_Array[$en_Array_Value], 'locale'));
                        echo "<hr/>";
                        echo  $LangKey=$LangKey+$lc;
                        echo " : ES :";
                        echo $textNew=$en_Full_Array[$en_Array_Value][$LangKey]['blurb'];
                        $TransID = insert_Trp_Dictionary($text,$textNew,$originalID,$tableName);
                        echo " : ES TransID::".$TransID;
                        echo "<hr/>";
                    }
                    if($metaID){
                        $tableName = "trp_dictionary_en_us_fr_fr";

                        $LangKey = array_search('fr', array_column($en_Full_Array[$en_Array_Value], 'locale'));
                        echo "<hr/>";
                        echo  $LangKey=$LangKey+$lc;
                        echo " : FR :";
                        echo $textNew=$en_Full_Array[$en_Array_Value][$LangKey]['blurb'];
                        $TransID = insert_Trp_Dictionary($text,$textNew,$originalID,$tableName);
                        echo " : FR TransID::".$TransID;
                        echo "<hr/>";
                    }
                    if($metaID){
                        $tableName = "trp_dictionary_en_us_it_it";

                        $LangKey = array_search('it', array_column($en_Full_Array[$en_Array_Value], 'locale'));
                        echo "<hr/>";
                        echo  $LangKey=$LangKey+$lc;
                        echo " : IT :";
                        echo $textNew=$en_Full_Array[$en_Array_Value][$LangKey]['blurb'];
                        $TransID = insert_Trp_Dictionary($text,$textNew,$originalID,$tableName);
                        echo " : IT TransID::".$TransID;
                        echo "<hr/>";
                    }                    
                    if($metaID){
                        $tableName = "trp_dictionary_en_us_nl_nl";

                        $LangKey = array_search('nl', array_column($en_Full_Array[$en_Array_Value], 'locale'));
                        echo "<hr/>";
                        echo  $LangKey=$LangKey+$lc;
                        echo " : NL :";
                        echo $textNew=$en_Full_Array[$en_Array_Value][$LangKey]['blurb'];
                        $TransID = insert_Trp_Dictionary($text,$textNew,$originalID,$tableName);
                        echo " : FR TransID::".$TransID;
                        echo "<hr/>";
                    }                    
                    if($metaID){
                        $tableName = "trp_dictionary_en_us_pl_pl";

                        $LangKey = array_search('pl', array_column($en_Full_Array[$en_Array_Value], 'locale'));
                        echo "<hr/>";
                        echo  $LangKey=$LangKey+$lc;
                        echo " : PL :";
                        echo $textNew=$en_Full_Array[$en_Array_Value][$LangKey]['blurb'];
                        $TransID = insert_Trp_Dictionary($text,$textNew,$originalID,$tableName);
                        echo " : PL TransID::".$TransID;
                        echo "<hr/>";
                    }
            }
        }
    $lc=$lc+9;      
    }

    
?>