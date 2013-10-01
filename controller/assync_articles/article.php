<?php

header('Content-Type: application/json');
require_once('../../models/Article.php');
$article_id = $_POST["id"];
$article = Article::find($article_id);
echo "{\"article\":".$article->toJson()."}";

?>