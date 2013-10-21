<?
	include('scripts/messagerie.php');
if(!empty($_GET['p2'])) {
        if(file_exists('textes/messagerie/' . $_GET['p2'] . '.php')  AND !preg_match("/(\.|config|inc)/iU", $_GET['page']) ) {
        include('textes/messagerie/'.$_GET['p2'].'.php');
        }else{
            include("scripts/hack.php");
        }
    }
    else
    {
        include("textes/messagerie/msg_recu.php");
    }
?>