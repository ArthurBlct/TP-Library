<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Bibliothèque</h1>
        <input type="text" id="searchInput" placeholder="Nom du livre">
        <button id="searchBtn">Chercher</button>
        <div id="livre"></div>
    </div>
    <div id="favorites">
        <button>Favorites</button>
        <div id="favoriteLivres"></div>
    </div>

    
</body>
</html>
