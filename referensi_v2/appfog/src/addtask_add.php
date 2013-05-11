<?php

include 'koneksi.php';

$curr_username = $_COOKIE['username'];
$sql_id = mysql_query("SELECT id FROM user WHERE username LIKE '".$curr_username."'");
$loginid = mysql_fetch_array($sql_id);

$query = "SHOW TABLE STATUS LIKE 'tugas'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$newid = $data['Auto_increment'];

$taskname = $_POST['task_name_input'];
$deadline = $_POST['deadline_input'];
$as = $_POST['assignee'];
$tag = $_POST['tag_input'];
$cat = $_POST['idkat'];
$a = $loginid['id'];

echo $newid ;
echo $taskname ;
echo $deadline ;
echo $as ;
echo $tag ;
echo $cat ;
echo $ava ;

//Insert data to database
$querytugas = "INSERT INTO `tugas` (`id`,`idkat`,`idcreator`,`namatask`,`deadline`) VALUES ('$newid','$cat',$a,'$taskname','$deadline')";
if(mysql_query($querytugas)) {
    echo "querydata ok" ;
}

$tagex = explode(',', $tag) ;
echo $tag ;

echo "tag 1" . $tagex[0] ;
echo "tag 2" . $tagex[1] ;

foreach ($tagex as $tagin) {
    $querytag = "INSERT INTO `tag` (`idtask`,`namatag`) VALUES ('$newid','$tagin')" ;
    echo $tagin;
    mysql_query($querytag) ;

}

foreach ($as as $asin){
    $queryas = "INSERT INTO `assignee` (`idtask`,`nama_user`) VALUES ('$newid','$asin')" ;
    echo $asin;
    mysql_query($queryas) ;
}

    // function rearrange array
    function rearrangeArray(&$file_post) {
        $file_ary = array() ;
        $file_count = count($file_post['name']) ;
        $file_key = array_keys($file_post);
        
        for ($i=0 ; $i< $file_count ; $i++){
            foreach($file_key as $key){
                    $file_ary[$i][$key] = $file_post[$key][$i];
                }    
        }
        
        return $file_ary ;
    }
    
    //file dari form di rearrange
    $file_ary = rearrangeArray($_FILES['at_upload']) ;
    
    //Iterasi input file ke database
    foreach ($file_ary as $file){
        $filename = $file['name'];
        $queryatt = "INSERT INTO `attachment` (`idtask`,`filename`) VALUES ('$newid','$filename')" ;
        echo $filename;
        mysql_query($queryatt) ;
        
        if ($file["error"] > 0) {
        echo "Return Code: " . $file["error"] . "<br>";
        } else {
            if (file_exists("attachment/" . $file["name"])) {
                echo $file["name"] . " already exists. ";
            } else {
                move_uploaded_file($file["tmp_name"], "../attachment/" . $file["name"]);
                echo "Stored in: " . "../attachment/" . $file["name"];
            }
        }
        
    }
    
    header("Location:dashboard.php");    
?>
