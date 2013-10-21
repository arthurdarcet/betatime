<form method="post" action="#">
	<div class="block">
		<h4>Changer son mot de passe</h4>
		<table>
			<tr><td>Mot de passe actuel </td><td><input type="password" name="ancien_mdp" /></td></tr>
			<tr><td>Nouveau mot de passe </td><td><input type="password" name="new_mdp" /></td></tr>
			<tr><td>Retapez le nouveau mot de passe </td><td><input name="new_mdp2" type="password" /></td></tr>
			<tr><td></td><td><input type="submit" value="Valider" /></td></tr>
		</table>
	</div>
</form>
{THEME}
<form method="post" action="#">
<div class="block">
	<h4>Changer de page d'accueil</h4>
	<p>Un nouveau système permettant de naviguer partout sur internet tout en surveillant vos ressources Beta - Times a été mis en place.</p>
	<p>Vous pouvez ici changer votre page d'accueil</p>
	<p>Page d'accueil : <input name="page_accueil" type="text" value="{PAGE_ACCUEIL}" size="50" />
	<input type="submit" value="Valider" /></p>
</div>
</form>