<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr" dir="ltr">
  <head>
  	<link rel="stylesheet" type="text/css" href="../public/css/style.css">
  	<link rel="stylesheet" type="text/css" href="../public/css/jquery.fileupload-ui.css">
  	
    <title>Editer</title>
  </head>
   <body>
   	<a href="../index.php">Caisse</a>
   	<a href="articles.php">Revenrir aux article</a>

     <!-- Contenu de la page respectant la syntaxe XML. -->

<form id="edit">
  <div id="edit-status"></div>
  <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"/>
  <input type="hidden" name="picId"/>

	<label for="name">Nom</label>
	<input name="name" type="text"/>

	<label for="image_alt">Image alt</label>
	<input name="image_alt" type="text"/>

	<label for="price">Pri</labxel>
	<input name="price" type="text"/>
	<input type="file" name="images[]" id="img_upload"/>
  
  <div id="fixtures">
    <input type="texte" name="fixtures[]"/>
  </div>
  <a href="#" id="add-fixture">Ajouter ingredient</a>
	<div id="article-picture"></div>
  <a href="#" id="submit">Soumettre</a>

</form>

     <script type="text/javascript" src="../public/js/jquery-1.10.2.js"></script>
     <script type="text/javascript" src="../public/js/jquery.ui.widget.js"></script>
     <script type="text/javascript" src="../public/js/jquery.fileupload.js"></script>
     <script type="text/javascript" src="../public/js/ejs.js"></script>
     <script type="text/javascript" src="../public/js/edit_article.js"></script>

   </body>
</html>