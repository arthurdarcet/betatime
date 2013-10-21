<div class="block">
	<h4>Recherche par pseudo</h4>
	<p>Cette recherche par joueur vous permettra de connaître différentes actions accomplies par le joueur comme par les attaques et le commerce. Et donc anéantir la triche sur Betatimes.</p>
	<p>De plus, vous pouvez trier les résultats de la recherche, les critères de sélection de votre manière.</p>
	<form method="post" action="?page=panel&amp;p2=recherche_joueur">
		<table border="0">
			<tr>
				<td><p>Recherche</p></td>
				<td><input type="text" name="pseudo_recherche"/></td>
			</tr>
			<tr>
				<td>Dans : </td>
				<td><select name="champ">
					<option value="user" selected="selected">Pseudo</option>
					<option value="iduser">ID</option>
					<option value="ip">IP</option>
					<option value="mail">E-mail</option>
				</select>
				</td>
			</tr>
			<tr>
				<td><p>Critère de recherche principal</p></td>
				<td>
				<select name="type">
					<option value="1" selected="selected">...contenant</option>
					<option value="2">...commençant par</option>
					<option value="3">...terminant par</option>
					<option value="4">Valeur exacte</option>
				</select>
				</td>
			</tr>
			<tr>
				<td><p>Trier par ...</p></td>
				<td>
				<select name="tri">
					<option value="user" selected="selected">Pseudo</option>
					<option value="mail">E-mail</option>
					<option value="ip">IP</option>
				</select>				</td>
			</tr>
			<tr>
				<td>Ordre ..</td>
				<td>
				<select name="ordre">
					<option value="asc" selected="selected">Croissant</option>
					<option value="desc">Décroissant</option>
				</select>				</td>
			</tr>
		</table>
		 <input type="submit" value="Rechercher" />
	</form>
</div>