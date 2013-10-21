<div class="block" align="center">
<table>
	<form action="#" method="post">
		<tr>
			<td colspan="4"><h1 align="center">Nous contacter</h1></td>
		</tr>
		<tr>
		  <td width="93" height="26"><p>Sujet :</p></td>
			<td width="214">
				<select name="sujet" size="1" style="font-size:13px; ">
					<option value="" selected></option>
					<option value="Probl&egrave;me technique">Probl&egrave;me technique</option>
					<option value="Bugs constat&eacute;">Bug constat&eacute;</option>
					<option value="Perte de mot de passe">Perte de mot de passe</option>
					<option value="Contestation d'un blocage de compte">Contestation d'un blocage de compte</option>
					<option value="Information">Information</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="79"><p> Ou, autre  : </p></td>
			<td width="130"><input name="sujet2" type="text" maxlength="40" height="15" /></td>
		</tr>
		<tr>
		  <td height="21"><p>Votre pseudo :</p></td>
			<td colspan="3"><input name="pseudo" type="text" value="{SESSION_USER}" maxlength="40" /></td>
		</tr>
		<tr>
		<td height="21"><p>Votre e-mail :</p></td>
			<td colspan="3"><input name="mail" type="text" value="" maxlength="40" /></td>
		</tr>
		<tr>
			<td colspan="4"><p>Votre message :</p></td>
		</tr>
		<tr>
		  <td height="72" colspan="4" align="center"><textarea name="mess" cols="50" rows="6"></textarea></td>
		</tr>
		<tr>
			<td colspan="4" align="center"><input type="submit" value="Envoyer le message" /></td>
		</tr>
	</form>
</table>
</div>