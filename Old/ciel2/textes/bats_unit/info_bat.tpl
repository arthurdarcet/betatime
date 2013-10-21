<div class="block">
	<h4>{NOM}</h4>
	<table>
		<tr>
			<td><img src="templates/ciel/images/bat/{NAME_IMAGE}.jpg" alt="{Nom}" height="120" width="130"/></td>
			<td>{COMMENT}</td>
		</tr>
		<tr>
			<td colspan="2">
			<p>Prix :&nbsp; <img src="templates/ciel/images/ressources/beta.gif" alt="beta" />{PRIX}</p>
			<p>En possession : {NBR_POSSESSION}</p>
			</td>
		</tr>
	</table>
</div>
{CONSO_PROD_CAPACITE_ATTDEF}
<div class="block">
	<h4>Acheter ou vendre un(e)/des {NOM}</h4>
<!-- BEGIN achat -->
<form action="#" name="achat" method="post">
		<p> - Acheter 
		  <input name="nbr_bat" type="text" class="inputa" id="nbr_bat" value="1" size="4" maxlength="3" /> 
		{NOM}(s) pour <img src="templates/ciel/images/ressources/beta.gif" alt="beta" />{PRIX} par batiment(s) 
		<input type="hidden" name="id" value="{ID}" />
<input type="submit" value="Valider" class="inputa" /></p>
  </form>
<!-- END achat -->
<p>{ACHAT_ELSE}</p>
<!-- BEGIN vente -->
<form action="#" name="vendre" method="post">
		<p> - Vendre 
		  <input name="vente_nbr_bat" type="text" class="inputa" id="vente_nbr_bat" value="1" size="4" maxlength="3" /> 
		{NOM}(s) pour <img src="templates/ciel/images/ressources/beta.gif" alt="beta" />{vente.NEW_PRIX}({vente.PERTE} du prix &agrave; l'achat ) par batiment(s) 
		<input type="hidden" name="id" value="{ID}" />
<input type="submit" value="Valider" class="inputa" /></p>
  </form>
<!-- END vente -->
{VENTE_ELSE}
</div>
{ACHAT_PROTOTYPE}
{PROTO_EN_COURS_DE_DEVELOPEMENT}
{ACHAT_CLONE}