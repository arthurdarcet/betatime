<?php
query("INSERT INTO bt_bat_user VALUES
( '' , '".$_SESSION['iduser']."' , 5 , 'def' , 0 , 'destructible') , 
( '' , '".$_SESSION['iduser']."' , 6 , 'prod' , 0 , 'destructible') , 
( '' , '".$_SESSION['iduser']."' , 25 , 'clone' , 0 , 'destructible') ,
( '' , '".$_SESSION['iduser']."' , 27 , 'stockage' , 0 , 'destructible')
");

query("INSERT INTO bt_clone_user VALUES 
('' , 3 , '".$_SESSION['iduser']."' , 'homme' , 0 , 'prototype' ) , 
('' , 9 , '".$_SESSION['iduser']."' , 'capsule' , 0 , 'prototype' ) 
");

query("INSERT INTO bt_proto_user VALUES 
('' , 3 , '".$_SESSION['iduser']."' , 'homme' , 'debut' , 0 , 0 , 0) , 
('' , 9 , '".$_SESSION['iduser']."' , 'capsule' , 'debut' , 0 , 0 , 0) 
");
?>