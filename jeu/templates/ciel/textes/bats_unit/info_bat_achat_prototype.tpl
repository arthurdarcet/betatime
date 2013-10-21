<div class="block">
	<h4>D&eacute;velopper des prototypes</h4>
		<p>Avant de crée des unités, vous serez obligé de les développer ici. Vous pourrez trouvez les unités à développer, elles sont classées en quatre catégories : les Hommes, les Cyborgs, les Modules et les Capsules.<br /></p>
		
		<p>- Les Hommes :</p>
			<ul>
			<!-- BEGIN list_unit_hommes -->
			  <li>
			  <form method="post" action="#">
			  <p>D&eacute;velopper <a href="?page=info_batunit&class=unit&id={list_unit_hommes.ID}" title="Fiche de {list_unit_hommes.NOM}">{list_unit_hommes.NOM}</a>(Prix : <img src="templates/ciel/images/ressources/beta.gif" alt="Beta" title="Beta"/> {list_unit_hommes.PRIX} ; Temps : {list_unit_hommes.DUREE} heure(s))
				<input type="submit" value="Valider" />
			  <input type="hidden" name="id_achat_proto_dvpt" value="{list_unit_hommes.ID}" /></p>
			  </form></li>
			<!-- END list_unit_hommes -->
			</ul> 
		<p>- Les Capsules :</p>
			<ul>
			<!-- BEGIN list_unit_capsules -->
			  <li>
			  <form method="post" action="#">
			  <p>D&eacute;velopper <a href="?page=info_batunit&class=unit&id={list_unit_capsules.ID}" title="Fiche de {list_unit_capsules.NOM}">{list_unit_capsules.NOM}</a>(Prix : <img src="templates/ciel/images/ressources/beta.gif" alt="Beta" title="Beta"/> {list_unit_capsules.PRIX} ; Temps : {list_unit_capsules.DUREE} heure(s))
				<input type="submit" value="Valider" />
			  <input type="hidden" name="id_achat_proto_dvpt" value="{list_unit_capsules.ID}" /></p>
			  </form></li>
			<!-- END list_unit_capsules -->
			</ul> 
		<p>- Les Cyborgs :</p>
			<ul>
			<!-- BEGIN list_unit_cyborgs -->
			  <li>
			  <form method="post" action="#">
			  <p>D&eacute;velopper <a href="?page=info_batunit&class=unit&id={list_unit_cyborgs.ID}" title="Fiche de {list_unit_cyborgs.NOM}">{list_unit_cyborgs.NOM}</a>(Prix : <img src="templates/ciel/images/ressources/beta.gif" alt="Beta" title="Beta"/> {list_unit_cyborgs.PRIX} ; Temps : {list_unit_cyborgs.DUREE} heure(s))
				<input type="submit" value="Valider" />
			  <input type="hidden" name="id_achat_proto_dvpt" value="{list_unit_cyborgs.ID}" /></p>
			  </form></li>
			<!-- END list_unit_cyborgs -->
			</ul> 
		
		<p>- Les Modules :</p>
			<ul>
			<!-- BEGIN list_unit_modules -->
			  <li>
			  <form method="post" action="#">
			  <p>D&eacute;velopper <a href="?page=info_batunit&class=unit&id={list_unit_modules.ID}" title="Fiche de {list_unit_modules.NOM}">{list_unit_modules.NOM}</a>(Prix : <img src="templates/ciel/images/ressources/beta.gif" alt="Beta" title="Beta"/> {list_unit_modules.PRIX} ; Temps : {list_unit_modules.DUREE} heure(s))
				<input type="submit" value="Valider" />
			  <input type="hidden" name="id_achat_proto_dvpt" value="{list_unit_modules.ID}" /></p>
			  </form></li>
			<!-- END list_unit_modules -->
			</ul> 
</div>