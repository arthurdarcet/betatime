<div class="block">
	<h4>{NOM}</h4>
	<table>
		<tr>
			<td><img src="templates/ciel/images/unit/{NAME_IMAGE}.jpg" alt="{.NOM}" title="{NOM}" width="130" height="120" /></td>
			<td>{COMMENT}</td>
		</tr>
		<tr>
			<td colspan="2">
				<p>Prix :&nbsp; <img src="templates/ciel/images/ressources/beta.gif" alt="Beta" title="Beta" />{PRIX}</p>
				<p>En possession : {NBR} {NOM}(s)</p>
			</td>
		</tr>
	</table>

</div>
{CONSO_ATT_DEF}
<div class="block">
	<h4>Acheter un clone</h4>
{ACHAT_PROTO}
{ACHAT_CLONE_ELSE}
<!-- BEGIN achat -->
	<form action="#"  method="post">
		<p>- Cr&eacute;er 
		  <input name="nbr_unit" type="text" value="1" size="4" maxlength="5"> 
	      {achat.NOM}(s) à <img src="templates/ciel/images/ressources/beta.gif" alt="beta" title="Beta" />{achat.PRIX} l'unit&eacute;
		  <input name="id_unit" value="{achat.ID}" type="hidden" />
		  <input value="Valider" type="submit"></p>
  </form>
<!-- END achat -->
</div>