jQuery(document).ready(function(){
	loadEditableArticles()
})

function loadEditableArticles() {
    jQuery.ajax({
    	url : "../controller/assync_articles/articles.php",
    	dataType: "json",
    	type: "POST",
    	success: function(data) {
    		jsonArticles = data.articles
    		for(var i = 0; i < jsonArticles.length; i += 1) {
    			var jsonArticle = jsonArticles[i]
    			var htmlArticles = buildArticle(jsonArticle)
                var $article = jQuery(htmlArticles)
                var $removeLink = $article.find(".remove-article")
                removeListener($article, $removeLink)
                jQuery("#articles").append($article)
    		}
    	}
    })
}

function buildArticle(jsonArticle) {
	htmlArticle = new EJS({url:'../templates/_editable_article.ejs'}).render(jsonArticle)
	return htmlArticle;
}

function removeListener($article, $link) {
    jQuery($link).click(function() {
        $aticle.remove()
    })
}