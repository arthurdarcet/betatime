-- MySQL dump 10.11
--
-- Host: sql    Database: betatime
-- ------------------------------------------------------
-- Server version	4.0.25-standard-log
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bt_alerte_historique`
--

DROP TABLE IF EXISTS `bt_alerte_historique`;
CREATE TABLE `bt_alerte_historique` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `iduser` smallint(5) unsigned NOT NULL default '0',
  `class` enum('annonce','histo') NOT NULL default 'histo',
  `type` varchar(30) NOT NULL default '',
  `id_type` smallint(5) unsigned default NULL,
  `phrase` text NOT NULL,
  `time` int(10) unsigned NOT NULL default '0',
  `vu` enum('non','oui') NOT NULL default 'non',
  PRIMARY KEY  (`id`),
  KEY `iduser` (`iduser`)
) TYPE=MyISAM COMMENT='les differentes allertes quand on se connecte';

--
-- Table structure for table `bt_alliance_list`
--

DROP TABLE IF EXISTS `bt_alliance_list`;
CREATE TABLE `bt_alliance_list` (
  `id` mediumint(10) unsigned NOT NULL auto_increment,
  `nom` varchar(100) NOT NULL default '',
  `type` varchar(50) NOT NULL default '',
  `nbr_membre` mediumint(6) unsigned NOT NULL default '0',
  `nbr_max_membre` mediumint(6) NOT NULL default '0',
  `grade_max` tinyint(4) NOT NULL default '0',
  `createur` mediumint(20) NOT NULL default '0',
  `date_creation` int(14) NOT NULL default '0',
  `description` longtext NOT NULL,
  `img` varchar(250) NOT NULL default '',
  `cotis` mediumint(10) NOT NULL default '127',
  `banque` int(20) unsigned NOT NULL default '0',
  `site` varchar(150) NOT NULL default '',
  `chef` mediumint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `nom` (`nom`)
) TYPE=MyISAM;

--
-- Table structure for table `bt_alliance_member`
--

DROP TABLE IF EXISTS `bt_alliance_member`;
CREATE TABLE `bt_alliance_member` (
  `id` mediumint(10) NOT NULL auto_increment,
  `iduser` int(11) NOT NULL default '0',
  `alliance` int(10) NOT NULL default '0',
  `chef` varchar(10) NOT NULL default 'false',
  `sous_chef` varchar(10) NOT NULL default 'false',
  `finances` varchar(10) NOT NULL default 'false',
  `interieur` varchar(10) NOT NULL default 'false',
  `accepte` varchar(10) NOT NULL default 'false',
  PRIMARY KEY  (`id`),
  KEY `accepte` (`accepte`),
  KEY `alliance` (`alliance`),
  KEY `chef` (`chef`),
  KEY `finances` (`finances`),
  KEY `iduser` (`iduser`),
  KEY `interieur` (`interieur`),
  KEY `sous_chef` (`sous_chef`)
) TYPE=MyISAM;


--
-- Table structure for table `bt_attaques_effectuees`
--

DROP TABLE IF EXISTS `bt_attaques_effectuees`;
CREATE TABLE `bt_attaques_effectuees` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `id_attaquant` smallint(5) unsigned NOT NULL default '0',
  `id_defenseur` smallint(5) unsigned NOT NULL default '0',
  `id_gagnant` smallint(5) unsigned NOT NULL default '0',
  `timestamp` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='Table contenant les attaques effectuées (pour la limite de u';

--
-- Table structure for table `bt_bat_user`
--

DROP TABLE IF EXISTS `bt_bat_user`;
CREATE TABLE `bt_bat_user` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `iduser` smallint(5) unsigned NOT NULL default '0',
  `idbat` tinyint(2) unsigned NOT NULL default '0',
  `class` enum('clone','def','prod','prototype','stockage') NOT NULL default 'clone',
  `nbr` smallint(5) unsigned NOT NULL default '0',
  `statut` enum('destructible','indestructible') NOT NULL default 'destructible',
  PRIMARY KEY  (`id`),
  KEY `idbat` (`idbat`)
) TYPE=MyISAM COMMENT='tous les bat que possede les joueurs';

--
-- Table structure for table `bt_clone_user`
--

DROP TABLE IF EXISTS `bt_clone_user`;
CREATE TABLE `bt_clone_user` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `idunit` tinyint(2) NOT NULL default '0',
  `iduser` smallint(5) unsigned NOT NULL default '0',
  `type_unit` enum('capsule','cyborg','homme','module') NOT NULL default 'capsule',
  `nbr` mediumint(7) unsigned NOT NULL default '0',
  `type` enum('clone','prototype') NOT NULL default 'prototype',
  PRIMARY KEY  (`id`),
  KEY `idunit` (`idunit`),
  KEY `iduser` (`iduser`)
) TYPE=MyISAM;


--
-- Table structure for table `bt_commerce`
--

DROP TABLE IF EXISTS `bt_commerce`;
CREATE TABLE `bt_commerce` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(30) NOT NULL default '',
  `nombre` float(20,1) NOT NULL default '0.0',
  `vendeur` int(11) NOT NULL default '0',
  `acheteur` int(11) NOT NULL default '0',
  `prix_unit` float(6,5) NOT NULL default '0.00000',
  `statut` varchar(20) NOT NULL default '',
  `expire` int(11) NOT NULL default '0',
  `ajout` int(11) NOT NULL default '0',
  `achat` int(11) NOT NULL default '0',
  `ipv` varchar(25) NOT NULL default '000.000.00.00',
  `ipa` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `achat` (`achat`),
  KEY `acheteur` (`acheteur`),
  KEY `ajout` (`ajout`),
  KEY `expire` (`expire`),
  KEY `id` (`id`),
  KEY `ipa` (`ipa`),
  KEY `ipv` (`ipv`),
  KEY `nombre` (`nombre`),
  KEY `prix_unit` (`prix_unit`),
  KEY `statut` (`statut`),
  KEY `type` (`type`),
  KEY `vendeur` (`vendeur`)
) TYPE=MyISAM COMMENT='Table contenant les vente en cours';

--
-- Table structure for table `bt_connectes`
--

DROP TABLE IF EXISTS `bt_connectes`;
CREATE TABLE `bt_connectes` (
  `id` int(11) NOT NULL auto_increment,
  `session` int(11) NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  `timestamp` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM PACK_KEYS=0;

--
-- Table structure for table `bt_dons`
--

DROP TABLE IF EXISTS `bt_dons`;
CREATE TABLE `bt_dons` (
  `id` int(11) NOT NULL auto_increment,
  `date` varchar(10) NOT NULL default '',
  `time` bigint(11) NOT NULL default '0',
  `id_donneur` int(11) NOT NULL default '0',
  `id_receveur` int(11) NOT NULL default '0',
  `nombre` int(11) NOT NULL default '0',
  `type_ress` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `date` (`date`),
  KEY `id` (`id`),
  KEY `id_donneur` (`id_donneur`),
  KEY `id_receveur` (`id_receveur`),
  KEY `nombre` (`nombre`),
  KEY `time` (`time`),
  KEY `type_ress` (`type_ress`)
) TYPE=MyISAM;

--
-- Table structure for table `bt_grade`
--

DROP TABLE IF EXISTS `bt_grade`;
CREATE TABLE `bt_grade` (
  `id` int(10) NOT NULL auto_increment,
  `grade` int(11) NOT NULL default '0',
  `type` varchar(50) NOT NULL default '',
  `idbat` int(11) NOT NULL default '0',
  `nbr` int(5) NOT NULL default '0',
  `phrase` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `grade` (`grade`),
  KEY `idbat` (`idbat`),
  KEY `nbr` (`nbr`),
  KEY `phrase` (`phrase`),
  KEY `type` (`type`)
) TYPE=MyISAM;

--
-- Dumping data for table `bt_grade`
--

LOCK TABLES `bt_grade` WRITE;
/*!40000 ALTER TABLE `bt_grade` DISABLE KEYS */;
INSERT INTO `bt_grade` VALUES (1,2,'bat',1,10,'10 Ateliers de frappe'),(2,2,'bat',2,2,'2 forages à eau'),(3,2,'bat',4,7,'7 panneaux solaires'),(16,4,'unit',9,100,'100 capsules B13'),(15,4,'unit',3,200,'200 assassins'),(14,4,'bat',1,30,'30 ateliers de frappe'),(13,4,'bat',5,5,'5 tourelles électriques'),(4,3,'unit',1,50,'50 hommes de main'),(5,3,'unit',2,50,'50 sentinelles'),(6,3,'bat',1,20,'20 ateliers de frappe'),(17,5,'bat',24,5,'5 centrales géothermiques'),(18,5,'bat',1,35,'35 ateliers de frappe'),(19,5,'unit',4,400,'400 Mercenaires d\'élites'),(20,5,'unit',5,200,'200 GERMY60'),(21,6,'unit',13,700,'700 Modules A1'),(22,6,'unit',16,200,'200 Modules IP7'),(23,6,'bat',1,40,'40 ateliers de frappe'),(24,7,'unit',14,700,'700 Modules A2'),(25,7,'unit',10,300,'300 modules GVS'),(26,7,'bat',1,45,'45 ateliers de frappe'),(27,8,'unit',6,700,'700 GERMY85'),(28,8,'unit',12,1000,'1000 unités des forces spéciales'),(29,9,'unit',7,2000,'2000 capsules R5A'),(30,10,'bat',15,20,'20 tourelles à dihydrogène'),(31,10,'bat',18,20,'20 mines d\'uranium'),(32,10,'unit',15,2000,'2000 modules A3'),(33,10,'unit',18,1000,'1000 cyborg JJ05'),(34,8,'bat',1,55,'55 ateliers de frappe'),(35,9,'bat',1,90,'90 ateliers de frappe'),(36,10,'bat',1,110,'110 ateliers de frappe'),(37,3,'victoire',0,25,'Posseder 20 victoires'),(38,4,'victoire',0,40,'Posseder 40 victoires'),(39,5,'victoire',0,100,'Posseder 100 victoires'),(40,6,'victoire',0,200,'Posseder 200 victoires'),(41,7,'victoire',0,400,'Posseder 400 victoires'),(42,8,'victoire',0,800,'Posseder 800 victoires'),(43,9,'victoire',0,1500,'Posseder 1500 victoires'),(44,10,'victoire',0,2000,'Posseder 2000 victoires'),(45,3,'defaite',0,18,'Ne pas possedez plus de 20 défaites'),(46,4,'defaite',0,15,'Ne pas posseder plus de 15 défaites');
/*!40000 ALTER TABLE `bt_grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bt_hack`
--

DROP TABLE IF EXISTS `bt_hack`;
CREATE TABLE `bt_hack` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(11) NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  `agent` varchar(249) NOT NULL default '',
  `adresse` varchar(249) NOT NULL default '',
  `motif` text NOT NULL,
  `times` int(11) NOT NULL default '0',
  `grave` tinyint(2) NOT NULL default '0',
  `justification` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `adresse` (`adresse`),
  KEY `ip` (`ip`)
) TYPE=MyISAM;


--
-- Table structure for table `bt_messagerie`
--

DROP TABLE IF EXISTS `bt_messagerie`;
CREATE TABLE `bt_messagerie` (
  `id` int(11) NOT NULL auto_increment,
  `destinataire` int(11) NOT NULL default '0',
  `expediteur` int(11) NOT NULL default '0',
  `contenu` text NOT NULL,
  `titre` varchar(100) NOT NULL default '',
  `date` varchar(50) NOT NULL default '',
  `statut` varchar(15) NOT NULL default 'non lu',
  KEY `id` (`id`),
  KEY `date` (`date`)
) TYPE=MyISAM;

--
-- Table structure for table `bt_news`
--

DROP TABLE IF EXISTS `bt_news`;
CREATE TABLE `bt_news` (
  `id` int(11) NOT NULL auto_increment,
  `pseudo` varchar(255) NOT NULL default '',
  `titre` varchar(255) NOT NULL default '',
  `contenu` text NOT NULL,
  `timestamp` bigint(20) NOT NULL default '0',
  `statut` varchar(50) NOT NULL default 'ok',
  PRIMARY KEY  (`id`),
  KEY `timestamp` (`timestamp`)
) TYPE=MyISAM;

--
-- Table structure for table `bt_news_com`
--

DROP TABLE IF EXISTS `bt_news_com`;
CREATE TABLE `bt_news_com` (
  `id` int(8) NOT NULL auto_increment,
  `id_news` int(8) NOT NULL default '0',
  `pseudo` varchar(50) NOT NULL default '',
  `text` text NOT NULL,
  `time_creation` int(16) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `id_news` (`id_news`),
  KEY `time_creation` (`time_creation`),
  FULLTEXT KEY `pseudo` (`pseudo`,`text`)
) TYPE=MyISAM;

--

--
-- Table structure for table `bt_pactes`
--

DROP TABLE IF EXISTS `bt_pactes`;
CREATE TABLE `bt_pactes` (
  `id` int(10) NOT NULL auto_increment,
  `type` varchar(20) NOT NULL default 'paix',
  `alliance1` int(10) NOT NULL default '0',
  `alliance2` int(10) NOT NULL default '0',
  `date_creation` int(14) NOT NULL default '0',
  `statut` varchar(50) NOT NULL default 'attente',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='PIA : Alli1 = demandeur du pacte';


--
-- Table structure for table `bt_proto_user`
--

DROP TABLE IF EXISTS `bt_proto_user`;
CREATE TABLE `bt_proto_user` (
  `id` int(11) NOT NULL auto_increment,
  `idunit` int(11) NOT NULL default '0',
  `iduser` int(11) NOT NULL default '0',
  `type_unit` varchar(20) NOT NULL default '',
  `avance` varchar(50) NOT NULL default 'debut',
  `prix_aleatoire_proto` int(11) NOT NULL default '0',
  `debut_dvpt` int(11) NOT NULL default '0',
  `fin_dvpt` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `idunit` (`idunit`),
  KEY `iduser` (`iduser`)
) TYPE=MyISAM;


--
-- Table structure for table `bt_renta_achat`
--

DROP TABLE IF EXISTS `bt_renta_achat`;
CREATE TABLE `bt_renta_achat` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `iduser` smallint(5) unsigned NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

--
-- Table structure for table `bt_ressources_utilisateurs`
--

DROP TABLE IF EXISTS `bt_ressources_utilisateurs`;
CREATE TABLE `bt_ressources_utilisateurs` (
  `iduser` smallint(5) unsigned NOT NULL auto_increment,
  `uranium` decimal(20,2) NOT NULL default '0.00',
  `H2` decimal(20,2) NOT NULL default '0.00',
  `eau` decimal(20,2) NOT NULL default '0.00',
  `beta` decimal(20,2) NOT NULL default '0.00',
  `elec` decimal(20,2) NOT NULL default '0.00',
  `nourriture` decimal(20,2) NOT NULL default '0.00',
  `O2` decimal(20,2) NOT NULL default '0.00',
  `pillule` decimal(20,2) NOT NULL default '0.00',
  `platine` smallint(3) unsigned NOT NULL default '0',
  `last_update` int(10) default NULL,
  `banque` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`iduser`)
) TYPE=MyISAM PACK_KEYS=0;


--
-- Table structure for table `bt_theme`
--

DROP TABLE IF EXISTS `bt_theme`;
CREATE TABLE `bt_theme` (
  `id` mediumint(10) unsigned NOT NULL auto_increment,
  `nom_court` varchar(100) NOT NULL default '',
  `nom_long` varchar(100) NOT NULL default '',
  `pref` tinyint(10) unsigned NOT NULL default '0',
  `type` varchar(20) NOT NULL default 'en construction',
  `createur` varchar(50) NOT NULL default '',
  `description` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `nom_court` (`nom_court`,`nom_long`),
  KEY `createur` (`createur`),
  KEY `id` (`id`),
  KEY `nom_long` (`nom_long`),
  KEY `pref` (`pref`),
  KEY `type` (`type`)
) TYPE=MyISAM COMMENT='table contenant les diferent theme dispo pour bt';

--
-- Dumping data for table `bt_theme`
--

LOCK TABLES `bt_theme` WRITE;
/*!40000 ALTER TABLE `bt_theme` DISABLE KEYS */;
INSERT INTO `bt_theme` VALUES (1,'ciel','Basic Blue',1,'Accepte','Rafale','Thème basique, utilisant très peu (voir aucune) images. Ce thème est conservé par nostalgie, c\'est sur ce thème qu\'a été développé le site !'),(2,'cyrilww2','Bubble Blue',0,'accpte','Cyril, codée par GuiGui','Thème futuriste, compatible normalement avec Firefox et Internet Explorer');
/*!40000 ALTER TABLE `bt_theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bt_users`
--

DROP TABLE IF EXISTS `bt_users`;
CREATE TABLE `bt_users` (
  `iduser` mediumint(6) unsigned NOT NULL auto_increment,
  `user` varchar(20) NOT NULL default '',
  `pass` varchar(20) NOT NULL default '',
  `ip` varchar(255) NOT NULL default '000.000.000.000',
  `mail` varchar(50) NOT NULL default '',
  `level` varchar(50) NOT NULL default 'joueur',
  `grade` mediumint(5) NOT NULL default '0',
  `terrain` int(8) NOT NULL default '0',
  `victoire` smallint(4) NOT NULL default '0',
  `defaite` smallint(4) NOT NULL default '0',
  `lot_commerce` int(2) NOT NULL default '0',
  `actif` varchar(40) NOT NULL default 'non',
  `theme` varchar(100) NOT NULL default 'ciel',
  `alliance` int(10) NOT NULL default '0',
  `date_inscription` int(14) NOT NULL default '0',
  `derniere_connexion` int(14) NOT NULL default '0',
  `ipinc` varchar(30) NOT NULL default '0',
  `page_accueil` varchar(100) NOT NULL default 'http://www.betatimes.info',
  `hack` int(5) NOT NULL default '0',
  `points` int(10) unsigned NOT NULL default '0',
  `info_classement` varchar(20) NOT NULL default '0/+',
  `nbr_attaque_possible` tinyint(1) NOT NULL default '0',
  `attaque_recu` tinyint(1) unsigned NOT NULL default '0',
  `vacance` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`iduser`),
  KEY `actif` (`actif`),
  KEY `grade` (`grade`)
) TYPE=MyISAM PACK_KEYS=0 COMMENT='table contenant ttes les info primaires sur les joueurs';

--
-- Table structure for table `info_bat`
--

DROP TABLE IF EXISTS `info_bat`;
CREATE TABLE `info_bat` (
  `id` mediumint(5) NOT NULL auto_increment,
  `type` varchar(50) NOT NULL default '',
  `nom` varchar(50) NOT NULL default '',
  `nom_pluriel` varchar(100) NOT NULL default '',
  `nom_court` varchar(100) NOT NULL default '',
  `prix` mediumint(10) NOT NULL default '0',
  `prod1_type` varchar(20) default NULL,
  `prod1_nbr` mediumint(10) default NULL,
  `prod2_type` varchar(20) default NULL,
  `prod2_nbr` mediumint(10) default NULL,
  `conso1_type` varchar(20) default NULL,
  `conso1_nbr` mediumint(10) default NULL,
  `conso2_type` varchar(20) default NULL,
  `conso2_nbr` mediumint(10) default NULL,
  `capacite` int(5) default NULL,
  `type_unit` varchar(50) NOT NULL default '',
  `defense` decimal(11,10) default NULL,
  `terrain` mediumint(10) default NULL,
  `comment` longtext,
  `level_min` tinyint(2) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `capacite` (`capacite`),
  KEY `conso1_nbr` (`conso1_nbr`),
  KEY `conso1_type` (`conso1_type`),
  KEY `conso2_nbr` (`conso2_nbr`),
  KEY `conso2_type` (`conso2_type`),
  KEY `defense` (`defense`),
  KEY `id` (`id`),
  KEY `level_min` (`level_min`),
  KEY `nom` (`nom`),
  KEY `nom_court` (`nom_court`),
  KEY `nom_pluriel` (`nom_pluriel`),
  KEY `prix` (`prix`),
  KEY `prod1_nbr` (`prod1_nbr`),
  KEY `prod1_type` (`prod1_type`),
  KEY `prod2_nbr` (`prod2_nbr`),
  KEY `prod2_type` (`prod2_type`),
  KEY `terrain` (`terrain`),
  KEY `type` (`type`),
  KEY `type_unit` (`type_unit`)
) TYPE=MyISAM;

--
-- Dumping data for table `info_bat`
--

LOCK TABLES `info_bat` WRITE;
/*!40000 ALTER TABLE `info_bat` DISABLE KEYS */;
INSERT INTO `info_bat` VALUES (1,'prod','Atelier de frappe','Ateliers de frappe','atelier_frappe',5000,'beta',3200,NULL,NULL,'elec',1200,NULL,NULL,NULL,'','20.0000000000',15,'Cet immeuble ultra-protégé sera la base de toute votre industrie, tant commerciale que militaire en effet, ici sera frappée la monnaie en rigueur: le beta. Plus vous élèverez de bâtiments comme celui-ci, plus vous gagnerez d\'argent et plus vous pourrez dominer le jeu. Que vous soyez commerçant ardu ou guerrier sanguinaire, ceci doit être votre bâtiment préféré...',1),(2,'prod','Forage à  eau','Forages à  eau','forage_eau',1300,'eau',800,NULL,NULL,'elec',250,NULL,NULL,0,'','1.5500000000',75,'La planète est très polluée, il faut aller chercher l\'eau dans les profondeurs de la terre pour qu\'elle ne le soit pas trop. Elle sera néanmoins souillée de bactérie et un centre de traitement est intégré au forage, ce qui explique son cout élevé.',1),(3,'prod','Plantation','Plantations','plantation',3000,'nourriture',1500,NULL,NULL,'eau',1000,NULL,NULL,0,'','1.3000000000',150,'La plantation vous permet de produire de la nourriture brute et de l’huile, l’huile sera transformée en biocarburant et la nourriture brute en comprimés pour vos troupes. Sans cela, vos mercenaires mourront un par un et refuseront de s\'enrôler dans votre armée.',2),(4,'prod','Panneau solaire','Panneaux solaire','panneau_solaire',1500,'elec',1800,NULL,NULL,'eau',100,'',0,0,'','1.5500000000',75,'Après avoir achetés vos panneaux vous pourrez faire de l\'électricité avec le soleil, cette énergie est propre mais couteuse et très dépendante du temps. Cette centrale de base vous sera nécessaire au départ mais dès que vous atteindrez un niveau supérieur, passez à la technologie plus évoluée.',1),(5,'def','Tourelle électrique','Tourelles électrique','tourelle_electrique',3000,NULL,NULL,NULL,NULL,'elec',3500,NULL,NULL,0,'','45.0000000000',20,'Une tourelle légère, équipé d’un canon électrique qui a pour effet de griller tout circuit électronique et électrocuter n’importe quel être vivant. Défense basique, elle sera néanmoins utile à votre commencement pour repousser les ennemis les plus faibles. ',3),(6,'prod','Laboratoire alimentaire','Laboratoires alimentaire','laboratoire_alimentaire',16000,'pillule',1500,NULL,NULL,'elec',900,'nourriture',3000,0,'','1.5500000000',400,'Votre armée ne peut survivre sans une nourriture seine, le laboratoire alimentaire vous permet de transformer la nourriture brute directement arrivé des plantations en pilules. Malheureusement, les pilules ont une durée de vie très courte et vous devrez en refaire continuellement.',3),(7,'stockage','Baraquement','Baraquements','baraquement',3500,NULL,NULL,NULL,NULL,'elec',320,NULL,NULL,40,'homme','1.2000000000',10,'C\'est dans ces bâtiments que crècheront vos clones. C\'est donc aussi dans ces bâtisse qu\'habiteront le gros de vos unités, prenez en soin, l\'infanterie sera la colonne vertébrale de vos troupes, comptant le plus grand nombre d\'unités. Et pas de grandes invasions sans troupes courant sur les terres en flammes...',2),(8,'clone','Usine de multiplication','Usines de multiplication','usine_multiplication',15000,NULL,NULL,NULL,NULL,'elec',5000,NULL,NULL,NULL,'homme','1.4000000000',500,'Véritable centre de guerre, il sera le lieu de production de chacune de vos unités militaires non-blindées. A partir du prototype créé dans l\'usine cybernétique vous ferez cloner ici vos unités.',2),(9,'def','Tourelle à photons','','tourelle_photons',6500,NULL,NULL,NULL,NULL,'elec',900,'O2',700,NULL,'','60.0000000000',30,'Cette tourelle améliorée consomme moins d\'électricité et est plus puissante.',6),(12,'prototype','Laboratoire de création','Laboratoires de création','laboratoire_creation',10000,NULL,NULL,NULL,NULL,'elec',5000,NULL,NULL,0,'prototype','1.0000000000',0,'Ce lieux sera l\'un des plus important de votre empire. Dans ce laboratoire, travailleront des scientifiques qui élaboreront la face de vos futurs prototype et donc de vos futures forces armées. Pour un prix très élevé vous pourrez financer ces recherche et faire aboutir chacun de vos projets.',2),(10,'prod','Centre de combinement','','centre_combinement',5000,'H2',800,'O2',1100,'elec',1500,'eau',4000,0,'','1.6500000000',0,'Les camions viendront déposer dans les grandes cuves de cette usine les différents composants nécessaires à la fabrication de l\'hydrogène et de l\'oxygène nécessaire au bon fonctionnement de vos forces armées et de vos  bâtiments.',6),(15,'def','Tourelle à dihydrogène','','tourelle_dihydrogene',10000,NULL,NULL,NULL,NULL,'elec',1000,NULL,NULL,0,'','99.9999999999',50,'Une tourelle de forte puissance armée d’un canon a dihydrogène liquide, ce qui congèle tout être vivant et rend le métal aussi cassant que du verre. Le dihydrogène est aussi extrêmement explosif. ',9),(16,'clone','Usine de fabrication lourde','','usine_lourde',40000,NULL,NULL,NULL,NULL,'elec',5000,NULL,NULL,0,'cyborg','1.4300000000',800,'Dans ces hangars seront créés les unité cyborgs de votre armée. Venant en soutient de l\'infanterie, l\'appui militaire de ces unité puissantes sera nécessaire dans les grandes campagnes de guerres.',4),(17,'prod','Centrale à H2','','centrale_h',32500,'elec',25500,NULL,NULL,'H2',750,NULL,NULL,0,'','1.5000000000',0,'Seuls les meilleurs joueurs pourront accéder à cette partie du jeu. Dans ces entrepôts ultra-protégés sera fabriqué le missile à hydrogène, arme suprême. On l\'a vu au cours de nombreux conflits, l\'arme qui sortira de ce bâtiment sera une machine à détruire.',7),(18,'prod','Mine d\'uranium','','mine_ura',65000,'uranium',33,NULL,NULL,'elec',1500,NULL,NULL,0,'','1.6000000000',150,'La mine d’uranium vous permet d’extraire ce métal de la terre, il vous servira pour vos centrales et pour vos armées.',9),(19,'prod','Centrale à fusion nucleaire','','centrale_fusion',35000,'elec',100000,NULL,NULL,'uranium',100,'eau',1800,0,'','1.6300000000',500,'Cette centrale a en son coeur une étoile miniature, en contre partie de son cout exorbitant, elle produit énormément d\'électricité et ne consomme que très peu.',10),(21,'prototype','Silo à missile','','silo_missile',100000,NULL,NULL,NULL,NULL,'elec',20000,NULL,NULL,0,'','1.0000000000',200,'Danc ce lieu gardé secret de tous, vos ingénieurs travailleront nuit et jour pour obtenir des missile SCUD, compléments important à votre armée. Ce ne sera néammoins qu\'une faible arme à coté de ce qui vous attendra plus tard...\r\n--------- PB ne pas acheter',10),(22,'prod','Centre de traitement de l\'hydrogène','','traitement_hydro',600000,NULL,NULL,NULL,NULL,'elec',15000,NULL,NULL,0,'','1.7000000000',0,'Seul les meilleurs joueurs pourront accéder à cette partie du jeu. Dans ces entrepôts ultra-protégés sera fabriqué le missile à hydrogène, arme suprême. On l\'a vu au cours de nombreux conflits, l\'arme qui sortira de ce bâtiment sera une machine à détruire.',12),(24,'prod','Centrale geothermique','','centrale_geo',25000,'elec',16500,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','1.6700000000',75,'Une production d\'électricité plus rentable que les panneaux solaires.',4),(25,'clone','Usine cybernétique','Usines cybernétique','usine_cybernetique',33000,NULL,NULL,NULL,NULL,'elec',15000,'eau',15000,NULL,'capsule','1.0000000000',200,'Lieu de clonage, ce bâtiment vous fournira vos capsules, petits véhicules conçus avant tout pour l\'exploration puis recréés pour la guerre.',3),(26,'clone','Laboratoire Kirko','','',27000,'',0,'',0,'eau',13000,'elec',150,NULL,'module','1.4500000000',200,'Ces bâtiments imposants fabriqueront les machines les plus efficaces de votre armées: les modules. Ici, de l\'eau et les fumées dues à la production sont utilisés pour produire l\'électricité nécessaire au laboratoire ; ce qui explique sa très faible consommation électrique.',5),(27,'stockage','Hangar','','hangar',10020,NULL,NULL,NULL,NULL,'eau',2500,NULL,NULL,25,'blindé','1.2200000000',15,'Lieu de stockage de tous vos engins motorisés ou blindés.',3),(28,'def','Tourelle à gel','Tourelles à gel','tourelle_gel',1250,NULL,NULL,NULL,NULL,'elec',750,'eau',750,NULL,'','30.0000000000',15,'Défense basique, la tourelle à gel utilise l\'eau pour conduire l\'électricité aux unités ennemies.',1),(46,'prod','Immeuble des épargnes','Immeubles des épargnes','banque',50000,NULL,NULL,NULL,NULL,'elec',23500,NULL,NULL,NULL,'','99.9999999999',120,'Ce bâtiment vous permet de mettre vos bêtas à l\'abri des attaques. Vous pouvez donc y stocker votre propre production et le butin de vos pillages et même percevoir des intérêts dessus à hauteur de 1,2% de maniere hebdomadaire. Cette assurance et ce profit ne sont assurés que par la perte de 18% du montant de chaque retrait.',4);
/*!40000 ALTER TABLE `info_bat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_grade`
--

DROP TABLE IF EXISTS `info_grade`;
CREATE TABLE `info_grade` (
  `grade` int(2) NOT NULL default '0',
  `nom` varchar(50) NOT NULL default '',
  KEY `grade` (`grade`),
  KEY `nom` (`nom`)
) TYPE=MyISAM;

--
-- Dumping data for table `info_grade`
--

LOCK TABLES `info_grade` WRITE;
/*!40000 ALTER TABLE `info_grade` DISABLE KEYS */;
INSERT INTO `info_grade` VALUES (1,'Newbie'),(2,'Fighter'),(4,'1er Galon'),(3,'2e Galon'),(5,'3e Galon'),(6,'Amiral'),(7,'Major'),(8,'Centuror'),(9,'Comodor'),(10,'Master'),(11,'Beta-better');
/*!40000 ALTER TABLE `info_grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_unit`
--

DROP TABLE IF EXISTS `info_unit`;
CREATE TABLE `info_unit` (
  `id` int(8) NOT NULL auto_increment,
  `type` varchar(50) NOT NULL default '',
  `nom_unit` varchar(250) NOT NULL default '',
  `nom_court` varchar(100) NOT NULL default '',
  `prix_proto_mini` int(15) NOT NULL default '0',
  `prix_proto_max` int(15) NOT NULL default '0',
  `duree_proto` int(20) NOT NULL default '0',
  `prix_clone` int(10) NOT NULL default '0',
  `conso1_nbr` int(10) default '0',
  `conso1_type` varchar(50) default NULL,
  `conso2_nbr` int(10) default '0',
  `conso2_type` varchar(50) default NULL,
  `level_min` int(2) NOT NULL default '0',
  `comment` text NOT NULL,
  `niv_attaque` int(5) NOT NULL default '0',
  `niv_defense` int(5) NOT NULL default '0',
  `terrain` int(5) NOT NULL default '0',
  KEY `id` (`id`),
  KEY `type` (`type`)
) TYPE=MyISAM;

--
-- Dumping data for table `info_unit`
--

LOCK TABLES `info_unit` WRITE;
/*!40000 ALTER TABLE `info_unit` DISABLE KEYS */;
INSERT INTO `info_unit` VALUES (1,'homme','Homme de main','homme_main',1,10,1,250,1,'nourriture',0,NULL,2,'Les hommes de main sont des mercenaires peux chers, mais éfficaces temps qu\'ils sont payés. ',1,1,1),(4,'homme','Mercenaire d\'élite','merco_elite',500000,700000,20000,1500,5,'pillule',0,NULL,4,'Formés par des écoles prestigieuses, ces \"machines humaines\" mourront pour vous avec plaisir, usez-en en attaque comme en défense ce sont de véritables guerriers.',6,5,2),(3,'homme','Assassin','assas',150000,250000,10800,1120,3,'pillule',0,NULL,3,'L\'assassin est un mercenaires destiné a des attaques commandos, il est a l\'aise sur tout les terrain mais ses armes sont relativements basiques. Véritable spécialiste de l\'attaque, son aide dans les batailles défensives sera moindre et il pourra pénaliser une armée entière par ses techniques de protection peu académiques.',4,2,2),(5,'cyborg','Cyborg GERMY60','c_germy60',1000000,1500000,30000,2500,30,'eau',0,'',4,'Doté de 2 coussins d\'air, ce véhicule rapide et léger se déplace facilement sur tout type de surface. Tout d\'abord utilisé pour des missions au cours du raid de Hirma, en 2478, il a ensuite été oublié mais des plans ont été retrouvés recemment. Ce n\'est pas ce blindé qui vous assurera des victoires écrasantes mais ils pourra être utile en soutien de feu ou pour détruire les premières lignes ennemis. Ils sont nottament très à l\'aise pour défendre votre base.',7,10,4),(6,'cyborg','Cyborg GERMY85','c_germy85',2000000,2500000,35000,3200,12,'H2',9,'O2',7,'Version améliorée du GERMY60, il dispose de 4 coussins d\'air et de deux nouveaux canons latéraux. Son blindage a également été amélioré par un champ de force ultra-renforcé. Il dispose de 4 canons à photon de 20mm et vous sera util en toute circonstance. Véritable cyborg de défense, il a tous les avantages d\'une tourelle, la mobilité en plus. C\'est le fruit de l\'espionnage industriel des forces de Riko, qui avaient ensuite dévoilés au scientifiques du monde entier les plans de ce bijou de technologie.',10,15,6),(7,'cyborg','Cyborg R5A','c_r5a',3000000,3500000,40000,4150,14,'H2',11,'O2',8,'Seul cyborg sur chenille, il est aussi le plus lourd et le plus lent. Chargé de canon le plus puissant, son gros problème est le blindage. On a pu l\'observer lors de la bataille de Kirka ou le général Hermanof avais avancé vers le camps des Ytrezny avec une armée de 1580 R5A et s\'étais fait repoussée par 3000 Forces spéciales en position d\'attaque. Ce cyborg ne devra donc pas être utilisé seul ou seulement en très grand nombre. Il pourra tirer deux voir trois tir de rang contre une force de frappe égale mais sera ensuite balayé par les tirs ennemis.',17,8,6),(8,'cyborg','Cyborg ZUK','c_zuk',4000000,5000000,50000,5000,16,'H2',9,'O2',10,'Le cyborg ZUK utilise une arme que lui seul possède. Un canon à photon à tête chercheuse. Conçue par les ingénieur du SPAX, cette arme peux être fatale à n\'importe quelle unité visée. Sa rapidité d\'execution et sa vitesse de feu sont ses grands atouts .Souvent utilisés pour subvenir au besoin d\'une artillerie faible, sa réelle puissance se montrera en face à face contre d\'autres véhicules. Pièce maîtresse des défenses de bases, ce blindé pourra être également très efficace face aux infanteries ennemis, débordées par vos coups de boutoir.',12,15,5),(9,'capsule','Capsule B13','c_b13',400000,600000,10000,1470,40,'eau',NULL,NULL,3,'Petite capsule conçue pour la reconnaissance, elle est très rapide. Armée d\'un seul petit canon a photon, ce n\'est pas l\'arme qui vous fera gagner de grandes bataille. Très maniable elle est appropriée à l\'apprentissage du vol et peux en faire un bon outil d\'école.',4,4,1),(10,'capsule','Capsule GVS','c_gvs',700000,1000000,17800,2000,7,'O2',NULL,NULL,6,'Courte et effilée, la capsule GVS vous permettra d\'effectuer des tirs de préventions sur l\'ennemi. Très faiblement blindés, elle ne pourra tirer qu\'une ou 2 fois en cas de bataille dans les airs. Sa particularité et son plus grand avantage c\'est qu\'elle n\'a pas besoin de pilote et sera donc très utile en cas de mission suicide.',9,4,1),(2,'homme','Sentinelle','senti',35000,65000,86400,730,2,'nourriture',0,NULL,2,'La sentinelle est la base de votre armée régulière, elle est à la fois discrète et efficace. Beaucoup plus instruite que le basique homme de main elle vous assurera un minimum de défense. Elle sera cepandant relativement faible en attaque.',2,4,2),(12,'homme','Forces spéciales','force_spe',1200000,1500000,32400,2000,8,'pillule',0,NULL,7,'Les forces spéciales sont l\'élite de votre armée, ils réussiront pour vous les missions les plus risqués dans tous les milieux. Attaque, défense, sabotage et pillage n\'ont aucun secret pour ces guerriers. En grande partie composée de femmes, cette unité de votre armée vous aidera à mener votre drapeau jusqu\'en haut des toits ennemis.',9,9,3),(13,'module','Module A1','ma1',250000,300000,1200,1000,3,'elec',0,NULL,5,'Vaisseau de base, il fut créé il y a déjà bien longtemps dans les laboratoires de Kirko. C\'était le premier engin capable de tenir une bataille de 5 heures sans arrêter de tirer. Ses performances pendant la campagne de Hirshy l\'avait fait reconaître comme un vrai pionnier de l\'aérospatiale. Pourtant relativement basique, il pourra être utile, comme tous les modules pour une approche de haut et plus rapide qu\'un assaut par des cyborgs ou des hommes. ',5,5,1),(14,'module','Module A2','ma2',450000,600000,3600,1500,6,'H2',0,NULL,6,'Amélioration du précédent, il possède un armement légerement plus compétent et une meilleure cadence de tir. En revanche, le moteur et le blindage reste inchangé. Deuxième volet de cette série signé laboratoire Kirko, il ne sera utilisé pour la première fois que très récemment dans des conflits maritimes.',8,4,2),(15,'module','Module A3','ma3',2000000,4000000,25000,4000,4,'H2',4,'O2',9,'Troisième et dernier volet de la catégorie \"Module A\", ce dernier présente l\'avantage d\'avoir une forme moins imposante que ses prédecesseur. Il possède en outre le même armement qu\'un cyborg GERMY85. Ce qui fait de lui l\'une des unités les plus performantes de l\'armement proposé. Cepandant ce Module vous servira lui mieux en attaque qu\'en défense. Attention cepandant au surprises concernant le prix du prototype!',15,10,5),(16,'capsule','Module IP7','m_ip7',500000,752000,3600,1450,3,'pillule',0,NULL,5,'Cette unité, entre homme et robot participera activement à la défense de vos murs. Sa lenteur conséquente ne lui permettra cepandant pas de vous suivre au champs de bataille ou seulement en prenant des risques.',3,8,3),(18,'cyborg','Cyborg JJ05','c_jj',3000000,3500000,10000,3250,5,'H2',0,'',9,'Cyborg JJ05: Petit véhicule ultra rapide, le JJ05 sera une arme de perforation dans les raids contre des troupes faibles et en petit nombre. Sa vitesse d\'exécution atteindra ses sommets seulement s\'il est protégé par des modules ou par des mercenaires. Sa petite mitrailleuse à laser sera efficace contre les mercenaires adverses. Pour la référence, tout le monde se souvient de sa première utilisation, pendant la bataille d\'Hirma, la plus meurtrière depuis longtemps, où les ingénieurs de Riko avaient dévoilé cette arme.',16,10,4);
/*!40000 ALTER TABLE `info_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_at`
--

DROP TABLE IF EXISTS `panel_at`;
CREATE TABLE `panel_at` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(50) NOT NULL default '',
  `username` varchar(250) NOT NULL default '',
  `msg` varchar(255) NOT NULL default '',
  `timestamp` varchar(100) NOT NULL default '',
  KEY `id` (`id`),
  KEY `msg` (`msg`),
  KEY `timestamp` (`timestamp`),
  KEY `type` (`type`),
  KEY `username` (`username`)
) TYPE=MyISAM;


--
-- Table structure for table `sondage_quest`
--

DROP TABLE IF EXISTS `sondage_quest`;
CREATE TABLE `sondage_quest` (
  `id` int(11) NOT NULL auto_increment,
  `quest` varchar(250) NOT NULL default '',
  `option1` varchar(250) NOT NULL default '',
  `option2` varchar(250) NOT NULL default '',
  `option3` varchar(250) NOT NULL default '',
  `result1` int(10) NOT NULL default '0',
  `result2` int(10) NOT NULL default '0',
  `result3` int(10) NOT NULL default '0',
  `nbr_votant` int(10) NOT NULL default '0',
  `statut` varchar(50) NOT NULL default '',
  `time_creation` int(15) NOT NULL default '0',
  `createur` varchar(50) NOT NULL default '',
  KEY `id` (`id`),
  KEY `createur` (`createur`),
  KEY `nbr_votant` (`nbr_votant`),
  KEY `option1` (`option1`),
  KEY `option2` (`option2`),
  KEY `option3` (`option3`),
  KEY `quest` (`quest`),
  KEY `result1` (`result1`),
  KEY `result2` (`result2`),
  KEY `result3` (`result3`),
  KEY `statut` (`statut`),
  KEY `time_creation` (`time_creation`)
) TYPE=MyISAM COMMENT='contient les questions des sondages';


--
-- Table structure for table `sondage_users`
--

DROP TABLE IF EXISTS `sondage_users`;
CREATE TABLE `sondage_users` (
  `iduser` int(11) NOT NULL default '0',
  `user` varchar(50) NOT NULL default '',
  `idsondage` int(11) NOT NULL default '0',
  `vote` int(1) NOT NULL default '0',
  `commentaire` text NOT NULL,
  `statut` varchar(250) NOT NULL default 'en cour',
  KEY `idsondage` (`idsondage`),
  KEY `iduser` (`iduser`),
  KEY `statut` (`statut`),
  KEY `user` (`user`),
  KEY `vote` (`vote`)
) TYPE=MyISAM;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2008-02-01 23:05:46
