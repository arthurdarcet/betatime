<?
	function get_adresse() {
		if(!empty($_GET['adresse'])){ $adresse = $_GET['adresse']; }
		elseif(isset($_SESSION['page_accueil'])) { $adresse = $_SESSION['page_accueil']; }
		else { $adresse = "http://betatimes.info"; }
		return $adresse;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Beta - Times</title>
</head>
	<frameset rows="54,*,80" cols="*" framespacing="0" frameborder="no" border="0">
		<frame src="barre_adresse.php?adresse=<? echo get_adresse(); ?>" title="barre_adresse" />
		<frame src="<? echo get_adresse(); ?>" title="page" />
		<frame src="infos.php" title="infos" />
	</frameset>
	<noframes>
		<body></body>
	</noframes>
</html>
