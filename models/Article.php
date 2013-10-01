<?php 
class Article {
	private $id;
	private $price;
	private $name;
	private $image_url;
	private $image_alt;

	public function __construct($id, $price, $name, $image_url, $image_alt) {
		$this->id = $id;
		$this->name = $name;
		$this->price = $price;
		$this->image_url = $image_url;
		$this->image_alt = $image_alt;
	}

	public static function buildFromDb($articleTuple) {
		$id = $articleTuple['ID'];
		$price = $articleTuple['price'];
		$name = $articleTuple['name'];
		$image_url = $articleTuple['image_url'];
		$image_alt = $articleTuple['image_alt'];	

		return new Article($id, $price, $name, $image_url, $image_alt);
	}

	public static function all() {
		$db = new SQLite3('../../databases/caisse.db');
		$json_articles = [];
		$results = $db->query('SELECT * FROM articles');
		while($line = $results->fetchArray()) {
			$article = Article::buildFromDb($line);
			array_push($json_articles, $article->toJson());
		}
		$db->close();
		return $json_articles;
	}


	public function update() {
		$db = new SQLite3('../../databases/caisse.db');
		$article_statement = $db->prepare('UPDATE articles SET name = :name, price = :price, image_alt = :image_alt, image_url = :image_url WHERE id = :id');
		$article_statement->bindValue(':name', $this->name, SQLITE3_TEXT);
		$article_statement->bindValue(':price', $this->price, SQLITE3_TEXT);
		$article_statement->bindValue(':image_alt', $this->image_alt, SQLITE3_TEXT);
		$article_statement->bindValue(':image_url', $this->image_url, SQLITE3_TEXT);

		$article_statement->bindValue(':id', $this->id, SQLITE3_INTEGER);

		$article_statement->execute();
		$db->close();
	} 

	public function save() {
		$db = new SQLite3('../../databases/caisse.db');
		$article_statement = $db->prepare('INSERT INTO articles (name,price,image_alt,image_url) VALUES (:name,:price,:image_alt,:image_url)');
		$article_statement->bindValue(':name', $this->name, SQLITE3_TEXT);
		$article_statement->bindValue(':price', $this->price, SQLITE3_TEXT);
		$article_statement->bindValue(':image_alt', $this->image_alt, SQLITE3_TEXT);
		$article_statement->bindValue(':image_url', $this->image_url, SQLITE3_TEXT);
		$article_statement->execute();
		$db->close();
	}

	public function save_or_update() {
		if(self::find($this->id) == null) {
			$this->save();
		} else {
			$this->update();
		}
	}

	public static function find($id) {
		//var_dump($id);
		$db = new SQLite3('../../databases/caisse.db');

		$article_statement = $db->prepare('SELECT * FROM articles WHERE id = :id LIMIT 1');
		$article_statement->bindValue(':id', $id, SQLITE3_INTEGER);

		$results = $article_statement->execute();
		$line = $results->fetchArray();
		$db->close();
		if($line == null) {
			return null;
		} else {
			return self::buildFromDb($line);
		}
	}

	public function toJson() {
		return "{\"name\":\"" . $this->name . "\",\"price\":" . $this->price . ",\"id\":\"" . $this->id . "\",\"image_url\":\"" . $this->image_url ."\",\"image_alt\":\"" . $this->image_alt . "\"}";
	} 
}
?>