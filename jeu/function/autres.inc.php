<?php
//Fait le 19 décembre 2006 par guigui
//Utilité : Connaitre l'ip du visiteur.
//Provient de developpez.com

function ip() {
   if (isSet($_SERVER)) {
    if (isSet($_SERVER["HTTP_X_FORWARDED_FOR"])) {
     $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } elseif (isSet($_SERVER["HTTP_CLIENT_IP"])) {
     $realip = $_SERVER["HTTP_CLIENT_IP"];
    } else {
     $realip = $_SERVER["REMOTE_ADDR"];
    }

   } else {
    if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
     $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
    } elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
     $realip = getenv( 'HTTP_CLIENT_IP' );
    } else {
     $realip = getenv( 'REMOTE_ADDR' );
    }
   }
   return $realip;
}
//Pour gerer les requetes sql
function query($sql) {
	include('conf/config.php');
        global $nbquery; // dans un premier temps il faut rendre la variable déclarée précédemment globale pour pouvoir utiliser son contenu
        $nbquery++; // on ajoute 1 à la variable
        $var = mysql_query($sql)or die( 'Une erreur est survenue. Veuillez donner ces informations aux administrateurs.<br />
		Fichier : "'.$_SERVER['REQUEST_URI'].'".<br />
                                        <div style="border:dashed; border-color:#FF0000">Requête : '.$sql.'</div><br />
                                        Erreur : '.mysql_error()); // on traite la requête
        return $var; // Pour finir on retourne le tout (l'erreur si il y en a une)
}
//Fonction de redirection par header, meta ou javascript
function redirection($cible = 'index.php' , $type = 'php' , $time = 0)
{
	if($type == 'meta' OR $type == 'html' OR $type == 'js')
	{
		echo '<meta http-equiv="refresh" content="'.$time.'; url='.$cible.'" />';
	}elseif($type == 'php' OR $type == 'header')
	{
		header('location:'.$cible);
	}/*elseif($type == 'js')
	{
		echo '<script language="javascript"
			 type="text/javascript">
document.location.href="'.$cible.'";
			</script>';
	}*/
}

//Fait le 19 novembre 2006 par guigui
//Utilité : Faire des alertes javascript

function alert($msg){
echo '<script type="text/javascript">
		alert("'.$msg.'");
	</script>';
}
?>