<?php
if( $_SESSION['level'] == 'admin' ) 
{
	if(!empty($_GET['p2'])) {
	    if(file_exists('textes/admin/' . $_GET['p2'] . '.php')  AND !preg_match("/(\.|config|inc)/iU", $_GET['page']) ) 
		{
	        include('textes/admin/'.$_GET['p2'].'.php');
	    }else{
	        hack("Le fichier demandé n\'existe pas !");
	    }
	}else{
	    include("textes/info_base.php");
	}
}else{
	hack("Interdiction d\'aller dans la partie administration !");
}
?>