<?php

header('Content-Type: application/json');
require_once('../../models/Configuration.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$paramName = $_POST["paramName"];
	$paramValue = $_POST["paramValue"];
	$isUpdate = Configuration::saveOrUpdate($paramName,$paramValue);
} else {
	$paramName = $_GET["paramName"];
	if(is_array($paramName)) {
		$json_configuration = [];
		$configurations = Configuration::find_all($paramName);
		foreach($configurations as &$configuration) {
			array_push($json_configuration, $configuration->toJson());
		}

		$json_configuration = join(",", $json_configuration);
		echo "[".$json_configuration."]";
	} else {
		$configuration = Configuration::find($paramName);
		echo $configuration->toJson();
	}
}

?>