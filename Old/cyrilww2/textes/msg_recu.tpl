<div class="block">
<table width="100%" align="center">
	<tr>
		<th class="bordure">Date d'envoi</th>
		<th class="bordure">Expediteur</th>
		<th class="bordure"></th>
	</tr>
	<!-- BEGIN mess -->
	<tr>
		<td class="bordure">Le {mess.DATE}</td>
		<td class="bordure">{mess.EXPEDITEUR}</td>   
		<td class="bordure"><a href="index.php?page=traitement_msg&action=lire_msg&id={mess.ID}">Lire</a> - <a href="index.php?page=envoyer_message&destinataire={mess.EXPEDITEUR}">R&eacute;pondre</a> - <a href="index.php?page=traitement_msg&action=del_message&id={mess.ID}">Supprimer</a></td>
	</tr>
	<!-- END mess -->
</table>
</div>