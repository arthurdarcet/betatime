<?php
query("INSERT INTO bt_bat_user VALUES
( '' , '".$_SESSION['iduser']."' , 1 , 3 , 1 , 0) , 
( '' , '".$_SESSION['iduser']."' , 2 , 3 , 1 , 0) , 
( '' , '".$_SESSION['iduser']."' , 4 , 3 , 1 , 0) ,
( '' , '".$_SESSION['iduser']."' , 28 , 2 , 0 , 0) 
");
?>