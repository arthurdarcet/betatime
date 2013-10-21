<form id="change_mdp" name="change_mdp" method="post" action="scripts/options.php?action=change_mdp">
<div class="block">
	<h4>Changer son mot de passe</h4>
<table>
	<tr><td>Mot de passe actuel </td><td><input type="password" name="ancien_mdp" /></td></tr>
	<tr><td>Nouveau mot de passe </td><td><input type="password" name="new_mdp" /></td></tr>
	<tr><td>Retapez le nouveau mot de passe </td><td><input name="new_mdp2" type="password" /></td></tr>
	<tr><td></td><td><input type="submit" name="Submit" value="Valider" /></td></tr>
</table>
</div>
</form>
<div class="block">
<h4>Vendre ses d&eacute;faites</h4>
<form method="post" action="scripts/options.php?action=vendre_defaite">
<p><a href="#" onClick="window.open('textes/prix_defaite.php','Prix des defaites','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=200, height=350');return(false)">Prix de vente des defaites selon le grade</a></p>
<p>Nombre de d&eacute;faite(s) : {NBR_DEFAITE}</p>
<br /><br />
    <p><input type="submit" name="Submit2" value="Vendre" class="inputa" />&nbsp;
      <select name="nbr_defaite" class="inputa">
		<!-- BEGIN defaites -->
		<option value="{defaites.NBR_DEFAITE}{LVL2}">{defaites.NBR_DEFAITE}{LVL2}</option>
    	<!-- END defaites -->
	</select>
	Défaites</p>
</form>
</div>
{THEME}