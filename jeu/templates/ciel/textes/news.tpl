<!-- BEGIN news -->
<div class="block" id="{news.ID}">
	<h4>{news.TITRE}</h4>
	<p style="font-size-adjust: -2">Postée le {news.DATE} par {news.AUTEUR} | <a href="?page=news_commentaire&id={news.ID}">{news.NBR_COMMENTAIRE} commentaire(s)</a> | <form action="#" method="post">{news.POST_ID}{news.DEL}</form> </p>
	<p>{news.CONTENU}</p>
</div>
<!-- END news -->