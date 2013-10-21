<div class="block">
	<h4>Résultat(s) de la recherche par pseudo</h4>
	<p>Nombre de résultat(s) pour "{RECHERCHE}" : {NBR_RESULAT}</p>
	
	<table class="bordure" width="100%">
		<tr>
			<th class="bordure">ID</th>
			<th class="bordure">Pseudo</th>
			<th class="bordure">Mail</th>
			<th class="bordure">IP</th>
			<th class="bordure">Dernière visite</th>
		</tr>
		<!-- BEGIN info -->
		<tr>
			<td class="bordure">{info.ID}</td>
			<td class="bordure"><a href="?page=panel&amp;p2=info_joueur&amp;id={info.ID}" title="Cliquez ici pour en savoir plus sur {info.PSEUDO}">{info.PSEUDO}</a></td>
			<td class="bordure"><img src="templates/ciel/images/mail.png" title="Mail"  alt="Mail"/> {info.MAIL}</td>
			<td class="bordure">{info.IP}</td>
			<td class="bordure">{info.DER_VISITE}</td>
		</tr>
		<!-- END info -->
	</table>
</div>