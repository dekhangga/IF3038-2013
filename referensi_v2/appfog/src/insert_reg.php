<?php
include 'request.php';

$user = $_POST["username"];
$pass = $_POST["password"];
$name = $_POST["long_name"];
$email = $_POST["email"];
$date = $_POST["birth_date"];
$ava = $_FILES["avatar_upload"]["name"];

$args = array();
$args['user'] = $user;
$args['pass'] = $pass;
$args['name'] = $name;
$args['email'] = $email;
$args['date'] = $date;
$args['ava'] = $ava;

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/insertReg()",'POST',$args),true);

// Upload File
$allowedExts = array("jpg", "jpeg", "gif", "png");
$temp = (explode(".", $_FILES["avatar_upload"]["name"]));
$extension = end($temp);
if ($_FILES["avatar_upload"]["error"] > 0) {
    echo "Return Code: " . $_FILES["avatar_upload"]["error"] . "<br>";
} else {
    if (file_exists("upload/" . $_FILES["avatar_upload"]["name"])) {
        echo $_FILES["avatar_upload"]["name"] . " already exists. ";
    } else {
        move_uploaded_file($_FILES["avatar_upload"]["tmp_name"], "../img/avatar/" . $_FILES["avatar_upload"]["name"]);
        echo "Stored in: " . "../img/avatar/" . $_FILES["avatar_upload"]["name"];
    }
}

header("location:dashboard.php") ;
?>
