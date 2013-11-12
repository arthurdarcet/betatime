<div class="block">
	<h4>Informations concernant {PSEUDO}</h4>
	<p>Ces informations sont confidentiels et ne doivent �tre divulgu�es � personne.</p>
</div>
	<div class="block">
		<h4>Les dons</h4>
		<p>Les dons sont source de triche. Il faut verifier les IP vers lesquels ont �t� effectu�s les dons. L'IP actuel si le dons est r�cent ou consult� la liste des IP du donneur et du receveur au moment du don.</p>
		<h4>Dons effectu�s</h4>
			<table class="bordure">
				<tr>
					<th class="bordure">R�cepteur du don</th>
					<th class="bordure">Montant</th>
					<th class="bordure">Date</th>
				</tr>
				<!-- BEGIN dons_eff -->
				<tr>
					<td  class="bordure"><a href="?page=panel&amp;p2=info_joueur&amp;id={dons_eff.ID_RECEVEUR}" title="Informations de {dons_eff.RECEVEUR}">{dons_eff.RECEVEUR}</a></td>
					<td  class="bordure"><img src="templates/ciel/images/ressources/{dons_eff.TYPE}.gif" alt="{dons_eff.TYPE}" title="{dons_eff.TYPE}" /> {dons_eff.NBR}</td>
					<td  class="bordure">{dons_eff.DATE}</td>
				</tr>
				<!-- END dons_eff -->
			</table>
		<h4>Dons re�us</h4>
			<table class="bordure">
				<tr>
					<th class="bordure">Donneur du don</th>
					<th class="bordure">Montant</th>
					<th class="bordure">Date</th>
				</tr>
				<!-- BEGIN dons_recu -->
				<tr>
					<td  class="bordure"><a href="?page=panel&amp;p2=info_joueur&amp;id={dons_recu.ID_DONNEUR}" title="Informations de {dons_eff.RECEVEUR}">{dons_recu.DONNEUR}</a></td>
					<td  class="bordure"><img src="templates/ciel/images/ressources/{dons_recu.TYPE}.gif" alt="{dons_recu.TYPE}" title="{dons_recu.TYPE}" /> {dons_recu.NBR}</td>
					<td  class="bordure">{dons_recu.DATE}</td>
				</tr>
				<!-- END dons_recu -->
			</table>
	</div>
	<div class="block">
		<h4>Les attaques</h4>
		<p>Dans les attaques, on peut trouv� des attaques o� le d�fenseur ne poss�de pas de d�fenses et donc, l'attaquant peut piller des ressources. C'est la principale triche !<br />PS : Si vous avez besoin du rapport, veuillez le demander � un admins avec l'ID de l'attaque !</p>
		
				<h4>Attaques effectu�es</h4>
			<table class="bordure">
				<tr>
					<th class="bordure">ID</th>
					<th class="bordure">D�fenseur</th>
					<th class="bordure">Gagnant</th>
					<th class="bordure">Date</th>
				</tr>
				<!-- BEGIN attaque_eff -->
				<tr>
					<td class="bordure">{attaque_eff.ID}</td>
					<td  class="bordure"><a href="?page=panel&amp;p2=info_joueur&amp;id={attaque_eff.ID_DEFENSEUR}" title="Informations de {attaque_eff.DEFENSEUR}">{attaque_eff.DEFENSEUR}</a></td>
					<td  class="bordure"><a href="?page=panel&amp;p2=info_joueur&amp;id={attaque_eff.ID_GAGNANT}" title="Informations de {attaque_eff.GAGNANT}">{attaque_eff.GAGNANT}</a></td>
					<td  class="bordure">{attaque_eff.DATE}</td>
				</tr>
				<!-- END attaque_eff -->
			</table>
		<h4>Attaques re�ues</h4>
			<table class="bordure">
				<tr>
					<th class="bordure">ID</th>
					<th class="bordure">D�fenseur</th>
					<th class="bordure">Gagnant</th>
					<th class="bordure">Date</th>
				</tr>
				<!-- BEGIN attaque_recu -->
				<tr>
					<td class="bordure">{attaque_recu.ID}</td>
					<td  class="bordure"><a href="?page=panel&amp;p2=info_joueur&amp;id={attaque_recu.ID_ATTAQUANT}" title="Informations de {attaque_recu.ATTAQUANT}">{attaque_recu.ATTAQUANT}</a></td>
					<td  class="bordure"><a href="?page=panel&amp;p2=info_joueur&amp;id={attaque_recu.ID_GAGNANT}" title="Informations de {attaque_recu.GAGNANT}">{attaque_recu.GAGNANT}</a></td>
					<td  class="bordure">{attaque_recu.DATE}</td>
				</tr>
				<!-- END attaque_recu -->
			</table>
	</div>
	<div class="block">
		<h4>Le commerce</h4>
		<p>A la fa�con des attaques et des dons, les joueurs s'�changent encore plus facilement des ressources par le commerce sans limites et sans risques avec les attaques de pertes. Malgr� que les ips soient v�rifi�s, il reste des failles !<br />PS : Si la date de dur�e de lot est chang�e, il faut pens� � la modifi�e ici !</p>
		
		<h4>Lots du commerce vendus</h4>
			<table class="bordure">
				<tr>
					<th class="bordure">ID</th>
					<th class="bordure">Acheteur</th>
					<th class="bordure">Type et Nbr</th>
					<th class="bordure">Prix</th>
					<th class="bordure">Prix unit.</th>
					<th class="bordure">Ajout du lot</th>
					<th class="bordure">Achat du lot</th>
				</tr>
				<!-- BEGIN commerce_vendu -->
				<tr>
					<td class="bordure">{commerce_vendu.ID}</td>
					<td class="bordure"><a href="?page=panel&amp;p2=info_joueur&amp;id={commerce_vendu.ID_ACHETEUR}" title="Informations de {commerce_vendu.ACHETEUR}">{commerce_vendu.ACHETEUR}</a></td>
					<td class="bordure"><img src="templates/ciel/images/ressources/{commerce_vendu.TYPE}.gif" alt="{commerce_vendu.TYPE}" title="{commerce_vendu.TYPE}" /> {commerce_vendu.NBR}</td>
					<td class="bordure"><img src="templates/ciel/images/ressources/beta.gif" alt="Beta" title="Beta" />{commerce_vendu.PRIX}</td>
					<td class="bordure">{commerce_vendu.PRIX_UNIT}</td>
					<td class="bordure">{commerce_vendu.AJOUT}</td>
					<td class="bordure">{commerce_vendu.ACHAT}</td>
				</tr>
				<!-- END commerce_vendu -->
			</table>
		<h4>Lots du commerce achet�s</h4>
			<table class="bordure">
				<tr>
					<th class="bordure">ID</th>
					<th class="bordure">Vendeur</th>
					<th class="bordure">Type et Nbr</th>
					<th class="bordure">Prix</th>
					<th class="bordure">Prix unit.</th>
					<th class="bordure">Ajout du lot</th>
					<th class="bordure">Achat du lot</th>
				</tr>
				<!-- BEGIN commerce_achete -->
				<tr>
					<td class="bordure">{commerce_achete.ID}</td>
					<td class="bordure"><a href="?page=panel&amp;p2=info_joueur&amp;id={commerce_achete.ID_VENDEUR}" title="Informations de {commerce_achete.VENDEUR}">{commerce_achete.VENDEUR}</a></td>
					<td class="bordure"><img src="templates/ciel/images/ressources/{commerce_achete.TYPE}.gif" alt="{commerce_achete.TYPE}" title="{commerce_achete.TYPE}" /> {commerce_achete.NBR}</td>
					<td class="bordure"><img src="templates/ciel/images/ressources/beta.gif" alt="Beta" title="Beta" />{commerce_achete.PRIX}</td>
					<td class="bordure">{commerce_achete.PRIX_UNIT}</td>
					<td class="bordure">{commerce_achete.AJOUT}</td>
					<td class="bordure">{commerce_achete.ACHAT}</td>
				</tr>
				<!-- END commerce_achete -->
			</table>
	</div>
	<div class="block">
		<h4>Les Hack</h4>
		<p>Betatimes poss�de un script qui enregistre chaque tentative de hack du joueur. <br /> {PSEUDO} poss�de {HACK} alertes(s) de hackage du site !</p>
	</div>
	<div class="block">
		<h4>Autre infos(IP)</h4>
	</div>