<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr" dir="ltr">
  <head>
  	<link rel="stylesheet" type="text/css" href="./public/css/style.css">
    <title>Caisse</title>
  </head>
   <body>

   	<a href="./view/articles.php">Gerer les articles</a>
    <a href="./view/historique.php">Historique</a>
    <a href="./view/configuration.php">Configuration</a>

   	<div id="articles"></div>
   	<div id="cart"></div>
   	<div id="price"></div>
    <a href="./view/finalize.php">Finaliser la vente</a>
     <!-- Contenu de la page respectant la syntaxe XML. -->
     <script type="text/javascript" src="./public/js/jquery-1.10.2.js"></script>
     <script type="text/javascript" src="./public/js/ejs.js"></script>
     <script type="text/javascript" src="./public/js/caisse.js"></script>
   </body>
</html>