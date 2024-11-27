<?php
include('cfg.php'); // Łączymy z bazą danych
include('functions.php'); // Załączamy plik z funkcjami

// Test wywołania funkcji
$id = isset($_GET['id']) ? $_GET['id'] : 1; // Pobranie ID z adresu URL lub domyślnie 1

echo "<h1>Zawartość strony</h1>";
echo PokazPodstrone($id);
?>