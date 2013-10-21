<div class="block">
<h4>Vos batiments de production</h4>
	<table class="bordure"  width="100%">
		<tr>
			<th class="bordure">Nbr</th>
			<th class="bordure">Nom du batiment</th>
			<th class="bordure">Production</th>
			<th class="bordure">Consommation</th>
		</tr>
		<!-- BEGIN bats_prod -->
		<tr>
			<td class="bordure">{bats_prod.NBR}</td>
			<td class="bordure"><a href="index.php?page=info_batunit&amp;class=bat&amp;id={bats_prod.ID}">{bats_prod.NOM}</a></td>
			<td class="bordure">{bats_prod.PROD}</td>
			<td class="bordure">{bats_prod.CONSO}</td>
		</tr>
		<!-- END bats_prod -->
	</table>
</div>
<div class="block">
<h4>Vos batiments militaires</h4>
	<table class="bordure" width="100%">
		<tr>
			<th class="bordure">Nbr</th>
			<th class="bordure">Nom du batiment</th>
			<th class="bordure">Attaque / Défense</th>
			<th class="bordure">Consommation</th>
		</tr>
		<!-- BEGIN bats_militaires -->
		<tr>
			<td class="bordure">{bats_militaires.NBR}</td>
			<td class="bordure"><a href="index.php?page=info_batunit&amp;class=bat&amp;id={bats_militaires.ID}">{bats_militaires.NOM}</a></td>
			<td class="bordure"><div align="center">{bats_militaires.ATT_DEF}</div></td>
			<td class="bordure">{bats_militaires.CONSO}</td>
		</tr>
		<!-- END bats_militaires -->
	</table>
</div>