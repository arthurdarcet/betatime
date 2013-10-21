<?php
query("INSERT INTO bt_bat_user VALUES
( '' , '".$_SESSION['iduser']."' , 3 , 'prod' , 0 , 'destructible') , 
( '' , '".$_SESSION['iduser']."' , 7 , 'stockage' , 0 , 'destructible') , 
( '' , '".$_SESSION['iduser']."' , 8 , 'clone' , 0 , 'destructible') ,
( '' , '".$_SESSION['iduser']."' , 12 , 'prototype' , 0 , 'destructible') 
");

query("INSERT INTO bt_clone_user VALUES 
('' , 1 , '".$_SESSION['iduser']."' , 'homme' , 0 , 'prototype' ) , 
('' , 2 , '".$_SESSION['iduser']."' , 'homme' , 0 , 'prototype' ) 
");

query("INSERT INTO bt_proto_user VALUES 
('' , 1 , '".$_SESSION['iduser']."' , 'homme' , 'debut' , 0 , 0 , 0) , 
('' , 2 , '".$_SESSION['iduser']."' , 'homme' , 'debut' , 0 , 0 , 0) 
");
?>