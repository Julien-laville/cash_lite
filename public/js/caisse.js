var totalPrice = 0
var cart = []

jQuery(document).ready(function(){
	loadArticles()
})

function loadArticles() {
    jQuery.ajax({
    	url : "./controller/assync_articles/articles.php",
    	dataType: "json",
    	type: "POST",
    	success: function(data) {
    		jsonArticles = data.articles
    		for(var i = 0; i < jsonArticles.length; i += 1) {
    			var jsonArticle = jsonArticles[i]
    			var htmlArticles = buildArticle(jsonArticle)
                var $article = jQuery(htmlArticles)
                var $addLink = $article.find(".add-article")
                addToCartListener(jsonArticle, $addLink)
                jQuery("#articles").append($article)
    		}
    	}
    })
}

function addToCartListener(article, $link) {
    
    jQuery($link).click(function() {
        totalPrice += article.price
        var htmlCartArtcile = builCartdArticle(article)
        var $cartArticle = jQuery(htmlCartArtcile)
        var $removeLink = $cartArticle.find(".remove-link")
        var $fixtureLink = $cartArticle.find("edit-fixture")
        removeToCartListener(article, $removeLink, $cartArticle)
        editFixtureListener(article, $fixtureLink)
        jQuery("#price").html(totalPrice)
        jQuery("#cart").append($cartArticle)

    })

}

function removeToCartListener(article, $link, $cartArticle) {
    jQuery($link).click(function() {
        $cartArticle.remove()
        totalPrice -= article.price
        jQuery("#price").html(price)
    })
}

function editFixtureListener(article, $link) {
    jQuery($link).click(function(){
        /* pop =) */
    })
}



function buildArticle(jsonArticle) {
	htmlArticle = new EJS({url:'./templates/_article.ejs'}).render(jsonArticle)
	return htmlArticle;
}

function builCartdArticle(jsonArticle) {
	htmlArticle = new EJS({url:'./templates/_cart_article.ejs'}).render(jsonArticle)
	return htmlArticle;
}


