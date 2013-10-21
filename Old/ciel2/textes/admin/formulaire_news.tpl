<script language="javascript" type="text/javascript">
function bbcode(bbdebut, bbfin)
{
var input = window.document.formulaire.contenu;
input.focus();
/* pour IE (toujous un cas appar lui ;) )*/
if(typeof document.selection != 'undefined')
{
var range = document.selection.createRange();
var insText = range.text;
range.text = bbdebut + insText + bbfin;
range = document.selection.createRange();
if (insText.length == 0)
{
range.move('character', -bbfin.length);
}
else
{
range.moveStart('character', bbdebut.length + insText.length + bbfin.length);
}
range.select();
}
/* pour les navigateurs plus récents que IE comme Firefox... */
else if(typeof input.selectionStart != 'undefined')
{
var start = input.selectionStart;
var end = input.selectionEnd;
var insText = input.value.substring(start, end);
input.value = input.value.substr(0, start) + bbdebut + insText + bbfin + input.value.substr(end);
var pos;
if (insText.length == 0)
{
pos = start + bbdebut.length;
}
else
{
pos = start + bbdebut.length + insText.length + bbfin.length;
}
input.selectionStart = pos;
input.selectionEnd = pos;
}
/* pour les autres navigateurs comme Netscape... */
else
{
var pos;
var re = new RegExp('^[0-9]{0,3}$');
while(!re.test(pos))
{
pos = prompt("insertion (0.." + input.value.length + "):", "0");
}
if(pos > input.value.length)
{
pos = input.value.length;
}
var insText = prompt("Veuillez taper le texte");
input.value = input.value.substr(0, pos) + bbdebut + insText + bbfin + input.value.substr(pos);
}
}
function smilies(img)
{
window.document.formulaire.textarea.value += '' + img + '';
}
</script>
<div class="block">
<h4>Poster une news</h4>
<form method="post" action="#" name="formulaire">

<table width="100%" border="0">
  <tr>
    <td><label>Titre <input name="titre" type="text" id="titre" value="{TITRE}">
        <input name="id" type="hidden" value="{ID}" />
    </label></td>
	<td><input type="button" id="gras" name="gras" value="Gras" style="font-weight:bold;" onClick="javascript:bbcode('[gras]', '[/gras]');return(false)" />
<input type="button" id="italic" name="italic" value="Italic" style="font-style:italic;" onClick="javascript:bbcode('[italic]', '[/italic]');return(false)" />
<input type="button" id="image" name="image" value="Image" onClick="javascript:bbcode('[image]', '[/image]');return(false)" />
</td>
  </tr>
  
  <tr>
  	<td><table width="200" border="0" align="center">
        <tr align="center">
          <td><img src="images/smileys/bleh.gif" alt="" onclick="javascript:smilies(':D');return(false)" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr align="center">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr align="center">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr align="center">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
	<td><textarea name="contenu" cols="40" rows="10" id="textarea">{CONTENU}</textarea></td>
  </tr>
  <tr>
  	<td colspan="2"><div align="center">
  	  <input type="submit" name="submit" value="Envoyer" />
	  </div></td>
  </tr>
</table>
</form>
</div>