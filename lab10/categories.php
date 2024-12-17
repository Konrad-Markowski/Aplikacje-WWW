<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

// Połączenie z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Connection failed: {$conn->connect_error}");
}

// Tworzenie tabeli, jeśli nie istnieje
function TworzKategorieTable() {
    global $conn;

    // Sprawdzenie, czy tabela istnieje
    $result = $conn->query("SHOW TABLES LIKE 'categories'");
    if ($result && $result->num_rows == 0) {
        $sql = "CREATE TABLE categories (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            matka INT(6) DEFAULT 0,
            nazwa VARCHAR(255) NOT NULL
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table 'categories' created successfully.<br>";
        } else {
            echo "Error creating table: {$conn->error}<br>";
        }
    }
}

// Funkcja dodawania kategorii
function DodajKategorie($nazwa, $matka = 0) {
    global $conn;

    // Sprawdzenie, czy kategoria już istnieje
    $stmt = $conn->prepare("SELECT id FROM categories WHERE nazwa = ? AND matka = ?");
    $stmt->bind_param("si", $nazwa, $matka);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Category '$nazwa' already exists.<br>";
        $stmt->close();
        return;
    }

    $stmt->close();

    // Dodanie nowej kategorii
    $stmt = $conn->prepare("INSERT INTO categories (nazwa, matka) VALUES (?, ?)");
    $stmt->bind_param("si", $nazwa, $matka);

    if ($stmt->execute()) {
        echo "Category '$nazwa' added successfully.<br>";
    } else {
        echo "Error adding category: {$conn->error}<br>";
    }

    $stmt->close();
}

// Funkcja wyświetlania kategorii w strukturze hierarchicznej
function PokazKategorie($matka = 0) {
    global $conn;

    // Pobranie kategorii, które mają daną kategorię nadrzędną
    $stmt = $conn->prepare("SELECT id, nazwa FROM categories WHERE matka = ? ORDER BY nazwa");
    $stmt->bind_param("i", $matka);
    $stmt->execute();
    $result = $stmt->get_result();

    // Iteracja po kategoriach na danym poziomie
    while ($row = $result->fetch_assoc()) {
        // Wyświetlenie kategorii
        echo "<strong>" . htmlspecialchars($row['nazwa']) . "</strong><br>";

        // Rekurencyjne wyświetlanie dzieci tej kategorii
        PokazKategorie($row['id']);
    }

    $stmt->close();
}

// Tworzenie tabeli, jeśli nie istnieje
TworzKategorieTable();

// Obsługa formularza
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nazwa = $_POST['nazwa'] ?? '';
    $matka = $_POST['matka'] ?? 0;

    if (!empty($nazwa)) {
        DodajKategorie($nazwa, (int)$matka);
    } else {
        echo "Category name is required.<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Kategorię</title>
</head>
<body>
    <h1>Dodaj Kategorię</h1>
    <form action="" method="POST">
        <label for="nazwa">Nazwa kategorii:</label>
        <input type="text" id="nazwa" name="nazwa" required><br><br>
        
        <label for="matka">ID kategorii nadrzędnej (0 dla głównej):</label>
        <input type="number" id="matka" name="matka" value="0"><br><br>
        
        <button type="submit">Dodaj kategorię</button>
    </form>

    <h2>Struktura kategorii</h2>
    <?php
    // Wyświetlanie struktury kategorii
    PokazKategorie();
    ?>
</body>
</html>
