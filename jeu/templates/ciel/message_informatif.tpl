<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	{META_TAGS}
	<link href="templates/ciel/style_message.css" rel="stylesheet" type="text/css" title="Bleu ciel" />
	<!-- BEGIN redirection -->
		<meta http-equiv="refresh" content="{redirection.TEMPS}; url={redirection.CIBLE}" />
	<!-- END redirection -->
</head>
<body>
<div class="msg_info">
	<h4>Message d'information</h4>
	<p><strong>{MESSAGE}</strong></p>
		<!-- BEGIN redirection -->	
			<p class="attente">Vous allez être redirigé dans {redirection.TEMPS} seconde(s) !</p>
			<p align="center"><a href="{redirection.CIBLE}" title="Ne pas attendre">Ne pas attendre</a></p>
		<!-- END redirection -->
</div>
{GOOGLE_ANALYTICS}
</body>
</html>