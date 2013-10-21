<?
//by Arthur refait le 07/05/09
if(isset($_POST['nbr_bat']) AND isset($_POST['id'])){
$nbr = $_POST['nbr_bat'];
$id = $_GET['id'];
settype ($nbr, 'integer');
	if($nbr != ''){
		if(is_numeric($nbr) AND is_numeric($id) AND is_int($nbr)) {
			$sql = query("SELECT 
							info_bat.prix AS prix , 
							info_bat.level_min AS level_min , 
							bt_bat_user.nbr , 
							info_bat.conso1_type AS conso1_type , 
							info_bat.conso2_type AS conso2_type , 
							info_bat.conso1_nbr AS conso1_nbr , 
							info_bat.conso2_nbr AS conso2_nbr , 
							bt_ressources.beta AS beta ,
							bt_ressources.elec AS elec ,
							bt_ressources.nourriture AS nourriture ,
							bt_ressources.pillule AS pillule 
							FROM bt_bat_user
							LEFT JOIN info_bat ON bt_bat_user.idbat = info_bat.id 
							LEFT JOIN bt_ressources ON bt_bat_user.iduser = bt_ressources.iduser
							WHERE bt_bat_user.idbat = '".$id."' AND bt_bat_user.iduser = '".$_SESSION['iduser']."'");
			$info = mysql_fetch_assoc($sql);
			if($info['level_min'] <= $_SESSION['grade'])
			{
				if($id != 1) {$prix = $info['prix'] * $nbr;}
				else{ $prix = prix_atelier($info['nbr']);}
				$new_beta = $info['beta'] - $prix;
				
				if($new_beta >= 0) {

					if($info['conso1_type'] == 'elec') { 			$new_elec = $info['elec'] - $info['conso1_nbr'];}
					elseif($info['conso1_type'] == 'nourriture'){ 	$new_nourr = $info['nourriture'] - $info['conso1_nbr'];}
					elseif($info['conso1_type'] == 'pillule') {		$new_pillule = $info['pillule'] - $info['conso1_nbr'];}
					if($info['conso2_type'] == 'elec') { 			$new_elec = $new_elec - $info['conso2_nbr'];}
					elseif($info['conso2_type'] == 'nourriture'){ 	$new_nourr = $new_nourr - $info['conso2_nbr'];}
					elseif($info['conso2_type'] == 'pillule') {		$new_pillule = $new_pillule - $info['conso2_nbr'];}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
					if($new_elec < 0) { 		alert("Vous ne possedez pas assez d\'électricité!");}
					elseif($new_nourr < 0 ){	alert("Vous ne possedez pas assez de nourriture!");}
					elseif($new_pillule < 0 ) {	alert("Vous ne possedez pas assez de pillule!");}
					//On execute un script different si achat d'atelier de frappe
					elseif($id == 1 AND $nbr != 1) {alert("Vous ne pouvez acheter qu\'un seul Atelier de frappe à la fois !");}
					else{
						query("UPDATE bt_ressources SET beta = '".$new_beta."' WHERE iduser = '".$_SESSION['iduser']."' ");
						$new_nbr = $nbr + $info['nbr'];
						query("UPDATE bt_bat_user SET nbr = '".$new_nbr."' WHERE iduser = '".$_SESSION['iduser']."' AND idbat = '".$id."' ");
						alert("L\'achat s\'est déroulé avec succès !");
					}
				}else{ alert("Vous ne possedez pas assez de  Beta pour acheter ce batiment !");}
			}else{ hack(1, 'Tente d\'acheter un batiment de grade plus élevé que le sien'); }
		}else{ alert('Veuillez indiquer un nombre entier de batiments');}
	}else{alert('Vous devez remplir le champ !');}
}
?>