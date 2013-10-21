<?php
//pour remmetre les accents suite au htmlentites
//By Guigui le 30/08/06
function affich_text($texte) {
	$texte = nl2br(stripslashes($texte)); // on vire els eventuel / et surtout en met des <br> a la place des /n
	
    $texte = str_replace('&quot;', '"', $texte);
    $texte = str_replace('&amp;', '&', $texte);
    $texte = str_replace('&eacute;', 'é', $texte);
    $texte = str_replace('&ecirc;', 'ê', $texte);
    $texte = str_replace('&egrave;', 'è', $texte);
    $texte = str_replace('&euro;', '€', $texte);
    $texte = str_replace('&ccedil;', 'ç', $texte);
    $texte = str_replace('\\', '' , $texte);
    $texte = str_replace('[gras]', '<strong>' , $texte);
    $texte = str_replace('[/gras]', '</strong>' , $texte);
    $texte = str_replace('[italic]', '<em>' , $texte);
    $texte = str_replace('[/italic]', '</em>' , $texte);
    $texte = str_replace('[image]', '<img src="' , $texte);
    $texte = str_replace('[/image]', '" />' , $texte);
    $texte = str_replace(':D', '<img src="images/smileys/bleh.gif" />' , $texte);
    return $texte;
}
?>