<?php

if (($_COOKIE['username'] == '') && ($_COOKIE['password'] == '')) {
    header('Location:../index.php') ; 
}
?>
<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="../js/edit_task.js"> </script> 
        <script type="text/javascript" src="../js/animation.js"></script> 
		<script>
		window.onunload = function(){
  window.opener.location.reload();
};
		</script>
		<script language="javascript">
            function deleteRow(tableID) {
                try {
                    var table = document.getElementById(tableID);
                    var rowCount = table.rows.length;

                    for (var i = 0; i < rowCount; i++) {
                        var row = table.rows[i];
                        var chkbox = row.cells[0].childNodes[0];
                        if (null != chkbox && true == chkbox.checked) {
                            if (rowCount <= 1) {
                                alert("Cannot delete all the rows.");
                                break;
                            }
                            table.deleteRow(i);
                            rowCount--;
                            i--;
                        }


                    }
                } catch (e) {
                    alert(e);
                }
            }
        </script>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >		
		<title> Eurilys </title>
	</head>
	<form method="post" name="input" action="insert.php">
<table align="center" border="1">
<tr>
<td colspan="3" align="center"><h3>Tambah Kategori</h3></td>
</tr>
<tr>
<td>Nama Kategori</td>
<td>:</td>
<td><input type="text" name="namakat" size="20"></td>
</tr>
<td>Assignee</td>
<td>:</td>
<td><?php echo $curr_username; ?> </td>
</tr>
<tr>
<td colspan="3" align="center">
<input type="submit" name="input" value="Tambah"></td>
</tr>
</table>
</form>
</html>