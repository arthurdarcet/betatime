<?
    $template->set_filenames(array(
        'presentation' => 'textes/presentation.tpl'
    ));

$monfichier = fopen("presentation.txt", "r");
           $ligne = 0;
while($ligne <= 13 ) {

  $txt .= fgets($monfichier)  ;
  $template->assign_vars(array(
        'PRESENTATION' =>   $txt
  ));
  $ligne++;
}
fclose($monfichier);



    $template->assign_var_from_handle('PAGE', 'presentation');
?>
