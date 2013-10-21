<div class="block" >
<h4>Effectuer un dons à un joueur</h4>
<br />
<p>{TEXTE_ACCEUIL}</p>
<br />
<p><b>Dons possibles par jour</b> : <img src="templates/ciel/images/ressources/beta.gif" alt="Beta" />{NBR_BETA}</p>
<br />
<p><strong>Dons effectués aujourd'hui : </strong></p>
	<!-- BEGIN liste -->
		<p>- {liste.HEURE} : à {liste.RECEVEUR} pour un montant de <img src="templates/ciel/images/ressources/beta.gif" alt="Beta" />{liste.MONTANT} </p>
	<!-- END liste -->
<br />
<!-- BEGIN form -->
	<form action="{form.CIBLE}" method="post">
		<table border="0" width="95%">
			<tr>
				<td><p>Nombre de Beta à donner</p> </td>
				<td><input name="nbr_dons_bt" type="text"/></td>
			</tr>
			<tr>
				<td><p>Destinataire du dons</p></td>
				<td><input name="destinataire_dons_bt" type="text"/></td>
			</tr>
		</table>
		<input type="submit" value="Valider" />
  </form>
<!-- END form -->
<p style="color:#CC3300;">{TEXT}</p>
</div>