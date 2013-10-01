<?php

	header('Content-Type: application/json');
	require_once('../../models/Article.php');
	parse_str($_POST["article"], $serialized_article);
	$name = $serialized_article["name"];
	$id = $serialized_article["id"];

	$image_alt = $serialized_article["image_alt"];
	$price = $serialized_article["price"];

	$article = new Article($id, $price, $name, "", $image_alt);
	$article->save_or_update();
	echo "success";
?>