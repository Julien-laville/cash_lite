<?php
	header('Content-Type: application/json');
	require_once('../../models/Article.php');
	$article = Article::article($id);

	echo $article->toJson();
?>