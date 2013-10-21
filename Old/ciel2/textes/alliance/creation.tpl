<div class="block">
<h4>Créer une alliance</h4>
<table width="100%"  height="75%" border="0">
<form method="post" action="index.php?page=alliance&&p2=creation">
	<tr>
		<td colspan="2"><p class="small">Note : total de membres possibles : <b>{MBR_MAX}</b>.</p></td>
	</tr>
	<tr>
    	<td><p>Nom de l'alliance : </p></td><td><input name="nom" value="{NOM}" type="text" size="30" maxlength="50" /></td>
	</tr>
	<tr>
		<td><p>Site web :</p></td><td><input name="site_web" type="text" value="{SITE}" size="30"></td>
	</tr>
	<tr>
		<td>
			<p>Type de l'alliance : </p>
		</td>
		<td>
			<select name="type">
               	<option selected="selected">Type</option>
	    		<option name="type" value="Academie">Academie</option>
				<option name="type" value="Guerrière">Guerrière</option>
				<option name="type" value="Commerciale">Commerciale</option>
			</select>
		</td>
	<tr>
		<td colspan="2">
		  <p>Description : </p>
            <textarea name="description" cols="60" rows="4">{DESCRIPTION}</textarea>
		</td>
	</tr>
	<tr>
		<td  colspan="2"><div align="center">
		  <input type="submit" value="Valider" />
	  </div></td>
	</tr>
</form>
</table>
</div>