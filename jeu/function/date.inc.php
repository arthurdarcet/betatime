<?php
//pour les dates
//By Guigui le 12/09/06
//Pour savoir si la date est hier, ou aujourd'hui
function date_j($time) {
    $date_jour = date('d',$time);
    $date_z = date('z', $time);

    $auj = date('d');
    $hier = date('z') - 1;

        if($auj == $date_jour ) {
            $date_j = "Aujourd'hui";
        }elseif($hier == $date_z) {
			$date_j= "Hier";
		}	
	return $date_j;
}
function data($time) {
	$date_j = date_j($time);
	if($date_j != '')
	{
		$date = $date_j.' à '.date('H\hi', $time);
	}else{
		$date = 'Le '.date('d', $time).' '.substr(date('F', $time),0,3).' '.date('y', $time).' à '.date('H\hi', $time);
	}
	return $date;
}
?>