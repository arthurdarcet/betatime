<?php
$retour = query("SELECT * FROM bt_news ORDER BY id DESC");
while ($data = mysql_fetch_array($retour)) {
$texte = $data['contenu'];
$sql = query("SELECT * FROM bt_news_com WHERE id_news ='".$data['id']."' ");
$nbr = mysql_num_rows($sql);
    if($_SESSION['level'] == 'admin')
    {
        $template->assign_block_vars('news', array(
            'TITRE' => affich_text($data['titre']),
            'DATE' => date('d/m/Y à H\hi', $data['timestamp']),
            'AUTEUR' => affich_text($data['pseudo']),
            'CONTENU' => affich_text($texte),
            'NBR_COMMENTAIRE' => $nbr,
            'ID' => $data['id'],
            'POST_ID' => '<input type="hidden" name="id" value"'.$data['id'].'">'
        ));
    }else{
        $template->assign_block_vars('news', array(
            'TITRE' => affich_text($data['titre']),
            'DATE' => date('d/m/Y à H\hi', $data['timestamp']),
            'AUTEUR' => affich_text($data['pseudo']),
            'CONTENU' => affich_text($texte),
            'NBR_COMMENTAIRE' => $nbr,
            'ID' => $data['id']
        ));    
    }
    
}
$template->set_filenames(array(
    'news' => 'textes/news.tpl'
));
$template->assign_var_from_handle('PAGE', 'news');
?>