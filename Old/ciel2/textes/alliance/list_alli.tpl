<div class="block">
	<h4>Liste des alliances</h4>
	{CREATION_ALLI}
	<p>{PAGES}</p>
	<table widtd="100%" class="bordure">
		<tr>
			<td><a href="index.php?page=alliance&p2=liste_alliance&p3={PAGE}&ordre=nom&asc={USER_ASC}">Nom de l'alliance</a></td>
			<td><a href="index.php?page=alliance&p2=liste_alliance&p3={PAGE}&ordre=type&asc={TYPE_ASC}">Type</a></td>
			<td><a href="index.php?page=alliance&p2=liste_alliance&p3={PAGE}&ordre=chef&asc={CHEF_ASC}">Chef en poste</a></td>
			<td><a href="index.php?page=alliance&p2=liste_alliance&p3={PAGE}&ordre=nbr_membre&asc={NBR_MEMBRE_ASC}">Nombre de membres</a></td>
			<td><a href="index.php?page=alliance&p2=liste_alliance&p3={PAGE}&ordre=nbr_max_membre&asc={USER_ASC}">Nombre max de membre</a></td>
			<td>-</td>
		</tr>
		<!-- BEGIN list_alli -->
		<tr>
			<td><a href="?page=alliance&p2=info&alli={list_alli.NOM}">{list_alli.NOM}</a></td>
			<td>{list_alli.TYPE}</td>
			<td>{list_alli.CHEF}</td>
			<td>{list_alli.NBR_MEMBRE}</td>
			<td>{list_alli.NBR_MAX_MEMBRE}</td>
			<td>{list_alli.REJOINDRE}</td>
		</tr>
		<!-- END list_alli -->
	</table>
</div>