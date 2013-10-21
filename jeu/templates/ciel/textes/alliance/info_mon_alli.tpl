<div class="block">
<h4>Information sur votre alliance : {NOM}</h4>

<table width="100%" height="100%" border="0">
  <tr>
    <td width="50%"><img src="{IMG}" alt="{NOM}" width="49%"  height="49%" border="0" /></td>
    <td width="50%">
		<div align="left">	
	<p>Nom : {NOM}</p>
	<p>Nombre de membre(s) : {NBR_MEMBRE}</p>
	<p>Chef actuel : {CHEF}</p>
	<p>Créateur : {CREATEUR}</p>
	<p>Date de cr&eacute;ation  : {CREATION}</p>
	<p>Site web : <a href="{SITE}">{SITE}</a></p>
	<p>{QUITER_DISSOUDRE}</p>
</div>
		  </td>
  </tr>
</table>
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