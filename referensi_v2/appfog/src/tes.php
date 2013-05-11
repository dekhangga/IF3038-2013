<?php
include 'koneksi.php';

$querykat = "SELECT * FROM kategori";
$result = mysql_query($querykat);
$option = "" ;
while ($row = mysql_fetch_array($result)) {
    $option = $option . "<option value='" . $row['idkat'] . "'>". $row['namakat'] ."</option>";
    echo $option;
}
?>

<html>
    <select>
        <?php
        echo $option;
        ?>
    </select>
</html>