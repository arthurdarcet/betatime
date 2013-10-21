<div class="block">
<h4>F&eacute;licitations, vous avez promu au grade de {NEW_GRADE_NOM}({NEW_GRADE_NBR}) ! </h4>
<br />
<b>{DATE}</b> : F&eacute;licitations, de nouveaux objectifs ainsi que de nouveaux b&acirc;timents, et unit&eacute;s sont d&eacute;sormais disponible. 
<br />
<table border="0" width="100%">
	<tr>
		<td><p>Vous pouvez d&eacute;sormais construire ces b&acirc;timents : </p>
<!-- BEGIN new_bat -->
<ul>
  <li><p><a href="?info_batunit&class=bat&id={new_bat.ID}" align="center">{new_bat.NOM}</a></p></li>
</ul>
<!-- END new_bat --></td>
		<td rowspan="2"><p>Et voici les nouveaux objectifs à accomplir : </p>
<!-- BEGIN new_obj -->
<ul>
  <li><p>{new_obj.NOM}</p></li>
</ul>
<!-- END new_obj --></td>
	</tr>
	<tr>
		<td><p>Ainsi que ces unités : </p>
<!-- BEGIN new_unit -->
<ul>
  <li><p><a href="?info_batunit&class=unit&id={new_unit.ID}" align="center">{new_unit.NOM}</a></p></li>
</ul>
<!-- END new_unit --></td>
	</tr>
</table>



</div>
