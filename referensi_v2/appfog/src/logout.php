<?php

setcookie('username', '', time()-3600 +'/'+'localhost/FDH');
setcookie('password', '', time()-3600 +'/'+'localhost/FDH');

header('Location:../index.php');
?>
