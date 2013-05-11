<?php
include 'request.php';

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/addTaskSuggest",'POST',array()),true);

foreach ($result as $row) {
   echo "<option value='".$row['username']."'></option>";
}
?>