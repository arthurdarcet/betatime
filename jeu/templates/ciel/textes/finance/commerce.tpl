<div class="block">
<h4>Ajouter des ressources à vendre</h4>
<!-- BEGIN vendre -->
<form id="add_commerce" name="add_commerce" method="post" action="?page=finance&p2=commerce&action=vendre">
<p>Je vends {vendre.NOMBRE} de {vendre.TYPE}&agrave; un prix unitaire de {vendre.PRIX_UNIT}.
<input type="submit" name="Submit" value="Vendre" /></p>
</form>
<!-- END vendre -->
{ELSE_VENDRE}
</div>
<div class="block"> 
<h4>Liste des lots en ventes</h4>
<p align="right"><a href="?page=finance&p2=mes_ventes">Mes ventes en cours</a></p>
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
		<td>{commerce.VENDEUR}</td>
		<td><img src="templates/ciel/images/ressources/{commerce.ICONES_RESSOURCES}.gif" />{commerce.NBR}</td>
		<td>{commerce.PRIX_UNIT}</td>
		<td><img src="templates/ciel/images/ressources/beta.gif" />{commerce.PRIX_TOTAL}</td>
		<td>
		<form method="post" action="{commerce.CIBLE_ACHAT}">
			{commerce.ID}{commerce.BOUTON}
		</form>
		</td> 
	</tr>
	<!-- END commerce -->
</table>
</div>