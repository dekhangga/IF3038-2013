<?php
include "request.php";

$id=$_GET["id"];
$tag=$_GET["tag"];

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/edit_tag?idtag=$id&tag=$tag",'GET',array()),true);
//$simpan = mysql_query("DELETE FROM tag WHERE idtask=$id");

//$tagex = explode(',', $tag) ;
/*foreach ($tagex as $tagin) {
    $querytag = "INSERT INTO `tag` (`idtask`,`namatag`) VALUES ('$id','$tagin')" ;
    mysql_query($querytag) ;

}*/

//$tag="select * from tag where idtask= '$id'";
//$hasiltag=mysql_query($tag);

echo $result[0];
if (count($result) > 1)
for ($i = 1; $i < count($result); $i++) {
	echo " | ";
	echo $result[$i];
}

echo "<div id=\"edit_tag\" style=\"display:block\"> <input type=\"text\" id=\"tag_input\">
     <input id=\"tag_button\" type=\"button\" onclick=\"editTag(".$id.")\" value=\"Save Tag\" />
					</div>";

?>