<div class="block">
	<h4>Infos sur votre alliance</h4>
	<p>Nom : {NOM}</p>
	<p>Nombre de membre : {NBR_MEMBRE}</p>
	<p>Chef : {CHEF}</p>
	<p>Créateur : {CREATEUR}</p>
	<p>Ancienneté : {ANCIENNETE}</p>
	<p>Site web : <a href="{SITE}">{SITE}</a></p>
	<p><a href="?page=description_alli&alli={NOM}">Description complete de votre alliance</a></p>
	<p><a href="scripts/quiter_alli.php"><input type="button" value="Quiter cette alliance" /></a></p>
</div>
<div class="block">
	<h4>Membres de votre allliance</h4>
	<table class="bordure">
		<tr>
			<th>Pseudo</th>
			<th>Grade</th>
			<th>Ancienneté</th>
			<th>Dernière visite</th>
		</tr>
		<!-- BEGIN list_membre -->
		<tr>
			<td><a href="">{list_membre.USER}</a></td>
			<td>{list_membre.GRADE}</td>
			<td>{list_membre.ANCIENNETE}</td>
			<td>{list_membre.LAST_VISITE}</td>
		</tr>
		<!-- END list_membre -->
	</table>
</div>