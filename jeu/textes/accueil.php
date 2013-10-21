<?
    $template->set_filenames(array(
        'page' => 'textes/accueil.tpl'
    ));
    // On récupère les 4 dernières news
    $result = query('SELECT titre , timestamp , id , pseudo FROM bt_news ORDER BY id DESC limit 0,5');
    while( $row = mysql_fetch_assoc($result) ) {
        $template->assign_block_vars('news_accueil', array(
            'TITRE'    => affich_text($row['titre']),
            'DATE'    => date('d-m-Y', $row['timestamp']),
            'ID' => $row['id'],
			'PSEUDO' => $row['pseudo']
        ));
    }

    $template->assign_var_from_handle('PAGE', 'page');
?>