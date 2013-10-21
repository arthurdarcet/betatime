<?
	function get_adresse() {
		if(!empty($_GET['adresse'])){ $adresse = $_GET['adresse']; }
		elseif(isset($_SESSION['page_accueil'])) { $adresse = $_SESSION['page_accueil']; }
		else { $adresse = "http://www.betatimes.info"; }
		return $adresse;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Beta - Times</title>
</head>
<body bgcolor="#FFCC00">
	<form action="frameset.php" method="get" name="adresse" target="_top">
	  <p>Adresse : <input type="text" size="100" name="adresse" value="<? echo get_adresse() ?>" />
	  <input type="submit" name="ok" value="ok" />
</form>
</body>
</html>
