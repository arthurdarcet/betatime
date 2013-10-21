<div class="block"> 
<h4>Mes lots en ventes </h4>
  <table width="100%" class="bordure">
	<tr>
		<th>Quantit&eacute;</th>
		<th>Prix unitaire</th>
		<th>Prix Total</th>
		<th>Date d'expiration </th>
		<th>-</th>
	</tr>
	<!-- BEGIN commerce -->
	<tr>
		<td height="10"><img src="templates/ciel/images/ressources/{commerce.ICONES_RESSOURCES}.gif" />{commerce.NBR}</td>
		<td>{commerce.PRIX_UNIT}</td>
		<td><img src="templates/ciel/images/ressources/beta.gif" />{commerce.PRIX_TOTAL}</td>
		<td>{commerce.DATE}</td>
		<td>
		<form method="post" action="?page=finance&p2=mes_ventes&action=rachat">
			{commerce.ID} <input type="submit" value="Racheter" />
		</form>		</td> 
	</tr>
	<!-- END commerce -->
</table>
</div>