<div class="block">
	<h4>Liste des alliances</h4>
	<p>Note : Si vous avez atteint le grade 5 et que vous désirez créer votre alliance, rendez-vous <a href="">ici</a></p>
	<table width="100%" class="bordure">
		<tr>
			<th>Classement</th>
			<th>Nom de l'alliance</th>
			<th>Chef en poste</th>
			<th>Nombre de membres</th>
			<th>-</th>
		</tr>
		<!-- BEGIN list_alli -->
		<tr>
			<td>{list_alli.CLASSEMENT}</td>
			<td><a href="?page=description_alli&alli={list_alli.NOM}">{list_alli.NOM}</a></td>
			<td>{list_alli.CHEF}</td>
			<td><a href="#" onClick="WindowsOpen(...)">{list_alli.NBR_MEMBRE}</a></td>
			<td>
				<form action="scripts/poser_candidature.php" method="post">
					<input type="submit" value="Poser sa candidature" />
					<input type="hidden" name="alli" value="{list_alli.NOM}" />
				</form>
			</td>
		</tr>
		<!-- END list_alli -->
	</table>
</div>