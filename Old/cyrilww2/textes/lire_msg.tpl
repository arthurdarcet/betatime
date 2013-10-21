<table width="100%" align="center">
  <tr>
    <td colspan="2"><a href="index.php?page=traitement_msg&action=envoyer_message&destinataire={EXPEDITEUR}">Répondre au message</a> - <a href="index.php?page=traitement_msg&action=del_message&id={ID}">Suprimer ce message</a></td>
    <td height="67"><em>Expediteur du message :</em>{EXPEDITEUR}<br />
        <em>Date d'envoi du message :</em> Le {DATE}<br />
        <em>Titre du message(falcutatif): </em>{TITRE}</td>
  </tr>
  <tr>
    <td height="21" colspan="3"><em>Contenu du message : </em></td>
  </tr>
  <tr>
    <td rowspan="2">&nbsp;</td>
    <td height="21" colspan="2" rowspan="2">{CONTENU}</td>
  </tr>
</table>