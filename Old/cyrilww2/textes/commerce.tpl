<div class="block">
<h4>Ajouter des ressources à vendre</h4>
<form id="add_commerce" name="add_commerce" method="post" action="{CIBLE}">
<p>Je vends {NOMBRE} de {TYPE}&agrave; un prix unitaire de {PRIX_UNIT}.
<input type="submit" name="Submit" value="Vendre" /></p>
</form>
</div>
<div class="block">
<h4>Liste des lots en ventes</h4>
{NO_LOT}
<table width="100%" class="bordure">
	<tr>
		<th>Vendeur</th>
		<th>Quantit&eacute;</th>
		<th>Prix unitaire</th>
		<th>Prix Total</th>
		<th>-</th>
	</tr>
	<!-- BEGIN commerce -->
	<tr>
		<td height="10" >{commerce.VENDEUR}</td>
		<td><img src="templates/ciel/images/ressources/{commerce.ICONES_RESSOURCES}.gif" />{commerce.NBR}</td>
		<td>{commerce.PRIX_UNIT}</td>
		<td><img src="images/ressources/beta.gif" />{commerce.PRIX_TOTAL}</td>
		<td>
		<form method="post" action="{commerce.CIBLE_ACHAT}">
			{commerce.ID}{commerce.BOUTON}
		</form>
		</td> 
	</tr>
	<!-- END commerce -->
</table>
</div>