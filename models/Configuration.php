<?php
require '../../kint/Kint.class.php';
class Configuration {
	private $paramName;
	private $paramValue;
	private static $DATABASE_LOCATION = "../../databases/caisse.db";

	private function __construct($paramName, $paramValue) {
		$this->paramName = $paramName;
		$this->paramValue = $paramValue;
	}


	public static function find_all($paramNames) {
		$db = new SQLite3(self::$DATABASE_LOCATION);
		$configurations = [];
		
		foreach($paramNames as &$paramName) {
			$configuration_statement = $db->prepare('SELECT * FROM configurations WHERE paramName = :paramName LIMIT 1');
			$configuration_statement->bindValue(':paramName', $paramName, SQLITE3_TEXT);

			$results = $configuration_statement->execute();
			$line = $results->fetchArray();
			

			if(sizeof($line) > 0) {
				
			
				$paramName = $line['paramName'];
				$paramValue = $line['paramValue'];
				array_push($configurations, new Configuration($paramName, $paramValue));

			}
		}
		return $configurations;
		$db->close();
	}

	public static function find($paramName) {
		$db = new SQLite3(self::$DATABASE_LOCATION);
		

		$configuration_statement = $db->prepare('SELECT * FROM configurations WHERE paramName = :paramName LIMIT 1');
		$configuration_statement->bindValue(':paramName', $paramName, SQLITE3_TEXT);

		$results = $configuration_statement->execute();
		$line = $results->fetchArray();
		$db->close();

		if(sizeof($line) < 1) {
			return null;
		} else {
			$paramName = $line['paramName'];
			$paramValue = $line['paramValue'];
			return new Configuration($paramName, $paramValue);
		}
	}

	static function saveOrUpdate($paramName, $paramValue) {
		if(self::find($paramName) == null) {
			self::save($paramName, $paramValue);
		} else {
			self::update($paramName, $paramValue);
		}
		echo "success";
	}

	static function update($paramName, $paramValue) {
		$db = new SQLite3(self::$DATABASE_LOCATION);

		$configuration_statement = $db->prepare('UPDATE configurations SET paramValue = :paramValue WHERE paramName = :paramName');
		$configuration_statement->bindValue(':paramName', $paramName, SQLITE3_TEXT);
		$configuration_statement->bindValue(':paramValue', $paramValue, SQLITE3_TEXT);

		$configuration_statement->execute();
		$db->close();
	}

	static function save($paramName, $paramValue) {
		$db = new SQLite3(self::$DATABASE_LOCATION);

		$configuration_statement = $db->prepare('INSERT INTO configurations (paramValue, paramName) VALUES (:paramValue, :paramName)');
		$configuration_statement->bindValue(':paramName', $paramName, SQLITE3_TEXT);
		$configuration_statement->bindValue(':paramValue', $paramValue, SQLITE3_TEXT);

		$configuration_statement->execute();
		$db->close();
	}


	function toJson() {
		return '{"paramName":"' . $this->paramName . '","paramValue":"' . addcslashes($this->paramValue,"\n") . '"}';
	}
}



?>