<div class="block">
	<h4>Membres ayant déposé leur candidature pour votre alliance</h4>
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
			<td><form method="post" action="#" name="cand_{list_membre.IDUSER}">
				<input type="hidden" name="iduser" value="{list_membre.IDUSER}" />
				<input type="submit" value="Accepter" />
			</form></td>
		</tr>
		<!-- END list_membre -->
	</table>
</div>