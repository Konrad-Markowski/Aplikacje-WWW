<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); // Ukrywanie błędów notice i warning

include('cfg.php'); // Połączenie z bazą danych (opcjonalne)

// Ustawianie ścieżek do plików HTML na podstawie parametru `idp`
if ($_GET['idp'] == '') {
    $strona = 'html/glowna.html';
}
if ($_GET['idp'] == 'winners') {
    $strona = 'html/winners.html';
}
if ($_GET['idp'] == 'directors') {
    $strona = 'html/directors.html';
}
if ($_GET['idp'] == 'history') {
    $strona = 'html/history.html';
}
if ($_GET['idp'] == 'contact') {
    $strona = 'html/contact.html';
}
if ($_GET['idp'] == 'test-block') {
    $strona = 'html/test-block.html';
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Twoje Imię i Nazwisko">
    <meta name="Content-Language" content="pl">
    <link rel="stylesheet" href="css/style.css"> <!-- Ścieżka do pliku CSS -->
    <title>Filmy Oscarowe</title>
</head>
<body>
    <header>
        <h1>Filmy Oscarowe</h1>
        <nav>
            <ul>
                <li><a href="index.php?idp=">Strona Główna</a></li>
                <li><a href="index.php?idp=winners">Zwycięzcy</a></li>
                <li><a href="index.php?idp=directors">Reżyserzy</a></li>
                <li><a href="index.php?idp=history">Historia</a></li>
                <li><a href="index.php?idp=contact">Kontakt</a></li>
                <li><a href="index.php?idp=test-block">Testowa Strona</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
        // Ładowanie treści strony
        if (file_exists($strona)) {
            include($strona);
        } else {
            echo "<p>Strona nie istnieje. Przepraszamy!</p>";
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2024 Filmy Oscarowe</p>
        <?php
        $nr_indeksu = '123456';
        $nrGrupy = 'ISI3';
        echo "Autor: Twoje Imię i Nazwisko, indeks: $nr_indeksu, grupa: $nrGrupy";
        ?>
    </footer>
</body>
</html>
