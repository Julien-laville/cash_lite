jQuery(document).ready(function(){
	tryRetreaveArticle()
	createOrUpdateListener()
	addFixtureListener()
	initSubmitListener()
})

function addFixtureListener() {
	jQuery("#add-fixture").click(function() {
		var fixtureNode = '<input type="text" name="fixtures[]">'
		jQuery("#fixtures").append(fixtureNode)
	})
}

function createOrUpdateListener() {
	tryRetreaveArticle()
}

function tryRetreaveArticle() {
	var articleId = jQuery("[name='id']").val()
	if(articleId) {
		loadArticles(articleId)
		jQuery("#edit-status").html("Article : " + articleId)
	} else {
		jQuery("#edit-status").html("Nouveau")
	}
}


function loadArticles(articleId) {
	var articleId = jQuery("[name='id']").val()
    jQuery.ajax({
    	url : "../controller/assync_articles/article.php",
    	dataType: "json",
    	type: "POST",
    	data: {id: articleId},
    	success: function(data) {
    		jsonArticles = data.article
    		completeField(data)
    	}
    })
}

function completeField(articleData) {
	var article = articleData.article
	jQuery("[name='name']").val(article.name)
	jQuery("[name='price']").val(article.price)
	jQuery("[name='image_alt']").val(article.image_alt)

	var pictureNode = '<img src="' + article.image_url + '" alt="' + article.image_alt + '"/>'
	jQuery("#article-picture").html(pictureNode)
}

function initSubmitListener() {
	jQuery("#submit").click(function() {
		createOrUpdateArticle()
	})
}

function createOrUpdateArticle() {
	var $serializedArticle = jQuery("FORM").serialize()
	jQuery.ajax({
		method:"POST",
		url:"../controller/assync_articles/update_article.php",
		data:{article:$serializedArticle},
		success:function(data) {
			var $status = jQuery("#edit-status")
			if(data == "success") {
				$status.html("l'article a été mis à jours")
			} else {
				$status.html("une erreur est survenue : " + data)
			}
		}
	})
}