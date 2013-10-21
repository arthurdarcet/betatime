<ul id="udm" class="udm">
	<li><a href="index.php" title="Ma base">Ma base</a>
	</li>
	<li><a href="index.php">Constructions</a>
		<ul>
			<li><a class="nohref">Economie</a>
				<ul>
					<!-- BEGIN eco -->
					<li><a href="?page=info_batunit&class=bat&id={eco.ID}">{eco.NOM}</a></li>
					<!-- END eco -->
				</ul>			
			</li>
			<li><a class="nohref">Militaire</a>
				<ul>
				<li><a class="nohref">Défense</a>
					<ul>
						<!-- BEGIN def -->
						<li><a href="?page=info_batunit&class=bat&id={def.ID}">{def.NOM}</a></li>
						<!-- END def -->
					</ul>
				</li>
				<li><a class="nohref">Creation d'unité</a>
					<ul>
						<li><a class="nohref">Prototypes</a>
							<ul>
								<!-- BEGIN proto -->
								<li><a href="?page=info_batunit&class=bat&id={proto.ID}">{proto.NOM}</a></li>
								<!-- END proto -->
							</ul>
						</li>
						<li><a class="nohref">Clonage</a>
							<ul>
								<!-- BEGIN clone -->
								<li><a href="?page=info_batunit&class=bat&id={clone.ID}">{clone.NOM}</a></li>
								<!-- END clone -->
							</ul>
						</li>
					</ul>
				</li>
				<li><a class="nohref">Stockage</a>
				<ul>
					<!-- BEGIN stock -->
					<li><a href="?page=info_batunit&class=bat&id={stock.ID}">{stock.NOM}</a></li>
					<!-- END stock -->
				</ul>
			</li>
				</ul>
			</li>		
		</ul>
	</li>
	<li><a href="index.php?page=messagerie">Messagerie</a>
		<ul>
			<li><a href="index.php?page=traitement_msg&action=envoyer_message">Ecrire un message</a>
			</li>
			<li><a href="index.php?page=msg_recu">Messages reçu(s)</a>
			</li>			
		</ul>
	</li>
	<li><a href="index.php?page=alliance">Votre Alliance</a>
		<ul>
			{ALLI}
			{SUP_5}
			<li><a href="?page=list_alli">Listes des alliances</a></li>
		</ul>
	</li>
	<li><a href="?page=commerce">Commerce</a></li>
	<li><a href="?page=attaque">Attaque</a></li>
	<li><a href="index.php?page=options">Options</a></li>
	<li><a href="index.php?page=objectifs">Objectifs</a></li>
	{ADMIN}
	<li><a href="textes/deconnexion.php">Me déconnecter</a></li>
</ul>