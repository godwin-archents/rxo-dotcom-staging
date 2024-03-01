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
           VALUES ('".$inputdata."') ";
 
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
           VALUES ('".$inputdata1."','".$inputdata2."',2,0,'".$inputdata3."') ";
 
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
 					


if(isset($_REQUEST['title'])) {
    $title=$_REQUEST['title'];
    $postID = get_Post_Info($title);
    if($postID){
    $originalID = insert_Trp_Original_Strings($title);
        if($originalID){
            $metaKey = 'post_parent_id';
            $metaID = insert_Trp_Original_Meta($originalID,$metaKey,$postID);
                if($metaID){
                    $tableName = "trp_dictionary_en_us_fr_fr";
                    $titleNew = 'XPO Logistics accompagne Electrolux pour gÃ©rer sa logistique omnicanale en France';
                    $TransID = insert_Trp_Dictionary($title,$titleNew,$originalID,$tableName);
                    echo "FR TransID::".$TransID;
                }
        }
    }
    //print_r($postInfo);

} else {
    /*
    echo $title='NoTitle';
    */
    $en_Full_Array = array();
    $en_Array = array();
    /*
    $CSVfp = fopen("xpo_news_archive.csv", "r");
    */
    $CSVfp = fopen("xpo_news_archive.csv", "r");
    
    if($CSVfp !== FALSE) {
    $i=0;
    while(! feof($CSVfp)) {
    $data = fgetcsv($CSVfp, 1000, ",");
    if($data[0]!='id'){
      
        $en_Full_Array[$data[0]][$i]['id'] = $data[0];
        $en_Full_Array[$data[0]][$i]['locale'] = $data[1];
        $en_Full_Array[$data[0]][$i]['title'] = $data[3];
        $i++;            
        if($data[1]=='en') {
            $en_Array[] = $data[0];
        }
    }
    
    }
    }
    fclose($CSVfp);
    /*
    print_r($en_Array);
    echo "<hr/>";
    print_r($en_Full_Array);
    */

    $lc=0;
    foreach($en_Array as $en_Array_Value){
        /*
        echo "<hr/>";
        print_r($en_Full_Array[$en_Array_Value]);
        echo "<hr/>";
        */
        $firstKey = array_key_first($en_Full_Array[$en_Array_Value]);

        echo "<hr/>";
        echo $title=$en_Full_Array[$en_Array_Value][$firstKey]['title'];
        echo "<hr/>";
        
        $postID = get_Post_Info($title);
        if($postID){
        $originalID = insert_Trp_Original_Strings($title);
            if($originalID){
                $metaKey = 'post_parent_id';
                $metaID = insert_Trp_Original_Meta($originalID,$metaKey,$postID);
                    if($metaID){
                        $tableName = "trp_dictionary_en_us_fr_fr";

                        $LangKey = array_search('fr', array_column($en_Full_Array[$en_Array_Value], 'locale'));
                        echo "<hr/>";
                        echo  $LangKey=$LangKey+$lc;
                        echo "FR";
                        echo $titleNew=$en_Full_Array[$en_Array_Value][$LangKey]['title'];
                        echo "<hr/>";

                        $TransID = insert_Trp_Dictionary($title,$titleNew,$originalID,$tableName);
                        echo "FR TransID::".$TransID;
                    }
                    if($metaID){
                        $tableName = "trp_dictionary_en_us_nl_nl";

                        $LangKey = array_search('nl', array_column($en_Full_Array[$en_Array_Value], 'locale'));
                        echo "<hr/>";
                        echo  $LangKey=$LangKey+$lc;
                        echo "NL";
                        echo $titleNew=$en_Full_Array[$en_Array_Value][$LangKey]['title'];
                        echo "<hr/>";

                        $TransID = insert_Trp_Dictionary($title,$titleNew,$originalID,$tableName);
                        echo "FR TransID::".$TransID;
                    }
            }
        }
    $lc=$lc+9;      
    }

    

}


//echo "Title".$title;
/*
if($type=='create'){
    create_interview_usage($data);
}
*/
?>