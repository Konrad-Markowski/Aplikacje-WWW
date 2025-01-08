<?php
include 'includes/functions.php';

$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 1; // Domyślna kategoria
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmy w kategorii</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Kategoria: <?php echo htmlspecialchars($category_id); ?></h1>
        <nav>
            <a href="index.php">Strona główna</a>
            <a href="cart.php">Koszyk</a>
        </nav>
    </header>

    <main>
        <?php displayProducts($category_id); ?>
    </main>

    <footer>
        <p>&copy; 2025 Sklep z Filmami. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>
