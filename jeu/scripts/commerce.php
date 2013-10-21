<?
if (isset($_GET['action']))
{
$action = $_GET['action'];
    if($action == 'vendre')
    {
        if(isset($_POST['nbr']) AND $_POST['nbr'] != '' AND $_POST['type'] != 'Ressources'  AND isset($_POST['type']) AND isset($_POST['prix']) AND $_POST['prix'] != '' )
        {    
		$prix_unit = str_replace(',' , '.' , $_POST['prix']);
		$nbr = str_replace(',' , '.' , $_POST['nbr']);
            if(is_numeric($nbr) AND is_numeric($prix_unit) )
            {
                if($_SESSION['lot_commerce'] < 10)
                {
                        //calcul pour enlever dans les ressources
                        $type = $_POST['type'];    
                        $sql = query("SELECT * FROM bt_ressources_utilisateurs WHERE iduser='".$_SESSION['iduser']."' ");
                        $donnees = mysql_fetch_assoc($sql);
                        $nouvelles_ressources = $donnees[$type] - $_POST['nbr'] ;
                            if($nouvelles_ressources < 0)
                            {
								alert("Vous ne possedez pas assez d\'unites de la ressource que vous souhaitez vendre.");
                            }else{
							$now = time() + ((3600 * 24) * 3) ;
                                query("INSERT INTO bt_commerce VALUES('', '".$_POST['type']."', '".$nbr."', '".$_SESSION['iduser']."', '0', '".$prix_unit."', 'en attente', '".$now."' , '".time()."', '', '".$_SERVER["REMOTE_ADDR"]."' , '000.000.00.00')");
                                query("UPDATE bt_ressources_utilisateurs SET $type = '".$nouvelles_ressources."' WHERE iduser = '".$_SESSION['iduser']."' ");
                                query("UPDATE bt_users SET lot_commerce = lot_commerce + 1 WHERE iduser = '".$_SESSION['iduser']."' ");
                                alert("Vous venez de mettre en vente un lot de ".$_POST['nbr']." de ".$_POST['type'].".");
							}
                }else{
					alert("Vous avez déjà mi 10 lots en vente!");
                }
            }else{
				hack("Utiliation de lettres au lieu de chiffres dans le formulaire de vente sur le commerce !");
            }
        }else{
			alert("Veuillez remplir les champs correctement!");
        }
    }elseif($action == 'acheter')
    {
    $sql = query("SELECT vendeur , type , nombre , prix_unit FROM bt_commerce WHERE id = '".$_POST['id']."' ");
    $info_commerce = mysql_fetch_assoc($sql);
        if($info_commerce['vendeur'] != $_SESSION['iduser'] )
        {    
        $sql2 = query("SELECT * FROM bt_ressources_utilisateurs WHERE iduser = '".$_SESSION['iduser']."' "); 
        $info_ressources = mysql_fetch_assoc($sql2);
        
        $type = $info_commerce['type'];
		$prix = $donnees['nombre'] * $donnees['prix_unit'];
        $ressource_type = $info_ressources[$type];
        $diff_ressource = $ressource_type + $info_commerce['nombre'] ; 
        $diff = $info_ressources['beta'] - $prix;    
            if($diff < 0)
            {
				alert("Vous ne possedez pas assez de Beta pour acheter ce lot.");
            }else {    
            query("UPDATE bt_users SET lot_commerce = lot_commerce - 1 WHERE iduser = '".$info_commerce['vendeur']."' ");
            query("UPDATE bt_ressources_utilisateurs SET beta = '".$diff."' , ".$type." = '".$diff_ressource."' WHERE iduser = '".$_SESSION['iduser']."' ");
            query("UPDATE bt_commerce SET acheteur = '".$_SESSION['iduser']."' , statut='vendu' , achat = '".time()."' , ipa = '".$_SERVER["REMOTE_ADDR"]."' WHERE id = '".$_POST['id']."' ");    
        
        ////////////////////////////////////creditatin du compte du vendeur//////////////////////////////////////////////
        $sql_ressource_vendeur = query("SELECT * FROM bt_ressources_utilisateurs WHERE iduser = '".$info_commerce['vendeur']."'");
        $ressource_vendeur = mysql_fetch_assoc($sql_ressource_vendeur);
        
        query("UPDATE bt_ressources_utilisateurs SET beta = beta + ".$prix." WHERE iduser = '".$info_commerce['vendeur']."' ");
        ///historique///
        query("INSERT INTO bt_alerte_historique 
		VALUES('', '".$info_commerce['vendeur']."', 'annonce', 'commerce-lot vendu', '".$_POST['id']."','', '".time()."', 'non' ) , 
		('', '".$_SESSION['iduser']."', 'histo', 'commerce-achat lot', '".$_POST['id']."','', '".time()."', 'non' ) ");
			alert("Votre achat a bien ete effectue");
            }
        }else{
			alert("Vous ne pouvez pas acheter vos propres lots.");
        }
    }elseif($action == 'rachat')
    {
    $id = $_POST['id'];
    $sql = query("SELECT vendeur , type , nombre FROM bt_commerce WHERE id = '".$id."' ");
    $info_commerce = mysql_fetch_assoc($sql);
        if($info_commerce['vendeur'] == $_SESSION['iduser'])
        {
        query("UPDATE bt_users SET lot_commerce = lot_commerce - 1 WHERE iduser = '".$_SESSION['iduser']."'");
        $sql2 = query("SELECT * FROM bt_ressources_utilisateurs WHERE iduser = '".$_SESSION['iduser']."' ");
        $info_ressource = mysql_fetch_assoc($sql2);
        $type = $info_commerce['type'];
        $retour_commerce = $info_commerce['nombre'] * 0.85 ;
        $new = $info_ressource[$type] + $retour_commerce ; 
        query("UPDATE bt_ressources_utilisateurs SET $type = '".$new."' WHERE iduser = '".$_SESSION['iduser']."' ");
        query("UPDATE bt_commerce SET statut = 'racheter' WHERE id = '".$id."' ");
        alert("Vous venez de racheter votre lot!");
        }else{
			alert("Vous ne pouvez pas racheter les lots qui ne vous appartiennent pas.");
        }
    }
}
?>