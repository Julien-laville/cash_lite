<?php
	header('Content-Type: application/json');
	require_once('../../models/Article.php');
	
	echo "{\"articles\":[".join(",", Article::all())."]}";
?>