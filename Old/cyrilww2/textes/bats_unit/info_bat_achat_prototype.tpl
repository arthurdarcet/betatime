<div class="block">
	<h4>Acheter des prototypes</h4>
	<table>
			<tr><td></td></tr>
		<!-- BEGIN list_unit -->
			<tr>
				<td>
					<form method="post" action="scripts/achat.php" name="achat_unit">
						<p>Acheter <input type="text" name="nbr" size="4" maxlength="5" /> {list_unit.NOM} à <img src="images/ressources/beta.gif" alt="beta" />{list_unit.PRIX} l'unité <input type="submit" value="Valider" /></p>
						<input type="hidden" name="id" value="{list_unit.ID}" />
					</form>
				</td>
			</tr>
		<!-- END list_unit -->
	</table>
	{ACHAT_ELSE}
</div>