<?php
//pour rechercher le grade
//By Guigui le 02/08/06
function grade() {
$sql = query("SELECT * FROM bt_users WHERE user = '".$_SESSION['user']."' ");
$info = mysql_fetch_assoc($sql);

$grade = $info['grade'];

return $grade;
}

?>
