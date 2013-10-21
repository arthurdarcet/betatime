<?php
$retour = query("SELECT titre , timestamp , id FROM bt_news ORDER BY timestamp DESC LIMIT 0,5");
while ($data = mysql_fetch_array($retour))
{
    $template->assign_block_vars('news', array(
        'TITRE' => affich_text($data['titre']),
        'DATE' => date('d/m/Y',$data['timestamp']),
        'ID' => $data['id'],
    ));
}
$template->set_filenames(array(
    'news' => 'textes/news_accueil.tpl'
));
$template->assign_var_from_handle('NEWS_ACCUEIL', 'news');
?>