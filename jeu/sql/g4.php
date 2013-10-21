<?php
query("INSERT INTO bt_bat_user VALUES
( '' , '".$_SESSION['iduser']."' , 24 , 'prod' , 0 , 'destructible') , 
( '' , '".$_SESSION['iduser']."' , 16 , 'clone' , 0 , 'destructible') 
");

query("INSERT INTO bt_clone_user VALUES 
('' , 4 , '".$_SESSION['iduser']."' , 'homme' , 0 , 'prototype' ) , 
('' , 5 , '".$_SESSION['iduser']."' , 'homme' , 0 , 'prototype' ) 
");

query("INSERT INTO bt_proto_user VALUES 
('' , 4 , '".$_SESSION['iduser']."' , 'homme' , 'debut' , 0 , 0 , 0) , 
('' , 5 , '".$_SESSION['iduser']."' , 'cyborg' , 'debut' , 0 , 0 , 0) 
");
?>