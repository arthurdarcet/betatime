<div class="block">
	<h4>Listes des joueurs</h4>
	<p>{PAGES}</p>
	<table class="bordure" width="100%">
	<tr>
		<td><a href="index.php?page=list_attaque&ordre=user&asc={USER_ASC}">Nom</a></td>
		<td><a href="index.php?page=list_attaque&ordre=grade&asc={GRADE_ASC}">Grade</a></td>
		<td><a href="index.php?page=list_attaque&ordre=terrain&asc={TERRAIN_ASC}">Terrain</a></td>
		<td><a href="index.php?page=list_attaque&ordre=alliance&asc={ALLI_ASC}">Alliance</a></td>
		<td><a href="index.php?page=list_attaque&ordre=victoire&asc={VIC_ASC}">Victoires</a></td>
		<td><a href="index.php?page=list_attaque&ordre=defaite&asc={DEF_ASC}">Défaites</a></td>
		<td></td>
	</tr>
	<!-- BEGIN attaque -->
	<tr>
		<td>{attaque.NOM}</td>
		<td>{attaque.GRADE}</td>
		<td>{attaque.TERRAIN}</td>
		<td>{attaque.ALLIANCE}</td>
		<td>{attaque.VIC}</td>
		<td>{attaque.DEF}</td>
		<td>
			<form method="post" action="?page=rapport_attaque">
				<input type="hidden" name="id" value="{attaque.ID}" />
				<input type="submit" value="Attaquer" {attaque.BOUTON} />
			</form>
		</td>
	</tr>
	<!-- END attaque -->
	</table>
</div>