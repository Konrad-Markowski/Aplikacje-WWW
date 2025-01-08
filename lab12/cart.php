<?php
include 'includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Twój Koszyk</h1>
        <nav>
            <a href="index.php">Strona główna</a>
            <a href="cart.php">Koszyk</a>
        </nav>
    </header>

    <main>
        <?php displayCart(); ?>
    </main>

    <footer>
        <p>&copy; 2025 Sklep z Filmami. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>
