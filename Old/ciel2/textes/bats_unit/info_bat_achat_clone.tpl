<div class="block">
	<h4>Produire des {TYPE} </h4>
		<!-- BEGIN list_unit -->
					<form method="post" action="#">
					<p>Créer <input name="nbr_unit" type="text" value="1" size="4" maxlength="5" />  
					 un(e) {list_unit.NOM} à <img src="templates/ciel/images/ressources/beta.gif" alt="beta" /> {list_unit.PRIX} le clone 
					  <input type="hidden" name="id_unit" value="{list_unit.ID}" /><input type="submit" value="Valider" /></p>
					</form>				
		<!-- END list_unit -->
	{ACHAT_ELSE}
</div>