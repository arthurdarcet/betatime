<div class="block">
<h4>Vendre ses d&eacute;faites</h4>
<form method="post" action="#">
<p>Vous avez <b>{NBR_DEFAITE}</b> d�faite(s).</p>
<p>1 d�faite contre 3 victoires !</p>
<p> </p>
    <p><input type="submit" value="Vendre" class="inputa" />
      <select name="nbr_defaite" class="inputa">
		<!-- BEGIN defaites -->
		<option value="{defaites.NBR_DEFAITE}">{defaites.NBR_DEFAITE}</option>
    	<!-- END defaites -->
	</select>
	D�faites</p>
</form>
</div>