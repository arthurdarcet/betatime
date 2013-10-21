<div class="block">
	<h4>{NOM}</h4>
	<table>
		<tr>
			<td><img src="templates/ciel/images/bat/{NAME_IMAGE}.jpg" alt="{Nom}" height="120" width="130"/></td>
			<td>{COMMENT}</td>
		</tr>
		<tr>
			<td>Prix :</td>
			<td>&nbsp; <img src="images/ressources/beta.gif" alt="beta" />{PRIX}</td>
		</tr>
	</table>
</div>
{CONSO_PROD_CAPACITE_ATTDEF}
<div class="block">
	<h4>Acheter un(e) {NOM}</h4>
	<form action="scripts/achat.php" name="achat" method="post">
		<p>Acheter <input type="text" size="4" maxlength="5" name="nbr" class="inputa" /> pour <img src="images/ressources/beta.gif" alt="beta" />{PRIX} par batiments <input type="submit" value="Valider" class="inputa" /></p>
		<input type="hidden" name="id" value="{ID}" />
	</form>
</div>
{ACHAT_PROTOTYPE}
{ACHAT_CLONE}