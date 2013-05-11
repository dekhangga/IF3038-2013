<?php  
include "koneksi.php";
include "request.php";

$id=$_GET["id"];
$nama_user=$_GET["nama_user"];

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/delass?id=$id&username=$nama_user",'GET',array()),true);

//$sql = "DELETE FROM assignee WHERE nama_user='$nama_user'";
//$result = mysql_query($sql);

//$assignee="select * from assignee where idtask= '$id'";
//$hasilass=mysql_query($assignee);
foreach($result as $rowass){

echo "<a href=\"profile.php?user=".$rowass['nama_user']." \">".$rowass['nama_user']."</a>";
echo "<br>";
}

echo "<div id=\"result\" style=\"display:none;\"></div>
<div id=\"edit_ass\" style=\"display:block\"> 
<form>
   <table>
        <tr>
			
			<input type=\"text\" id=\"assignee\" autocomplete=\"off\" list=\"listassignee\" onkeydown=\"javascript:getSuggest();\"></input>
<datalist id=\"listassignee\">
                                            </datalist>
        </td>
        </tr>
        
        <tr>
            <td>
                <input id=\"tambah_button\" type=\"button\" onclick=\"addRow(".$id.")\" value=\"Tambah\" />
            </td>
        </tr>
    </table>
</form>
</div>";

echo "<div id=\"delete_ass\" style=\"display:block\"><form action=\"\"> <select id=\"assignees\" onchange=\"delAss(this.value, ".$id.")\"> <option value=\"\">Delete an assignee:</option>";
$assignee = array();
//$x="select * from assignee where idtask= '$id'";
//$hasilx=mysql_query($x);
foreach($result as $row) {
    $assignee[] = $row['nama_user'];
}
foreach ($assignee as $opt) {
    $sel = '';
    if (in_array($opt, $mytitle)) {
        $sel = ' selected="selected" ';
    }
    echo '<option ' . $sel . ' value="' . $opt . '">' . $opt . '</option>';
}
echo "</select></form></div>";


				
  
?> 