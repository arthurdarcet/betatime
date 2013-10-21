<div class="block">
	<h4>Choisissez un thème</h4>
	<form method="post" action="scripts/change_theme.php" name="skin">
		<p><select class="inputa" name="theme">
			<!-- BEGIN list_theme -->
			<option  value="{list_theme.NOM_COURT}">{list_theme.NOM_LONG}</option>
			<!-- END list_theme -->
		</select>
		<input type="submit" value="Ok" class="inputa" /></p>
	</form>
</div>