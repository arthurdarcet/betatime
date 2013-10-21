<div class="block">
<h4>Liste des news</h4>
<table border="0" width="95%">
	<tr>
		<th class="bordure">Titre</th>
		<th class="bordure">Créateur</th>
		<th class="bordure"> / </th>
	</tr>
	<!-- BEGIN news -->
		<tr>
			<td class="bordure">{news.TITRE}</td>
			<td class="bordure">{news.CREATEUR}</td>
			<td class="bordure"><a href="?page=admin&p2=news_add&id={news.ID}" title="{news.CONTENU}">Modifier</a></td>
		</tr>
	<!-- END news -->
</table>
</div>